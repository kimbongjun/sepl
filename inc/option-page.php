<?php
// create custom plugin settings menu
add_action('admin_menu', 'campus_setting_create_menu');

function campus_setting_create_menu() {

    //create new top-level menu
    add_menu_page('캠퍼스 설정', '캠퍼스 설정', 'administrator', __FILE__, 'campus_settings_page' , plugins_url('/images/icon.png', __FILE__) );

    //call register settings function
    add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
    //register our settings
    register_setting( 'my-cool-plugin-settings-group', 'campus_code' );
    register_setting( 'my-cool-plugin-settings-group', 'campus_name' );
//    register_setting( 'my-cool-plugin-settings-group', 'some_other_option' );
//    register_setting( 'my-cool-plugin-settings-group', 'option_etc' );
}

function campus_settings_page() {
    ?>
    <div class="wrap">
        <h1>학원 설정</h1>

        <form method="post" action="options.php">
            <?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
            <?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">캠퍼스코드</th>
                    <td><input type="text" name="campus_code" value="<?php echo esc_attr( get_option('campus_code') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">학원명</th>
                    <td><input type="text" name="campus_name" value="<?php echo esc_attr( get_option('campus_name') ); ?>" /></td>
                </tr>
            </table>

            <?php submit_button(); ?>

        </form>
    </div>
<?php } ?>