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
    <h1 class="text_center">
        <?php
        echo $git_name;
        ?>
    </h1>
    <div class="pure-g">
        <div class="pure-u-1-4" style='height:100vh;'>
            <div class="plugin-side-options">
                <img class="avatar-image-circle" src="<?php echo esc_url( $body->avatar_url ); ?>" alt="<?php echo esc_attr( $body->name ); ?>">
                <h5>
                    <a href="<?php echo esc_url( $body->html_url ); ?>" target="_blank"><?php echo esc_html( $body->name ); ?></a>
                </h5>
                <b class="small"><?php echo esc_html( $body->bio ); ?></b>
                <hr />
                <?php
                if ( isset( $my_github_details['is_show_followers'] ) ) {
                    ?>
                    <div class="small">
                        <i class="fas fa-user"></i> <strong><?php echo esc_html( $body->followers ); ?> </strong> Followers
                    </div>
                    <?php
                }
                if ( isset( $my_github_details['is_show_following'] ) ) {
                    ?>
                    <div class="small">
                        <i class="far fa-user"></i> <strong><?php echo esc_html( $body->following ); ?></strong> Following
                    </div>
                    <?php
                }

                if ( isset( $my_github_details['is_show_company'] ) ) {
                    if ( isset( $body->company ) ) {
                        ?>
                        <div class="small">
                            <i class="far fa-building"></i> <?php echo esc_html( $body->company ); ?>
                        </div>
                        <?php
                    }
                }

                if ( isset( $my_github_details['is_show_location'] ) ) {
                    if ( isset( $body->location ) ) {
                        ?>
                        <div class="small">
                            <i class="fas fa-street-view"></i> <?php echo esc_html( $body->location ); ?>
                        </div>
                        <?php
                    }
                }

                if ( isset( $my_github_details['is_show_email'] ) ) {
                    if ( isset( $body->email ) ) {
                        ?>
                        <div class="small">
                            <i class="far fa-envelope"></i>
                            <a class="text-decoration-none" href="mailto:<?php echo esc_html( $body->email ); ?>"><?php echo esc_html( $body->email ); ?></a>
                        </div>
                        <?php
                    }
                }

                if ( isset( $my_github_details['is_show_blog'] ) ) {
                    if ( isset( $body->blog ) ) {
                        $blog = substr( $body->blog, 0, 20 );
                        if ( strlen( $body->blog ) > 20 ) {
                            $blog .= '...';
                        }
                        ?>
                        <div class="small">
                            <i class="fas fa-link"></i>
                            <a class="text-decoration-none" target="_blank" href="<?php echo esc_html( $body->blog ); ?>"><?php echo esc_html( $blog ); ?></a>
                        </div>
                        <?php
                    }
                }

                if ( isset( $my_github_details['is_show_twitter'] ) ) {
                    if ( isset( $body->twitter_username ) ) {
                        ?>
                        <div class="small">
                            <i class="fab fa-twitter"></i>
                            <a class="text-decoration-none" target="_blank" href="https://twitter.com/<?php echo esc_html( $body->twitter_username ); ?>">
                                <?php echo '@' . esc_html( $body->twitter_username ); ?>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="pure-u-3-4">
            <div class="plugin-demo-content-border">
                <b>Public Repositories: <?php echo esc_html( $body->public_repos ); ?></b>
                <hr />
                <?php
                if ( isset( $my_github_details['is_show_my_github_public_repos'] ) ) {
					$repos_url = Transient::get_my_github_details( $body->repos_url );
					if ( ! empty( $repos_url ) ) {
						echo '<ol>';
						foreach ( $repos_url

						as $repos ) {
							?>
                <li>
                    <a class="text-decoration-none" href="<?php echo esc_url( $repos->html_url ); ?>" target="_blank">
                        <strong class="font-big"><?php echo esc_attr( $repos->name ); ?></strong>
                    </a>
							<?php
							if ( $repos->fork ) {
								echo ' (Forked)';
							}

							if ( isset( $my_github_details['is_show_my_github_repos_language'] ) ) {
								$language_url = 'https://api.github.com/repos/' . esc_html( $body->login ) . '/' . esc_html( $repos->name )
                                        . '/languages';
								$language     = Transient::get_my_github_details( $language_url );
								if ( ! empty( (array) $language ) ) {
									?>
                            <div class="font-medium">Language used</div>
									<?php
									foreach ( $language as $key => $item ) {
										echo "<span> {$key}</span> {$item} bytes<br/>";
									}
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
</div>
