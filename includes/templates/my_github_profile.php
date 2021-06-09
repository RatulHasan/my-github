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
        echo esc_html( $git_name );
        ?>
    </h1>
    <div class="pure-g">
        <div class="pure-u-1-4" style='height:100vh;'>
            <div class="plugin-side-options">
                <img class="img-fluid avatar-image-circle" src="<?php echo esc_url( $body->avatar_url ); ?>" alt="<?php echo esc_attr( $body->name ); ?>">
                <h5>
                    <a class="text-decoration-none" href="<?php echo esc_url( $body->html_url ); ?>" target="_blank"><?php echo esc_html( $body->name ); ?></a>
                </h5>
                <b class="small"><?php echo esc_html( $body->bio ); ?></b>
                <hr />
                <?php
                if ( isset( $this->admin_details['is_show_followers'] ) ) {
                    ?>
                    <div class="small">
                        <i class="fas fa-user"></i> <strong><?php echo esc_html( $body->followers ); ?> </strong> Followers
                    </div>
                    <?php
                }
                if ( isset( $this->admin_details['is_show_following'] ) ) {
                    ?>
                    <div class="small">
                        <i class="far fa-user"></i> <strong><?php echo esc_html( $body->following ); ?></strong> Following
                    </div>
                    <?php
                }

                if ( isset( $this->admin_details['is_show_company'] ) ) {
                    if ( isset( $body->company ) ) {
                        ?>
                        <div class="small">
                            <i class="far fa-building"></i> <?php echo esc_html( $body->company ); ?>
                        </div>
                        <?php
                    }
                }

                if ( isset( $this->admin_details['is_show_location'] ) ) {
                    if ( isset( $body->location ) ) {
                        ?>
                        <div class="small">
                            <i class="fas fa-street-view"></i> <?php echo esc_html( $body->location ); ?>
                        </div>
                        <?php
                    }
                }

                if ( isset( $this->admin_details['is_show_email'] ) ) {
                    if ( isset( $body->email ) ) {
                        ?>
                        <div class="small">
                            <i class="far fa-envelope"></i>
                            <a class="text-decoration-none" href="mailto:<?php echo esc_html( $body->email ); ?>"><?php echo esc_html( $body->email ); ?></a>
                        </div>
                        <?php
                    }
                }

                if ( isset( $this->admin_details['is_show_blog'] ) ) {
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

                if ( isset( $this->admin_details['is_show_twitter'] ) ) {
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
                <?php
                if ( isset( $this->admin_details['is_show_my_github_public_repos'] ) ) {
					$url = $body->repos_url . '?sort=pushed_at&order=desc';
					if ( isset( $_GET['repo_page'] ) ) {
                        if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'my_repo_page_nonce' ) ) {
                            die( esc_html__( 'Security check failed!', 'my-github' ) );
                        }
						$url = $body->repos_url . '?sort=pushed_at&order=desc&page=' . $_GET['repo_page'];
					}
                    $url = esc_url_raw( $url );
					$repos_url = Transient::get_my_github_details( $url );
					if ( empty( $repos_url ) ) {
					    return false;
                    }
					$showing = '1-' . count( $repos_url ) . ' Public Repositories';

					$ol_start = '1';
					if ( isset( $_GET['repo_page'] ) ) {
						$showing  = ( ( $_GET['repo_page'] - 1 ) * 30 ) + 1 . '-' . ( count( $repos_url ) + ( ( $_GET['repo_page'] - 1 ) * 30 ) ) . ' Public Repositories';
						$ol_start = ( ( $_GET['repo_page'] - 1 ) * 30 ) + 1;
					}
					?>
                <span class="small"> Showing <?php echo esc_html( $showing ); ?></span> of total
                <b> <?php echo esc_html( $body->public_repos ); ?></b>
                <hr />
					<?php
					if (  empty( $repos_url ) ) {
                        echo '<h4>Repositories are disallowed by the user.</h4>';
                        return false;
                    }
						echo '<ol start=' . esc_attr( $ol_start ) . '>';
						foreach ( $repos_url as $repos ) {
							?>
                <li>
                    <a class="text-decoration-none" href="<?php echo esc_url( $repos->html_url ); ?>" target="_blank">
                        <strong class="font-big"><?php echo esc_attr( $repos->name ); ?></strong>
                    </a>
							<?php
							if ( $repos->fork ) {
								echo ' (Forked)';
							}
							$is_ml = '';
							echo '<div>';
                            if ( $repos->language ) {
                                echo '<span class="dot"></span> ' . esc_attr( $repos->language );
                                $is_ml = 'ml-25';
                            }
							if ( $repos->stargazers_count ) {
								echo '<i class="far fa-star ' . esc_attr( $is_ml ) . '"></i> ' . esc_attr( $repos->stargazers_count );
                                $is_ml = 'ml-25';
							}
							if ( $repos->watchers_count ) {
								echo ' <i class="far fa-eye ' . esc_attr( $is_ml ) . '"></i> ' . esc_attr( $repos->watchers_count );
                                $is_ml = 'ml-25';
							}
							if ( $repos->forks_count ) {
								echo '<i class="fas fa-code-branch ' . esc_attr( $is_ml ) . '"></i> ' . esc_attr( $repos->forks_count );
                                $is_ml = 'ml-25';
							}
							if ( $repos->license ) {
								echo '<i class="fas fa-balance-scale ' . esc_attr( $is_ml ) . '"></i> ' . esc_attr( $repos->license->name );
                                $is_ml = 'ml-25';
                            }
							if ( $repos->pushed_at ) {
								echo '<span class="' . esc_attr( $is_ml ) . '"><i class="far fa-clock"></i> Updated '. human_time_diff(strtotime( $repos->pushed_at ) ) .' ago</span> ';
							}
							echo '</div>';
							if ( $repos->description ) {
								echo '<div>' . esc_attr( $repos->description ) . '</div>';
							}

							if ( isset( $this->admin_details['is_show_my_github_repos_language'] ) ) {
								$language_url = 'https://api.github.com/repos/' . esc_html( $body->login ) . '/' . esc_html( $repos->name )
                                        . '/languages';
								$language     = Transient::get_my_github_details( $language_url );
								if ( ! empty( (array) $language ) ) {
									?>
                            <div class="font-medium">Language used</div>
									<?php
									foreach ( $language as $key => $item ) {
										echo '<span>' . esc_html( $key ) . '</span> ' . esc_html( $item ) . ' bytes<br/>';
									}
								}
								?>
								<?php
							}
							echo '</li><hr/>';
						}
						echo '</ol>';
						$count_repos = count( $repos_url );
						if ( $body->public_repos > $count_repos ) {
							$total_pages = ceil( $body->public_repos / 30 );
                            $nonce       = wp_create_nonce( 'my_repo_page_nonce' );
							$next_page   = '<a class="ml-25" href=' . get_permalink() . '?repo_page=2&_wpnonce=' . $nonce . '>Next &raquo;</a>';
                            $pre_page = '';
							if ( isset( $_GET['repo_page'] ) ) {
								$pre_page = '<a href=' . esc_url_raw( get_permalink() . '?repo_page=' . ( $_GET['repo_page'] - 1 ) . '&_wpnonce=' . $nonce ). '>&laquo; Previous</a> ';
								if ( 2 == $_GET['repo_page'] ) {
									$pre_page = '<a href=' . esc_url_raw (get_permalink() ) . '>&laquo; Previous</a> ';
								}
								$next_page = '<a class="ml-25" href=' . esc_url_raw( get_permalink() . '?repo_page=' . ( $_GET['repo_page'] + 1 ) . '&_wpnonce=' . $nonce ) . '>Next &raquo;</a>';
								if ( $_GET['repo_page'] >= $total_pages ) {
									$next_page = '';
								}
							}
							echo wp_kses(
                                $pre_page,
                                array(
									'a' => array(
										'href'  => array(),
										'title' => array(),
									),
                                )
                            );
							echo wp_kses(
                                $next_page,
                                array(
									'a' => array(
										'href'  => array(),
										'title' => array(),
                                        'class' => array(),
									),
                                )
                            );
//                            $big = 999999999;
//                            $current = isset( $_GET['repo_page']) ? $_GET['repo_page'] : 1;
//                            echo paginate_links(
//                                array(
////                                    'base'    => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
//                                    'format'  => '?page=%#%',
//                                    'current' => $current,
//                                    'total'   => $total_pages,
//                                )
//                            );
						}
                    }
				?>
            </div>
        </div>
    </div>
</div>
