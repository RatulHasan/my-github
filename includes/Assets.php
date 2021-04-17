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
        add_filter('mce_buttons', [$this, 'add_tinymce_button']);
    }

    public function add_tinymce_button( $button ) {
//        echo '<pre>';
//        print_r( $button );
//        exit();
        return $button;
    }

    /**
     * Load Admin assets
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
                'src'  => MY_GITHUB_ASSETS . '/my_github_qtags.js',
                'deps' => array( 'quicktags' ),
                'ver'  => filemtime( MY_GITHUB_BASE_PATH . '/assets/my_github_qtags.js' ),
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
        wp_enqueue_style( 'pure-grid-css', '//unpkg.com/purecss@1.0.1/build/grids-min.css' );
        wp_enqueue_style( 'font-awesome-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' );
    }

    /**
     * Register Styles
     *
     * @return array[]
     */
    public function get_front_end_styles() {
        return array(
            'my-github-styles' => array(
                'src'  => MY_GITHUB_ASSETS . '/my_github.css',
                'deps' => array(),
                'ver'  => filemtime( MY_GITHUB_BASE_PATH . '/assets/my_github.css' ),
            ),
        );
    }

}
