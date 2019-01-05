<?php
/**
 * Theme options
 */

function mount_settings_menu() {
    add_menu_page( 'Mount Horrocks settings', 'MH Settings', 'administrator', 'mount-settings-page', 'mount_settings_page', 'dashicons-admin-generic', 21  );
    add_action( 'admin_init', 'mount_settings_page_admin' );
}

function mount_settings_page_admin() {

    register_setting( 'gsp-group', 'home_img' );

    for ( $i=1 ; $i<=3 ; $i++ ) {
        register_setting( 'gsp-group', 'home_quote_'.$i );
        register_setting( 'gsp-group', 'home_source_'.$i );
    }

    register_setting( 'gsp-group', 'g_facebook' );
    register_setting( 'gsp-group', 'g_twitter' );
    register_setting( 'gsp-group', 'g_instagram' );
    register_setting( 'gsp-group', 'g_tripadvisor' );
    register_setting( 'gsp-group', 'g_location' );
    register_setting( 'gsp-group', 'google_analytics' );

    for ( $i=1 ; $i<=3 ; $i++ ) {
        register_setting( 'gsp-group', 'g_quote_'.$i );
        register_setting( 'gsp-group', 'g_source_'.$i );
        register_setting( 'gsp-group', 'g_image_'.$i );
    }

    for ( $i=1 ; $i<=3 ; $i++ ) {
        register_setting( 'gsp-group', 'g_title_'.$i );
        register_setting( 'gsp-group', 'g_text_'.$i );
        register_setting( 'gsp-group', 'g_button_'.$i );
        register_setting( 'gsp-group', 'g_img_url_'.$i );
        register_setting( 'gsp-group', 'g_url_'.$i );
    }
}

function mount_settings_page() {
    if (!current_user_can('administrator'))  {
        wp_die( __('You do not have sufficient pilchards to access this page.')    );
    }
    ?>
    <style>
        .g-admin input[type=text] {
            width: 100%;
            max-width: 320px;
        }
        .g-admin textarea {
            width: 100%;
            max-width: 320px;
            height: 12em;
        }
    </style>
    <div class="wrap g-admin">
        <h1>Mount Horrocks theme settings</h1>
        <form method="post" action="options.php" novalidate="novalidate">
            <?php settings_fields( 'gsp-group' ); ?>
            <?php do_settings_sections( 'gsp-group' ); ?>

            <h2>Homepage hero banner</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="home_img">Header image URL</label></th>
                    <td><input type="text" name="home_img" value="<?php echo get_option('home_img'); ?>" /></td>
                    <td>Image size 1600px x 900px max</td>
                </tr>
            </table>
            <?php for ( $i=1 ; $i<=3 ; $i++ ) { ?>
            <h3>Quote <?php echo $i; ?></h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="home_quote_<?php echo $i; ?>">Quote</label></th>
                    <td><textarea name="home_quote_<?php echo $i; ?>" style="height: 4em;"><?php echo esc_attr( get_option('home_quote_'.$i) ); ?></textarea></td>
                    <td>12 words max</td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="home_source_<?php echo $i; ?>">Quote source</label></th>
                    <td><input type="text" name="home_source_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('home_source_'.$i) ); ?>" /></td>
                    <td>9 words max</td>
                </tr>
            </table>
            <?php } ?>
            <?php submit_button(); ?>

            <h2>Call to action</h2>
            <?php for ( $i=1 ; $i<=3 ; $i++ ) { ?>
                <hr>
                <h3>Section <?php echo $i; ?> </h3>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="g_title_<?php echo $i; ?>">Title</label></th>
                        <td><input type="text" name="g_title_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('g_title_'.$i) ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="g_text_<?php echo $i; ?>">Text</label></th>
                        <td><input type="text" name="g_text_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('g_text_'.$i) ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><label for="g_button_<?php echo $i; ?>">Button label</label></th>
                        <td><input type="text" name="g_button_<?php echo $i; ?>" value="<?php echo esc_attr( get_option('g_button_'.$i) ); ?>" /></td>
                    </tr>
                    <!-- <tr valign="top">
                        <th scope="row"><label for="g_img_url_<?php echo $i; ?>">Image URL</label></th>
                        <td><input type="text" name="g_img_url_<?php echo $i; ?>" value="<?php echo get_option('g_img_url_'.$i); ?>" /></td>
                    </tr> -->
                    <tr valign="top">
                        <th scope="row"><label for="g_url_<?php echo $i; ?>">Button URL</label></th>
                        <td><input type="text" name="g_url_<?php echo $i; ?>" value="<?php echo get_option('g_url_'.$i); ?>" /></td>
                    </tr>
                </table>
            <?php } ?>
            <?php submit_button(); ?>

            <h2>Site settings</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="g_location">Location</label></th>
                    <td><input type="text" name="g_location" value="<?php echo get_option('g_location'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="g_facebook">Facebook</label></th>
                    <td><input type="text" name="g_facebook" value="<?php echo esc_attr( get_option('g_facebook') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="g_twitter">Twitter</label></th>
                    <td><input type="text" name="g_twitter" value="<?php echo esc_attr( get_option('g_twitter') ); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="g_instagram">Instragram</label></th>
                    <td><input type="text" name="g_instagram" value="<?php echo get_option('g_instagram'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="g_tripadvisor">Tripadvisor code</label></th>
                    <td><textarea name="g_tripadvisor"><?php echo esc_attr( get_option('g_tripadvisor') ); ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="google_analytics">Google analytics code</label></th>
                    <td><textarea name="google_analytics"><?php echo esc_attr( get_option('google_analytics') ); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
