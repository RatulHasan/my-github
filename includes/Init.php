<?php
/***
 * Initial class file
 *
 * @since 1.0.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package MyGitHub
 */

namespace My\GitHub;

use My\GitHub\Admin\Menu;
use My\GitHub\Admin\Settings;
use My\GitHub\Frontend\Widget;
use My\GitHub\Frontend\Shortcode;

/**
 * Class Init
 *
 * @package My\GitHub
 */
class Init {

    /**
     * Getaway for all classes.
     *
     * @return void
     */
    public static function register() {
        new Assets();
        new Widget();
        if ( is_admin() ) {
            new Menu();
            new Settings();
            new Transient();
        } else {
            new Shortcode();
        }
    }
}
