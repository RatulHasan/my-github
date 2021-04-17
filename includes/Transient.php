<?php
/***
 * Menu class file
 *
 * @since 1.0.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package MyGitHub
 */

namespace My\GitHub;

/**
 * Class Transient
 *
 * @package My\GitHub
 */
class Transient {

    /**
     * Transient constructor.
     */
    public function __construct() {
        add_action( 'update_option', array( $this, 'cb_update_option' ) );
    }

    /**
     * This callback is for deleting fp_featured_post transient
     *
     * @return void
     */
    public function cb_update_option() {
        delete_transient( 'admin_my_github_details' );
        delete_transient( 'my_github_root' );
    }

    /**
     * Get github username
     *
     * @return false|mixed|void
     */
    public static function admin_my_github_details() {
        $my_github_details = get_transient( 'admin_my_github_details' );
        if ( ! $my_github_details ) {
            $my_github_details = get_option( 'my_github_details' );
            set_transient( 'admin_my_github_details', $my_github_details, HOUR_IN_SECONDS );
        }
        return $my_github_details;
    }

    /**
     * Get github root
     * {
            "login": "RatulHasan",
            "id": 14246834,
            "node_id": "MDQ6VXNlcjE0MjQ2ODM0",
            "avatar_url": "https://avatars.githubusercontent.com/u/14246834?v=4",
            "gravatar_id": "",
            "url": "https://api.github.com/users/RatulHasan",
            "html_url": "https://github.com/RatulHasan",
            "followers_url": "https://api.github.com/users/RatulHasan/followers",
            "following_url": "https://api.github.com/users/RatulHasan/following{/other_user}",
            "gists_url": "https://api.github.com/users/RatulHasan/gists{/gist_id}",
            "starred_url": "https://api.github.com/users/RatulHasan/starred{/owner}{/repo}",
            "subscriptions_url": "https://api.github.com/users/RatulHasan/subscriptions",
            "organizations_url": "https://api.github.com/users/RatulHasan/orgs",
            "repos_url": "https://api.github.com/users/RatulHasan/repos",
            "events_url": "https://api.github.com/users/RatulHasan/events{/privacy}",
            "received_events_url": "https://api.github.com/users/RatulHasan/received_events",
            "type": "User",
            "site_admin": false,
            "name": "Ratul Hasan",
            "company": "@besoftySoftware ",
            "blog": "https://besofty.com/",
            "location": "Dhaka, Bangladesh",
            "email": null,
            "hireable": true,
            "bio": "Ratul the lazy man. ",
            "twitter_username": null,
            "public_repos": 74,
            "public_gists": 3,
            "followers": 12,
            "following": 36,
            "created_at": "2015-09-12T09:03:34Z",
            "updated_at": "2021-04-13T20:01:33Z"
        }
     *
        $args     = array(
            'accept'  => 'application/json',
            'headers' => array(
                'access_token' => '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',
                'Client ID' => 'da604728e4ffab4c5b39',
                'Client secrets' => 'b0eeb20d3343b98c85efa7b774bfed08bfd6a814',
                'code' => '6e826d15b420fcce27fa',
                'token_type'   => 'bearer',
            ),
        );
     * We're going to now talk to the GitHub API. Ready?
    <a href="https://github.com/login/oauth/authorize?scope=ratuljh@gmail.com&client_id=da604728e4ffab4c5b39">Click here</a> to begin!</a>
     *
     * @return false|mixed|void
     */
    public static function get_github_root() {
        $body = get_transient( 'my_github_root' );
        if ( ! $body ) {
            $username = Transient::admin_my_github_details();
            $response = wp_remote_get( "https://api.github.com/users/{$username['my_github_username']}" );
            $body     = wp_remote_retrieve_body( $response );
            $body     = json_decode( $body );

            if ( is_wp_error( $response ) ) {
                $error_message = $response->get_error_message();
                $body          = "Something went wrong: $error_message";
            } else {
                set_transient( 'my_github_root', $body, HOUR_IN_SECONDS );
            }
        }
        return $body;
    }

    /**
     * Get all github events
     *
     * @return mixed|string
     */
    public static function get_github_all_events() {
        $body = get_transient( 'my_github_all_events' );
        if ( ! $body ) {
//            https://api.github.com/users/{$username['my_github_username']}/events
            $username = Transient::admin_my_github_details();
            $response = wp_remote_get( 'https://api.github.com/events' );
            $body     = wp_remote_retrieve_body( $response );
            $body     = json_decode( $body );

            if ( is_wp_error( $response ) ) {
                $error_message = $response->get_error_message();
                $body          = "Something went wrong: $error_message";
            } else {
                set_transient( 'my_github_all_events', $body, HOUR_IN_SECONDS / 20 );
            }
        }
        return $body;
    }

    /**
     * To get github details
     *
     * @param  string $url  github api url.
     *
     * @return mixed
     */
    public static function get_my_github_details( string $url ) {
        $cash_key = md5( $url );
        $body     = get_transient( "my_github_details_{$cash_key}" );
        if ( ! $body ) {
            if ( ! $url ) {
                return false;
            }
            $response      = wp_remote_get( "$url" );
            $response_code = wp_remote_retrieve_response_code( $response );

            if ( 200 === $response_code ) {
                $body = wp_remote_retrieve_body( $response );
                $body = json_decode( $body );
            } else {
                $body = '';
            }
            set_transient( "my_github_details_{$cash_key}", $body, HOUR_IN_SECONDS );
        }
        return $body;
    }

}
