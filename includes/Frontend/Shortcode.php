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

namespace My\GitHub\Frontend;

use My\GitHub\Transient;

/**
 * Class Frontend
 *
 * @package Featured\Posts\Frontend
 */
class Shortcode {

    /**
     * For storing AdminTransient instance
     *
     * @var Transient $admin_transient
     */
    public Transient $admin_transient;

    /**
     * Frontend constructor.
     */
    public function __construct() {
        $this->admin_transient = new Transient();
        add_shortcode( 'my_github', array( $this, 'cb_my_github_shortcode' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_dashicons_front_end' ) );
    }

    /**
     * Load dashicons
     *
     * @return void
     */
    public function load_dashicons_front_end() {
        wp_enqueue_style( 'dashicons' );
    }

    /**
     * To get github followers
     *
     * @param  string $followers  github followers.
     *
     * @return mixed
     */
    public static function get_followers( string $followers ) {
        if ( ! $followers ) {
            return false;
        }
        $response = wp_remote_get( "$followers" );
        $body     = wp_remote_retrieve_body( $response );

        return json_decode( $body );
    }

    /**
     * To get github username
     *
     * @param  string $username  github username.
     *
     * @return mixed
     */
    public static function get_username( string $username ) {
        if ( ! $username ) {
            return false;
        }
        $response = wp_remote_get( "$username" );
        $body     = wp_remote_retrieve_body( $response );

        return json_decode( $body );
    }

    /**
     * To get github following
     *
     * @param  string $following_url  github following.
     *
     * @return mixed
     */
    public static function get_following( string $following_url ) {
        if ( ! $following_url ) {
            return false;
        }
        $response = wp_remote_get( "$following_url" );
        $body     = wp_remote_retrieve_body( $response );

        return json_decode( $body );
    }

    /**
     * To get github repos_url
     *
     * @param  string $repos_url  github repos_url.
     *
     * @return mixed
     */
    public static function get_repositories( string $repos_url ) {
        if ( ! $repos_url ) {
            return false;
        }
        $response = wp_remote_get( "$repos_url" );
        $body     = wp_remote_retrieve_body( $response );

        return json_decode( $body );
    }

    /**
     * Callback for My GitHub shortcode
     *
     * @return void
     */
    public function cb_my_github_shortcode() {
        // GitHub Token
        // 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
        // https://api.github.com/gists/starred?access_token=OAUTH-TOKEN
        // $response = wp_remote_get( "https://api.github.com/users/{$username['my_github_username']}?access_token=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" );

        $username      = Transient::get_github_username();
        $response      = wp_remote_get( "https://api.github.com/users/{$username['my_github_username']}" );
        $body          = wp_remote_retrieve_body( $response );
        $body          = json_decode( $body );
        $response_code = wp_remote_retrieve_response_code( $response );

        if ( 200 === $response_code ) {
            include_once MY_GITHUB_INCLUDE_PATH . '/templates/my_github.php';
        }
    }

}
