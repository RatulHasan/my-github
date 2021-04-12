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
            set_transient( 'my_github_details', $my_github_username, DAY_IN_SECONDS );
        }
        return $my_github_username;
    }
}
