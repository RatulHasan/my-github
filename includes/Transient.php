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
        delete_transient( 'my_github_details' );
        delete_transient( 'my_github_root' );
        delete_transient( 'my_github_details' );
        delete_transient( 'my_github_followers' );
        delete_transient( 'my_github_following' );
        delete_transient( 'my_github_repositories' );
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
                'token_type'   => 'bearer',
            ),
        );
     *
     * @return false|mixed|void
     */
    public static function get_github_root() {
        $body = get_transient( 'my_github_root' );
        if ( ! $body ) {
            $username = Transient::get_github_username();
            $response      = wp_remote_get( "https://api.github.com/users/{$username['my_github_username']}" );
            $body          = wp_remote_retrieve_body( $response );
            $body          = json_decode( $body );
            $response_code = wp_remote_retrieve_response_code( $response );

            if ( 200 === $response_code ) {
                set_transient( 'my_github_root', $body, HOUR_IN_SECONDS );
            } else {
                set_transient( 'my_github_root', '', HOUR_IN_SECONDS );
            }
        }
        return $body;
    }

    /**
     * Get github username
     *
     * @return false|mixed|void
     */
    public static function get_github_username() {
        $my_github_username = get_transient( 'my_github_details' );
        if ( ! $my_github_username ) {
            $my_github_username = get_option( 'my_github_details' );
            set_transient( 'my_github_details', $my_github_username, HOUR_IN_SECONDS );
        }
        return $my_github_username;
    }

    /**
     * To get github username
     *
     * @param  string $username  github username.
     *
     * @return mixed
     */
	// public static function get_username( string $username ) {
	// if ( ! $username ) {
	// return false;
	// }
	// $response = wp_remote_get( "$username" );
	// $body     = wp_remote_retrieve_body( $response );
	//
	// return json_decode( $body );
	// }
    /**
     * To get github followers
     *
     * @param  string $followers  github followers.
     *
     * @return mixed
     */
    public static function get_followers( string $followers ) {
        $body = get_transient( 'my_github_followers' );
        if ( ! $body ) {
            if ( ! $followers ) {
                return false;
            }
            $response = wp_remote_get( "$followers" );
            $body     = wp_remote_retrieve_body( $response );

            $body = json_decode( $body );
            set_transient( 'my_github_followers', $body, HOUR_IN_SECONDS );
        }
        return $body;
    }

    /**
     * To get github following
     *
     * @param  string $following_url  github following.
     *
     * @return mixed
     */
    public static function get_following( string $following_url ) {
        $body = get_transient( 'my_github_following' );
        if ( ! $body ) {
            if ( ! $following_url ) {
                return false;
            }
            $response = wp_remote_get( "$following_url" );
            $body     = wp_remote_retrieve_body( $response );

            $body = json_decode( $body );
            set_transient( 'my_github_following', $body, HOUR_IN_SECONDS );
        }
        return $body;
    }

    /**
     * To get github repos_url
     *
     * @param  string $repos_url  github repos_url.
     *
     * @return mixed
     */
    public static function get_repositories( string $repos_url ) {
        $body = get_transient( 'my_github_repositories' );
        if ( ! $body ) {
            if ( ! $repos_url ) {
                return false;
            }
            $response = wp_remote_get( "$repos_url" );
            $body     = wp_remote_retrieve_body( $response );

            $body = json_decode( $body );
            set_transient( 'my_github_repositories', $body, HOUR_IN_SECONDS );
        }
        return $body;
    }

}
