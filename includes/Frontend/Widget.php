<?php
/***
 * Widget class
 *
 * @since 1.1.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package MyGitHub
 */

namespace My\GitHub\Frontend;

use My\GitHub\Transient;

/**
 * Class Widget
 *
 * @package Widget
 */
class Widget extends \WP_Widget {
    /**
     * Widget constructor
     */
    public function __construct() {
        parent::__construct(
            'my-github',
            __( 'My GitHub', 'my-github' ),
            array( 'description' => __( 'Display your GitHub profile on your sidebar', 'my-github' ) )
        );

        add_action( 'widgets_init', array( $this, 'register_github_widget' ) );
    }

    /**
     * Register GitHub widget
     * 
     * @return void
     */
    public function register_github_widget() {
        register_widget( 'My\GitHub\Frontend\Widget' );
    }
}
