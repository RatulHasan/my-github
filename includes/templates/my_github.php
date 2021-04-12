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
    <div class="card">
        <img class="avatar-image" src="<?php echo esc_url( $body->avatar_url ); ?>" alt="<?php echo esc_html( $body->name ); ?>">
        <div class="container">
            <h4><b><a href="<?php echo esc_url( $body->url ); ?>" target="_blank"><?php echo esc_html( $body->name ); ?></a></b></h4>
            <p><?php echo esc_html( $body->bio ); ?></p>
            <p>
                <div class="row">
                    <b>Followers</b>
                </div>
                <?php
                $followers = \My\GitHub\Frontend\Shortcode::get_followers( $body->followers_url );
                if ( ! empty( $followers ) ) {
					foreach ( $followers as $follower ) {
//                        $username = \My\GitHub\Frontend\Shortcode::get_username( $follower->url );
						?>
                        <a href="<?php echo esc_url( $follower->url ); ?>" target="_blank">
                            <img title="<?php echo esc_html( $follower->login ); ?>" class="follower_img" src="<?php echo esc_url( $follower->avatar_url ); ?>" alt="<?php echo esc_html( $follower->login ); ?>">
<!--                            <img title="--><?php //echo esc_html( $username->name ); ?><!--" class="follower_img" src="--><?php //echo esc_url( $username->avatar_url ); ?><!--" alt="--><?php //echo esc_html( $username->name ); ?><!--">-->
                        </a>
						<?php
					}
                }
                ?>
            </p>
        </div>
    </div>
</div>

<style>
    .card .avatar-image {
        width: 100%;
    }

    .follower_img {
        width: 15%;
        border-radius: 50%;
        padding: 5px 10px;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    .container {
        padding: 5px 20px;
    }
</style>
