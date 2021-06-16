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
     * @since 1.2.2
     *
     * @var array $admin_details
     */
    public $admin_details;

    /**
     * Shortcode constructor.
     */
    public function __construct() {
        $this->admin_details = Transient::admin_my_github_details();
        if ( empty( $this->admin_details['my_github_username'] ) ) {
            return false;
        }
        if ( isset( $this->admin_details['is_show_in_custom_template'] ) && $this->admin_details['is_show_in_custom_template'] ) {
            add_filter( 'template_include', array( $this, 'cb_template_include' ) );
        }
        add_shortcode( 'my_github', array( $this, 'cb_my_github_shortcode' ) );
    }

    /**
     * Callback for template include.
     *
     * @param string $template current template.
     *
     * @since 1.2.2
     *
     * @return string
     */
    public function cb_template_include( $template ) {
        global $post;
        if ( $post ) {
            if ( has_shortcode( $post->post_content, 'my_github' ) ) {
                $template = apply_filters( 'my_github_custom_template', MY_GITHUB_INCLUDE_PATH . '/templates/my_github_main.php' );
            }
        }
        return $template;
    }

    /**
     * Callback for My GitHub shortcode
     *
     * @return false|void
     */
    public function cb_my_github_shortcode() {
        if ( empty( $this->admin_details['my_github_username'] ) ) {
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
