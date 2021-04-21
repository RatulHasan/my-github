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
        delete_transient( 'my_github_details_cd73a2ae7d0fce9f22d1be0662f2ed40' );
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
            if ( isset( $username['my_github_access_token'] ) && ! empty( $username['my_github_access_token'] ) ) {
                $url      = 'https://api.github.com/user';
                $args     = array(
                    'timeout' => 30,
                    'headers' => array(
                        'Authorization' => 'token ' . esc_attr( $username['my_github_access_token'] ),
                    ),
                );
                $response = wp_remote_get( $url, $args );
            } else {
                $args     = array(
                    'timeout' => 30,
                );
                $response = wp_remote_get( esc_url_raw( "https://api.github.com/users/{$username['my_github_username']}" ), $args );
            }
            $response_code = wp_remote_retrieve_response_code( $response );

            if ( is_wp_error( $response ) ) {
                $error_message = $response->get_error_message();
                $body          = "Something went wrong: $error_message";
            }

            if ( 200 === $response_code ) {
                $body = wp_remote_retrieve_body( $response );
                $body = json_decode( $body );

                if ( isset( $username['my_github_access_token'] ) && ! empty( $username['my_github_access_token'] ) ) {
                    set_transient( 'my_github_root', $body, MINUTE_IN_SECONDS );
                } else {
                    set_transient( 'my_github_root', $body, HOUR_IN_SECONDS );
                }
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

            $username = Transient::admin_my_github_details();
            $args     = array(
                'timeout' => 30,
            );
            if ( isset( $username['my_github_access_token'] ) && ! empty( $username['my_github_access_token'] ) ) {
                $args = array(
                    'headers' => array(
                        'Authorization' => 'token ' . esc_attr( $username['my_github_access_token'] ),
                    ),
                );
            }
            $response      = wp_remote_get( $url, $args );
            $response_code = wp_remote_retrieve_response_code( $response );

            if ( is_wp_error( $response ) ) {
                $error_message = $response->get_error_message();
                $body          = "Something went wrong: $error_message";
            }

			if ( 200 === $response_code ) {
				$body = wp_remote_retrieve_body( $response );
				$body = json_decode( $body );

                if ( isset( $username['my_github_access_token'] ) && ! empty( $username['my_github_access_token'] ) ) {
					set_transient( "my_github_details_{$cash_key}", $body, MINUTE_IN_SECONDS );
				}
				set_transient( "my_github_details_{$cash_key}", $body, HOUR_IN_SECONDS );
			}
        }
        return $body;
    }

}
