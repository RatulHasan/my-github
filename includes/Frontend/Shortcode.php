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
    }

    /**
     * Callback for My GitHub shortcode
     *
     * @return void
     */
    public function cb_my_github_shortcode() {
        $username = Transient::get_github_username();
        $response = wp_remote_get( "https://api.github.com/users/{$username}" );
        $body     = wp_remote_retrieve_body( $response );
        $body     = json_decode( $body );

        if ( !  $body->message  ) {
            // echo '<pre>';
            // print_r( $body );
            include_once MY_GITHUB_INCLUDE_PATH . '/templates/my_github.php';
        }
    }

    /**
     * To get github followers
     *
     * @param  string $followers github followers.
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
     * @param  string $username github username.
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

}
