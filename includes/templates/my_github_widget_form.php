<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'my-github' ); ?></label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>">
</p>
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'show_avatar' ) ); ?>">
    <input name="<?php echo esc_attr( $this->get_field_name( 'show_avatar' ) ); ?>" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_avatar' ) ); ?>" value="1" <?php checked( "1" === $show_avatar, 1 ); ?>><?php echo esc_html__( 'Show/Hide profile avatar' ); ?></label>
</p>
