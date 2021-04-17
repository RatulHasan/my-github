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
        add_shortcode( 'my_github_all_events', array( $this, 'cb_my_github_all_events_shortcode' ) );
    }

    /**
     * Callback for My GitHub shortcode
     *
     * @return false|void
     */
    public function cb_my_github_shortcode() {
        // GitHub Token
        // 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
        // https://api.github.com/gists/starred?access_token=OAUTH-TOKEN
        // $response = wp_remote_get( "https://api.github.com/users/{$username['my_github_username']}?access_token=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" );

        $my_github_details = Transient::admin_my_github_details();
        if ( empty( $my_github_details['my_github_username'] ) ) {
            return false;
        }

        $body = Transient::get_github_root();
        if ( $body ) {
            $git_name  = __( 'GitHub Profile', 'my-github' );
            $git_name .= ' <i class="fab fa-github"></i>';
            $git_name  = apply_filters( 'git_name_header', $git_name );
            include_once MY_GITHUB_INCLUDE_PATH . '/templates/my_github_profile.php';
        }
    }

    /**
     * Callback for My GitHub shortcode
     *
     * @return false|void
     */
    public function cb_my_github_all_events_shortcode() {
        $my_github_details = Transient::admin_my_github_details();
        if ( empty( $my_github_details['my_github_username'] ) ) {
            return false;
        }

        $body = Transient::get_github_all_events();
        if ( $body ) {
            $git_name  = __( 'All Events', 'my-github' );
            $git_name .= ' <i class="fab fa-github"></i>';
            $git_name  = apply_filters( 'git_name_header', $git_name );
            include_once MY_GITHUB_INCLUDE_PATH . '/templates/my_github_all_events.php';
        }
    }

}
