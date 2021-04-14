<?php
/***
 * Project My Github
 *
 * @since 1.0.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package MyGithub
 */

namespace My\Github;

/**
 * Class Assets
 *
 * @package My\Github
 */
class Assets {

    /**
     * Assets constructor.
     */
    public function __construct() {
        // FOR FRONTEND.
        add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
    }

    /**
     * Load assets
     *
     * @return void
     */
    public function register_scripts() {
        $styles = $this->get_styles();
        foreach ( $styles as $handle => $style ) {
            wp_register_style( $handle, $style['src'], $style['deps'], $style['ver'] );
        }
        wp_enqueue_style( 'my-github-styles' );
    }

    /**
     * Register Styles
     *
     * @return array[]
     */
    public function get_styles() {
        return array(
            'my-github-styles' => array(
                'src'  => MY_GITHUB_ASSETS . '/my_github_css.css',
                'deps' => array(),
                'ver'  => filemtime( MY_GITHUB_BASE_PATH . '/assets/my_github_css.css' ),
            ),
        );
    }

}
