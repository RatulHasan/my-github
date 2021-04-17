<?php
/**
 * Plugin Name:         My Github
 * Plugin URI:          https://github.com/RatulHasan/my-github
 * Description:         A simple and nice WordPress plugin that can track your github's profile and github's public events.
 * Version:             1.0.0
 * Requires at least:   5.2
 * Author:              Ratul Hasan
 * Author URI:          https://ratuljh.wordpress.com/
 * License:             GPL-2.0-or-later
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain:         my-github
 * Domain Path:         /languages
 *
 * @package MyGithub
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2005-2015 Automattic, Inc.
*/
// To prevent direct access, if not define WordPress ABSOLUTE PATH then exit.
if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

/**
 * Class MyGithub
 */
class MyGithub {

    // Plugin version.
    public const MY_GITHUB_VERSION = '1.0.0';

    /**
     * FeaturedPosts constructor.
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
