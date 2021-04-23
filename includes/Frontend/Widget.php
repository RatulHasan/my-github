<?php
/***
 * Widget class
 *
 * @since 1.1.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package MyGitHub
 */

namespace My\GitHub\Frontend;

use My\GitHub\Transient;

/**
 * Class Widget
 *
 * @package Widget
 */
class Widget extends \WP_Widget {
    /**
     * Widget constructor
     */
    public function __construct() {
        parent::__construct(
            'my-github',
            __( 'My GitHub', 'my-github' ),
            array( 'description' => __( 'Showcase your GitHub profile.', 'my-github' ) )
        );

        add_action( 'widgets_init', array( $this, 'register_github_widget' ) );
    }

    /**
     * Register GitHub widget
     *
     * @return void
     */
    public function register_github_widget() {
        register_widget( 'My\GitHub\Frontend\Widget' );
    }

    /**
     * Display widget to the frontend
     *
     * @param array $args       Widget args
     * @param array $instance   Holds widget form data
     *
     * @return void
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        echo '<div class="textwidget">';

        $my_github_details = Transient::admin_my_github_details();

        if ( empty( $my_github_details['my_github_username'] ) ) {
            return false;
        }

        $body = Transient::get_github_root();

        if ( $body ) {
            $git_name    = __( 'GitHub Profile', 'my-github' );
            $git_name    = apply_filters( 'git_name_header', $git_name );
            $show_avatar = $instance['show_avatar'];
            include_once MY_GITHUB_INCLUDE_PATH . '/templates/my_github_widget.php';
        }

        echo '</div>';

        echo $args['after_widget'];
    }

    /**
     * Widget settings form
     *
     * @param $instance
     *
     * @return void
     */
    public function form( $instance ) {
        $title       = ( ! empty( $instance['title'] ) ) ? esc_attr( $instance['title'] ) : '';
        $show_avatar = ( ! empty( $instance['show_avatar'] ) ) ? esc_attr( $instance['show_avatar'] ) : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'my-github' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_avatar' ) ); ?>">
                <input name="<?php echo esc_attr( $this->get_field_name( 'show_avatar' ) ); ?>" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_avatar' ) ); ?>" value="1" <?php checked( "1" === $show_avatar, 1 ); ?>><?php echo esc_html__( 'Show/Hide profile avatar' ); ?></label>
        </p>
        <?php
    }

    /**
     * Save widget form value
     *
     * @param array $new_instance New form value
     * @param array $old_instance Old form value saved in db
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title']       = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['show_avatar'] = ( ! empty( $new_instance['show_avatar'] ) ) ? sanitize_text_field( $new_instance['show_avatar'] ) : '';

        return $instance;
    }
}
