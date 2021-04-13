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
    <div class="card aligncenter">
        <img class="avatar-image" src="<?php echo esc_url( $body->avatar_url ); ?>" alt="<?php echo esc_attr( $body->name ); ?>">
        <div class="container">
            <h4>
                <b>
                    <a href="<?php echo esc_url( $body->url ); ?>" target="_blank"><?php echo esc_html( $body->name ); ?></a>
                    <sup title="Hireable" class="color-green"><?php echo esc_html( isset( $body->hireable ) ? 'ⓗ' : '' ); ?></sup>
                </b>
                <small><?php echo esc_html( $body->company ); ?></small>
            </h4>
            <small>Bio: <?php echo esc_html( $body->bio ); ?></small>
            <small class="alignright">
                Created at:
                <?php
                echo esc_html( date( 'd M Y', strtotime( $body->created_at ) ) );
                ?>
            </small>
            <div class="row">
                <b>Followers: <?php echo esc_html( $body->followers ); ?></b>
                <hr />
                <?php
                $followers = \My\GitHub\Transient::get_followers( $body->followers_url );
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
                <b>Following: <?php echo esc_html( $body->following ); ?></b>
                <hr />
                <?php
                $following_url = str_replace( '{/other_user}', '', $body->following_url );
                $following_url = \My\GitHub\Transient::get_following( $following_url );
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
                <b>Public Repositories: <?php echo esc_html( $body->public_repos ); ?></b>
                <hr />
                <?php
                $repos_url = \My\GitHub\Transient::get_repositories( $body->repos_url );
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

    .color-green {
        color: green;
    }

    .card {
        box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        width: 90%;
    }

    .follower_img {
        width: 10%;
        border-radius: 50%;
        padding: 5px 10px;
    }

    .row {
        margin: 20px;
        padding-bottom: 10px;
    }

    small {
        font-size: 14px;
    }

    .container {
        padding: 5px 20px;
    }
</style>
