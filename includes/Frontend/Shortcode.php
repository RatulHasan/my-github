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
     * Callback for My GitHub shortcode
     *
     * @return void
     */
    public function cb_my_github_shortcode() {
        // GitHub Token
        // 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
        // https://api.github.com/gists/starred?access_token=OAUTH-TOKEN
        // $response = wp_remote_get( "https://api.github.com/users/{$username['my_github_username']}?access_token=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" );

        $body = Transient::get_github_root();
        if ( $body ) {
            include_once MY_GITHUB_INCLUDE_PATH . '/templates/my_github.php';
        }
    }
}
