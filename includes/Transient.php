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
