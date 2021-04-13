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
        <img class="avatar-image" src="<?php echo esc_url( $body->avatar_url ); ?>" alt="<?php echo esc_attr( $body->name ); ?>">
        <div class="container">
                <h4>
                    <b>
                        <a href="<?php echo esc_url( $body->url ); ?>" target="_blank"><?php echo esc_html( $body->name ); ?></a>
                    </b>
                    <small><?php echo esc_html( $body->company ); ?></small>
                </h4>
                <small>Bio: <?php echo esc_html( $body->bio ); ?></small>
                <div class="row">
                    <?php
                        $followers = \My\GitHub\Frontend\Shortcode::get_followers( $body->followers_url );
                    ?>
                    <b class="dashicons-groups">Followers: <?php echo esc_html( count( $followers ) ); ?></b>
                    <hr/>
                <?php
                if ( ! empty( $followers ) ) {
					foreach ( $followers as $follower ) {
						?>
                        <a href="<?php echo esc_url( $follower->url ); ?>" target="_blank">
                            <img title="<?php echo esc_attr( $follower->login ); ?>" class="follower_img" src="<?php echo esc_url( $follower->avatar_url ); ?>" alt="<?php echo esc_attr( $follower->login ); ?>">
                        </a>
						<?php
					}
                }
                ?>
                </div>
            <div class="row">
                <?php
                    $following_url = str_replace( '{/other_user}', '', $body->following_url );
                    $following_url = \My\GitHub\Frontend\Shortcode::get_following( $following_url );
                ?>
                <b>Following: <?php echo esc_html( count( $following_url ) ); ?></b>
                <hr/>
            <?php
			if ( ! empty( $following_url ) ) {
				foreach ( $following_url as $following ) {
					?>
                        <a href="<?php echo esc_url( $following->url ); ?>" target="_blank">
                            <img title="<?php echo esc_attr( $following->login ); ?>" class="follower_img" src="<?php echo esc_url( $following->avatar_url ); ?>" alt="<?php echo esc_attr( $following->login ); ?>">
                        </a>
						<?php
				}
			}
			?>
            </div>
            <div class="row">
                <b>Repositories</b>
                <hr/>
            <?php
                $repos_url = \My\GitHub\Frontend\Shortcode::get_repositories( $body->subscriptions_url );
			if ( ! empty( $repos_url ) ) {
			    echo '<ol>';
				foreach ( $repos_url as $repos ) {
					?>
                        <li>
                            <a href="<?php echo esc_url( $repos->html_url ); ?>" target="_blank">
                                <?php echo esc_attr( $repos->name ); ?>
                            </a>
                            <?php
							if ( $repos->fork ) {
								echo ' (Forked)';
							}
                            ?>
                        </li>
						<?php
				}
                echo '</ol>';
			}
			?>
            </div>
        </div>
    </div>
</div>

<style>
    .card .avatar-image {
        width: 50%;
    }

    .follower_img {
        width: 10%;
        border-radius: 50%;
        padding: 5px 10px;
    }
    .row{
        margin: 20px;
        padding-bottom: 10px;
    }
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    small{
        font-size: 14px;
    }
    .container {
        padding: 5px 20px;
    }
</style>
