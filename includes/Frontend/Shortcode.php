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
     * @return false|void
     */
    public function cb_my_github_shortcode() {
        $my_github_details = Transient::admin_my_github_details();
        if ( empty( $my_github_details['my_github_username'] ) ) {
            return false;
        }

        $body = Transient::get_github_root();
        if ( $body ) {
            $git_name = __( 'GitHub Profile', 'my-github' );
            $git_name = apply_filters( 'git_name_header', $git_name );
            include_once MY_GITHUB_INCLUDE_PATH . '/templates/my_github_profile.php';
        }
    }

}
