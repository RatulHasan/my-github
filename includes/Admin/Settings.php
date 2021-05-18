<?php
/***
 * Menu class file
 *
 * @since 1.0.0
 *
 * @author Ratul Hasan <tanjilhasanratul@gmail.com>
 *
 * @package MyGitHub
 */

namespace My\GitHub\Admin;

use My\GitHub\Transient;

/**
 * Class SettingsApi
 *
 * @package Featured\Posts
 */
class Settings {

    /**
     * For storing sections.
     *
     * @var array
     */
    public $sections = array();

    /**
     * For registering fields
     *
     * @var array
     */
    public $register_setting = array();

    /**
     * For storing fields
     *
     * @var array
     */
    public $fields = array();

    /**
     * SettingsApi constructor.
     */
    public function __construct() {
        add_action( 'admin_init', array( $this, 'register_settings_page' ) );
        // Add TinyMC Button.
        add_filter( 'mce_external_plugins', array( $this, 'my_github_mce_external_plugins' ) );
        add_filter( 'mce_buttons', array( $this, 'my_github_mce_buttons' ) );
    }

    /**
     * External plugins
     *
     * @param array $plugins plugins.
     *
     * @return mixed
     */
    public function my_github_mce_external_plugins( array $plugins ) {
        $plugins['my_github_shortcode_mc_button'] = MY_GITHUB_ASSETS . '/my_github_qtags.min.js';
        return $plugins;
    }

    /**
     * Button for my github
     *
     * @param array $buttons all buttons.
     *
     * @return mixed
     */
    public function my_github_mce_buttons( array $buttons ) {
        $buttons[] = 'my_github_shortcode_button';
        return $buttons;
    }
    /**
     * Register settings page
     *
     * @return void
     */
    public function register_settings_page() {
        $this->sections = array(
            array(
                'id'       => 'my_github_section',
                'title'    => __( 'GitHub Settings', 'my-github' ),
                'callback' => '',
                'page'     => 'my-github',
            ),
            array(
                'id'       => 'my_github_template_section',
                'title'    => __( 'Template Settings', 'my-github' ),
                'callback' => '',
                'page'     => 'my-github',
            ),
            array(
                'id'       => 'my_github_view_section',
                'title'    => __( 'View Settings', 'my-github' ),
                'callback' => '',
                'page'     => 'my-github',
            ),
        );

        $this->register_setting = array(
            array(
                'option_group' => 'my_github_settings',
                'option_name'  => 'my_github_details',
            ),
        );

        // Values for input fields form transient api.
        $my_github_details = Transient::admin_my_github_details();

        $this->fields = array(
            array(
                'id'       => 'my_github_username',
                'title'    => __( 'GitHub Username', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_section',
                'args'     => array(
                    'label_for' => 'my_github_username',
                    'name'      => 'my_github_details[my_github_username]',
                    'type'      => 'text',
                    'value'     => isset( $my_github_details['my_github_username'] ) ? esc_attr( $my_github_details['my_github_username'] ) : '',
                ),
            ),
            array(
                'id'       => 'my_github_access_token',
                'title'    => __( 'Personal Access Token', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_section',
                'args'     => array(
                    'label_for' => 'my_github_access_token',
                    'name'      => 'my_github_details[my_github_access_token]',
                    'type'      => 'text',
                    'link'      => __( 'Don\'t have any Personal Access Token?', 'my-github' ) . ' <a href="https://github.com/settings/tokens" target="_blank">' . __( 'Create one?', 'my-github' ) . '</a>',
					'value'     => isset( $my_github_details['my_github_access_token'] ) ? esc_attr( $my_github_details['my_github_access_token'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_custom_template',
                'title'    => __( 'Show in custom template', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_template_section',
                'args'     => array(
                    'label_for' => 'is_show_in_custom_template',
                    'name'      => 'my_github_details[is_show_in_custom_template]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_in_custom_template'] ) ? esc_attr( $my_github_details['is_show_in_custom_template'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_followers',
                'title'    => __( 'Show Followers', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_view_section',
                'args'     => array(
                    'label_for' => 'is_show_followers',
                    'name'      => 'my_github_details[is_show_followers]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_followers'] ) ? esc_attr( $my_github_details['is_show_followers'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_following',
                'title'    => __( 'Show Following', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_view_section',
                'args'     => array(
                    'label_for' => 'is_show_following',
                    'name'      => 'my_github_details[is_show_following]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_following'] ) ? esc_attr( $my_github_details['is_show_following'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_company',
                'title'    => __( 'Show Company', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_view_section',
                'args'     => array(
                    'label_for' => 'is_show_company',
                    'name'      => 'my_github_details[is_show_company]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_company'] ) ? esc_attr( $my_github_details['is_show_company'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_location',
                'title'    => __( 'Show Location', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_view_section',
                'args'     => array(
                    'label_for' => 'is_show_location',
                    'name'      => 'my_github_details[is_show_location]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_location'] ) ? esc_attr( $my_github_details['is_show_location'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_email',
                'title'    => __( 'Show Email', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_view_section',
                'args'     => array(
                    'label_for' => 'is_show_email',
                    'name'      => 'my_github_details[is_show_email]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_email'] ) ? esc_attr( $my_github_details['is_show_email'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_blog',
                'title'    => __( 'Show Blog', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_view_section',
                'args'     => array(
                    'label_for' => 'is_show_blog',
                    'name'      => 'my_github_details[is_show_blog]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_blog'] ) ? esc_attr( $my_github_details['is_show_blog'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_twitter',
                'title'    => __( 'Show Twitter', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_view_section',
                'args'     => array(
                    'label_for' => 'is_show_twitter',
                    'name'      => 'my_github_details[is_show_twitter]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_twitter'] ) ? esc_attr( $my_github_details['is_show_twitter'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_public_repos',
                'title'    => __( 'Show Public Repos', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_view_section',
                'args'     => array(
                    'label_for' => 'is_show_my_github_public_repos',
                    'name'      => 'my_github_details[is_show_my_github_public_repos]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_my_github_public_repos'] ) ? esc_attr( $my_github_details['is_show_my_github_public_repos'] ) : '',
                ),
            ),
            array(
                'id'       => 'is_show_my_github_repos_language',
                'title'    => __( 'Show Repos Language', 'my-github' ),
                'callback' => array( $this, 'cb_my_github_input' ),
                'page'     => 'my-github',
                'section'  => 'my_github_view_section',
                'args'     => array(
                    'label_for' => 'is_show_my_github_repos_language',
                    'name'      => 'my_github_details[is_show_my_github_repos_language]',
                    'type'      => 'checkbox',
                    'value'     => 1,
                    'selected'  => isset( $my_github_details['is_show_my_github_repos_language'] ) ? esc_attr( $my_github_details['is_show_my_github_repos_language'] ) : '',
                ),
            ),
        );
        // Call register_custom_fields to initiate all settings.
        $this->register_custom_fields( $this->sections, $this->fields, $this->register_setting );
    }

    /**
     * Register and Initialize custom fields in a section
     *
     * @param  array $sections  Data for sections.
     * @param  array $fields  Data for input fields.
     * @param  array $register_setting  Data for register information.
     *
     * @return void
     */
    public function register_custom_fields( array $sections, array $fields, array $register_setting ) {

        // add settings section.
        if ( ! empty( $sections ) ) {
            foreach ( $sections as $section ) {
                add_settings_section(
                    $section['id'],
                    $section['title'],
                    ( isset( $section['callback'] ) ? $section['callback'] : '' ),
                    $section['page']
                );
            }
        }

        // register setting.
        foreach ( $register_setting as $setting ) {
            register_setting(
                $setting['option_group'],
                $setting['option_name'],
                ( isset( $setting['callback'] ) ? $setting['callback'] : '' )
            );
        }

        // add settings field.
        foreach ( $fields as $field ) {
            add_settings_field(
                $field['id'],
                $field['title'],
                ( isset( $field['callback'] ) ? $field['callback'] : '' ),
                $field['page'],
                $field['section'],
                ( isset( $field['args'] ) ? $field['args'] : '' )
            );
        }
    }

    /**
     * Callback for post per page
     *
     * @param  array $args  for getting extra information.
     *
     * @return void
     */
    public function cb_my_github_input( $args = array() ) {
        $type       = $args['type'];
        $input_type = array(
            'text',
            'number',
            'password',
            'number',
            'tel',
            'file',
            'email',
            'url',
        );

        $global_input = '<input id="' . $args['label_for'] . '" type="' . $args['type'] . '" class="regular-text" name="' . $args['name'] . '" value="' . $args['value'] . '" placeholder="Write GitHub username">';
        if ( isset( $args['link'] ) && ! empty( $args['link'] ) ) {
            $global_input .= '<p class="description">' . $args['link'] . '</p>';
        }
        if ( in_array( $args['type'], $input_type, true ) ) {
            $type = 'global_input';
        }

        $checkbox = '';
        if ( 'checkbox' === $args['type'] ) {
            if ( is_array( $args['value'] ) ) {
                $selected = is_array( $args['selected'] ) ? $args['selected'] : array();
                foreach ( $args['value'] as $key => $value ) {
                    $checkbox .= "<input id='{$args['label_for']}' type='{$args['type']}' name='{$args['name']}' value='{$value}' " . checked( in_array( $value, $selected, true ), 1, false ) . '>';
                }
            } else {
                $selected  = $args['selected'];
                $checkbox .= "<input id='{$args['label_for']}' type='{$args['type']}' name='{$args['name']}' value='{$args['value']}' " . checked( $selected, $args['value'], false ) . '>';
            }
        }

        $radio = '';
        if ( 'radio' === $args['type'] ) {
            $selected = ! is_array( $args['selected'] ) ? $args['selected'] : '';
            foreach ( $args['value'] as $value ) {
                $radio .= "<input id='{$args['label_for']}' type='{$args['type']}' name='{$args['name']}' value='{$value}' " . checked( $selected, $value, false ) . '>';
            }
        }

        $select = '';
        if ( 'select' === $args['type'] ) {
            $select = '<select class="regular-text" id="' . $args['label_for'] . '" name="' . $args['name'] . '">';
            foreach ( $args['value'] as $value ) {
                $select .= '<option value="' . esc_attr( $value ) . '" ' . selected( esc_attr( $args['selected'] ), esc_attr( $value ), false ) . '>' . esc_html( $value ) . '</option>';
            }
            $select .= '</select>';
        }
        switch ( $type ) {
            case 'checkbox':
                echo wp_kses(
                    $checkbox,
                    array(
                        'input' => array(
                            'id'      => array( $args['label_for'] ),
                            'type'    => array( ' checkbox' ),
                            'name'    => array( $args['name'] ),
                            'value'   => array( $args['value'] ),
                            'checked' => array( $args['selected'] ),
                        ),
                    )
                );
                break;
            default:
                echo wp_kses(
                    $global_input,
                    array(
                        'input' => array(
                            'id'    => array( $args['label_for'] ),
                            'type'  => array( ' checkbox' ),
                            'name'  => array( $args['name'] ),
                            'value' => array( $args['value'] ),
                        ),
                        'a'     => array(
                            'href' => array(),
                        ),
                        'p'     => array(),
                    )
                );
                break;
        }
    }

}
