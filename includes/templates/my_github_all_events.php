<?php
/***
 * My Github
 *
 * @since 1.0.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package MyGitHub
 */

?>
<div class="wrap">
    <h1 class="text_center">
        <?php
        echo $git_name;
        ?>
    </h1>
    <div class="plugin-demo-content-border">
        <?php
        echo '<ol>';
        foreach ( $body as $value ) {
			?>
        <li>
            <?php echo esc_html( $value->type ); ?> by
            <img class="events-avatar-image-circle" src="<?php echo esc_url( $value->actor->avatar_url ); ?>" alt="<?php echo esc_attr( $value->actor->login ); ?>">
            <a class="text-decoration-none" href="<?php echo 'https://github.com/' . esc_attr( $value->actor->login ); ?>" target="_blank">
                <strong class="font-medium"><?php echo esc_attr( $value->actor->display_login ); ?></strong>
            </a>in <a class="text-decoration-none" href=" <?php echo 'https://github.com/' . esc_attr( $value->repo->name ); ?>" target="_blank">
                <strong><?php echo esc_attr( $value->repo->name ); ?></strong>
            </a>
            <?php
            if ( isset( $value->payload->commits[0]->message ) ) {
                ?>
                <div>
                    <div>
                        <strong>Commit Message</strong>
                    </div>
                    <?php echo esc_html( $value->payload->commits[0]->message ); ?>
                </div>
                <?php
            }
            if ( isset( $value->payload->comment->body ) ) {
                ?>
                <div>
                    <div>
                        <strong>Commit Message</strong>
                    </div>
                    <?php echo esc_html( $value->payload->comment->body ); ?>
                </div>
                <?php
            }
            echo '</li><hr/>';
		}
            echo '</ol>';
		?>
    </div>
</div>
