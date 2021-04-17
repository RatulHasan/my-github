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

<!--    "id": "15979901017",-->
<!--    "type": "PushEvent",-->
<!--    "actor": {-->
<!--    "id": 25820987,-->
<!--    "login": "feralEndre",-->
<!--    "display_login": "feralEndre",-->
<!--    "gravatar_id": "",-->
<!--    "url": "https://api.github.com/users/feralEndre",-->
<!--    "avatar_url": "https://avatars.githubusercontent.com/u/25820987?"-->
<!--    },-->
<!--    "repo": {-->
<!--    "id": 242581878,-->
<!--    "name": "feralEndre/sensorinfo",-->
<!--    "url": "https://api.github.com/repos/feralEndre/sensorinfo"-->
<!--    },-->
<!--    "payload": {-->
<!--    "push_id": 6932209608,-->
<!--    "size": 1,-->
<!--    "distinct_size": 1,-->
<!--    "ref": "refs/heads/master",-->
<!--    "head": "6ca0af93545df6010907d09c277753c21b587a48",-->
<!--    "before": "934ce63206205e1f5e83fcd0b108ee285856bc30",-->
<!--    "commits": [-->
<!--    {-->
<!--    "sha": "6ca0af93545df6010907d09c277753c21b587a48",-->
<!--    "author": {-->
<!--    "email": "endre.barcs@gmail.com",-->
<!--    "name": "feralEndre"-->
<!--    },-->
<!--    "message": "sensor data Sat, 17 Apr 2021 17:50:02 +0200",-->
<!--    "distinct": true,-->
<!--    "url": "https://api.github.com/repos/feralEndre/sensorinfo/commits/6ca0af93545df6010907d09c277753c21b587a48"-->
<!--    }-->
<!--    ]-->
<!--    },-->
<!--    "public": true,-->
<!--    "created_at": "2021-04-17T15:50:05Z"-->
<!--    },-->
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
                    </a>
                    in <a class="text-decoration-none" href="<?php echo 'https://github.com/' . esc_attr( $value->repo->name ); ?>" target="_blank">
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
