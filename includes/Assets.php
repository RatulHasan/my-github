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
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
        // FOR FRONTEND.
        add_action( 'wp_enqueue_scripts', array( $this, 'register_front_end_scripts' ) );
    }

    /**
     * Load Admin assets
     *
     * @param string $screen check current screen.
     *
     * @return void
     */
    public function register_admin_scripts( $screen ) {
        $scripts = $this->get_admin_scripts();
        foreach ( $scripts as $handle => $script ) {
            wp_register_script( $handle, $script['src'], $script['deps'], $script['ver'], true );
        }
        if ( 'post.php' === $screen || 'post-new.php' === $screen ) {
			wp_enqueue_script( 'my-github-scripts' );
        }
    }

    /**
     * Register Styles
     *
     * @return array[]
     */
    public function get_admin_scripts() {
        return array(
            'my-github-scripts' => array(
                'src'  => MY_GITHUB_ASSETS . '/my_github_qtags.min.js',
                'deps' => array( 'quicktags' ),
                'ver'  => MY_GITHUB_VERSION,
            ),
        );
    }

    /**
     * Load Frontend assets
     *
     * @return void
     */
    public function register_front_end_scripts() {
        $styles = $this->get_front_end_styles();
        foreach ( $styles as $handle => $style ) {
            wp_register_style( $handle, $style['src'], $style['deps'], $style['ver'] );
        }
        wp_enqueue_style( 'my-github-styles' );
        wp_enqueue_style( 'my-pure-grid-css' );
        wp_enqueue_style( 'my-font-awesome-css' );
    }

    /**
     * Register Styles
     *
     * @return array[]
     */
    public function get_front_end_styles() {
        return array(
            'my-github-styles'    => array(
                'src'  => MY_GITHUB_ASSETS . '/my_github.min.css',
                'deps' => array(),
                'ver'  => MY_GITHUB_VERSION,
            ),
            'my-pure-grid-css'    => array(
                'src'  => MY_GITHUB_ASSETS . '/grids-min.css',
                'deps' => array(),
                'ver'  => MY_GITHUB_VERSION,
            ),
            'my-font-awesome-css' => array(
                'src'  => MY_GITHUB_ASSETS . '/fontawesome-free-5.15.3/css/all.min.css',
                'deps' => array(),
                'ver'  => MY_GITHUB_VERSION,
            ),
        );
    }

}
