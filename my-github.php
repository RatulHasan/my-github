<?php
/**
 * Plugin Name:         My Github
 * Plugin URI:          https://github.com/RatulHasan/my-github
 * Description:         A simple and nice WordPress plugin that can track your github's profile.
 * Version:             1.2.4
 * Requires at least:   5.2
 * Tested up to:        6.4.2
 * Author:              Ratul Hasan
 * Author URI:          https://ratuljh.wordpress.com/
 * License:             GPL-2.0-or-later
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain:         my-github
 * Domain Path:         /languages
 *
 * @package MyGithub
 */

// To prevent direct access, if not define WordPress ABSOLUTE PATH then exit.
if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

/**
 * Class MyGithub
 */
final class MyGithub {

    // Plugin version.
    const MY_GITHUB_VERSION = '1.2.4';

    /**
     * MyGithub constructor.
     */
    public function __construct() {
        require_once __DIR__ . '/vendor/autoload.php';
        $this->localization_setup();
        $this->define_constant();

        add_action( 'activate_plugin', array( $this, 'cb_activate_plugin' ) );
        add_action( 'plugins_loaded', array( $this, 'initiate_plugin' ) );
    }

    /**
     * Define main plugin constant here for future use.
     *
     * @return void
     */
    public function define_constant() {
        define( 'MY_GITHUB_VERSION', self::MY_GITHUB_VERSION );
        define( 'MY_GITHUB_BASE_NAME', plugin_basename( __FILE__ ) );
        define( 'MY_GITHUB_BASE_PATH', __DIR__ );
        define( 'MY_GITHUB_INCLUDE_PATH', __DIR__ . '/includes' );
        define( 'MY_GITHUB_URL', plugins_url( '', __FILE__ ) );
        define( 'MY_GITHUB_ASSETS', MY_GITHUB_URL . '/assets' );
    }

    /**
     * Activating the plugin
     *
     * @return void
     */
    public function cb_activate_plugin() {
        if ( ! get_option( '_my_github_installed' ) ) {
            update_option( '_my_github_installed', time() );
        }
        update_option( '_my_github_version', MY_GITHUB_VERSION );
    }
    /**
     * Initialize plugin for localization
     *
     * @return void
     */
    public function localization_setup() {
        load_plugin_textdomain( 'my-github', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    /**
     * Initiate the plugin
     *
     * @return void
     */
    public function initiate_plugin() {
        \My\GitHub\Init::register();
    }
    /**
     * Init method for MyGithub
     *
     * @return false|\MyGithub
     */
    public static function init() {
        $instance = false;
        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }
}

/**
 * Initialize the Github
 *
 * @return void
 */
function my_github() {
    MyGithub::init();
}

/**
 * Hit start
 */
my_github();


/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_my_github() {

	if ( ! class_exists( 'Appsero\Client' ) ) {
		require_once __DIR__ . '/appsero/src/Client.php';
	}

	$client = new Appsero\Client( '8161e2ef-b32c-4832-bf2a-5a746b2d617c', 'My Github', __FILE__ );

	// Active insights
	$client->insights()->init();

}

appsero_init_tracker_my_github();
