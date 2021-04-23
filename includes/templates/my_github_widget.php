<div class="plugin-side-options">
    <?php if ( $show_avatar ): ?>
    <img class="widget-avatar-image-circle" src="<?php echo esc_url( $body->avatar_url ); ?>" alt="<?php echo esc_attr( $body->name ); ?>">
    <?php endif; ?>
    <h5>
        <a class="text-decoration-none" href="<?php echo esc_url( $body->html_url ); ?>" target="_blank"><?php echo esc_html( $body->name ); ?></a>
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
