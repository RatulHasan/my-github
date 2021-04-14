<?php
/***
 * My GitHub Settings page
 *
 * @since 1.0.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package MyGitHub
 */

?>
<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'My Github', 'my-github' ); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'my_github_settings' );
        do_settings_sections( 'my-github' );
        submit_button();
        ?>
    </form>
</div>

