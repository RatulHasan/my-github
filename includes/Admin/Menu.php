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

namespace My\GitHub\Admin;

/**
 * Class Menu
 *
 * @package My\GitHub
 */
class Menu {

    /**
     * Menu constructor.
     */
    public function __construct() {
        $plugin_file = MY_GITHUB_BASE_NAME;
        add_action( 'admin_menu', array( $this, 'cb_add_settings_page' ) );
        add_filter( "plugin_action_links_{$plugin_file}", array( $this, 'add_settings_links' ) );
    }

    /**
     * Callback for add options page
     *
     * @return void
     */
    public function cb_add_settings_page() {
        add_options_page(
            __( 'My GitHub', 'my-github' ),
            __( 'My GitHub', 'my-github' ),
            'manage_options',
            'my-github',
            array( $this, 'cb_add_my_github_page' ),
            7
        );
    }

    /**
     * Callback for add featured post
     *
     * @return void
     */
    public function cb_add_my_github_page() {
        include_once MY_GITHUB_INCLUDE_PATH . '/templates/my_github_settings.php';
    }

    /**
     * Add settings links
     *
     * @param  array $links  all predefined links.
     *
     * @return mixed
     */
    public function add_settings_links( array $links ) {
        $settings_links = "<a href='options-general.php?page=my-github'>Settings</a>";
        $settings_links = wp_kses(
            $settings_links,
            array(
                'a' => array(
                    'href' => array(),
                ),
            )
        );
        array_push( $links, $settings_links );

        return $links;
    }

}
