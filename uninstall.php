<?php
/***
 * Trigger this file on Plugin uninstall
 *
 * @since 1.0.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package MyGitHub
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die();
}

// Delete All Transients.
delete_transient( 'admin_my_github_details' );
delete_transient( 'my_github_root' );
delete_transient( 'my_github_all_events' );

global $wpdb;
$wpdb->query( "DELETE FROM `{$wpdb->prefix}options` WHERE `option_name` LIKE ('_transient_my_github_details_%')" );


// Delete All Other Data.
delete_option( 'my_github_details' );
