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

use My\GitHub\Transient;

?>
<div class="wrap">
    <div class="container aligncenter">
        <img class="avatar-image" src="<?php echo esc_url( $body->avatar_url ); ?>" alt="<?php echo esc_attr( $body->name ); ?>">
        <h4>
            <b>
                <a href="<?php echo esc_url( $body->url ); ?>" target="_blank"><?php echo esc_html( $body->name ); ?></a>
                <sup title="Hireable" class="color-green"><?php echo esc_html( isset( $body->hireable ) ? 'ⓗ' : '' ); ?></sup>
            </b>
            <span class="small"><?php echo esc_html( $body->company ); ?></span>
        </h4>
        <b class="small">Bio: <?php echo esc_html( $body->bio ); ?></b>
        <b class="alignright">
            Created at:
            <?php
            echo esc_html( date( 'd M Y', strtotime( $body->created_at ) ) );
            ?>
        </b>
        <div class="mt">
            <b>Followers: <?php echo esc_html( $body->followers ); ?></b>
            <hr />
            <?php
            if ( isset( $my_github_details['is_show_followers'] ) ) {
                $followers = Transient::get_my_github_details( $body->followers_url );
                if ( ! empty( $followers ) ) {
                    foreach ( $followers as $follower ) {
                        ?>
                        <a href="<?php echo esc_url( $follower->url ); ?>" target="_blank">
                            <img title="<?php echo esc_attr( $follower->login ); ?>" class="follower_img" src="<?php echo esc_url( $follower->avatar_url ); ?>" alt="<?php echo esc_attr( $follower->login ); ?>">
                        </a>
                        <?php
                    }
                }
            }
            ?>
        </div>
        <div class="mt">
            <b>Following: <?php echo esc_html( $body->following ); ?></b>
            <hr />
            <?php
            if ( isset( $my_github_details['is_show_following'] ) ) {
                $following_url = str_replace( '{/other_user}', '', $body->following_url );
                $following_url = Transient::get_my_github_details( $following_url );
                if ( ! empty( $following_url ) ) {
                    foreach ( $following_url as $following ) {
                        ?>
                        <a href="<?php echo esc_url( $following->url ); ?>" target="_blank">
                            <img title="<?php echo esc_attr( $following->login ); ?>" class="follower_img" src="<?php echo esc_url( $following->avatar_url ); ?>" alt="<?php echo esc_attr( $following->login ); ?>">
                        </a>
                        <?php
                    }
                }
            }
            ?>
        </div>
        <div class="mt">
            <b>Public Repositories: <?php echo esc_html( $body->public_repos ); ?></b>
            <hr />
            <?php
            if ( isset( $my_github_details['is_show_my_github_public_repos'] ) ) {
                $repos_url = Transient::get_my_github_details( $body->repos_url );
                if ( ! empty( $repos_url ) ) {
                    echo '<ol>';
                    foreach ( $repos_url as $repos ) {
                        ?>
                        <li>
                        <a href="<?php echo esc_url( $repos->html_url ); ?>" target="_blank">
                            <strong class="font-big"><?php echo esc_attr( $repos->name ); ?></strong>
                        </a>
                        <?php
                        if ( $repos->fork ) {
                            echo ' (Forked)';
                        }

                        if ( isset( $my_github_details['is_show_my_github_repos_language'] ) ) {
                            ?>
                            <div class="font-medium">Language used</div>
                            <?php
                            $language_url = 'https://api.github.com/repos/' . esc_html( $body->login ) . '/' . esc_html( $repos->name )
                                            . '/languages';
                            $language     = Transient::get_my_github_details( $language_url );
                            foreach ( $language as $key => $item ) {
                                echo "<span class='color-darkorange'> {$key}</span> {$item} bytes<br/>";
                            }
                            ?>
                            <?php
                        }
                        echo '</li><hr/>';
                    }
                        echo '</ol>';
                }
            }
            ?>
        </div>
    </div>
</div>
