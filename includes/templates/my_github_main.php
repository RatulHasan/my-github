<?php
/***
 * My GitHub custom template.
 *
 * @since 1.2.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package My GitHub
 */

// To prevent direct access, if not define WordPress ABSOLUTE PATH then exit.
if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

get_header();
?>
<div class="container">
    <?php
	global $post;
	if ( has_shortcode( $post->post_content, 'my_github' ) ) {
		echo do_shortcode( '[my_github]' );
	}
	?>
</div>
    <?php
	get_footer();
