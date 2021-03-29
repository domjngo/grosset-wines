<?php

function set_value( $name, $type = 'text', $select_value = '' ) {
    if ( isset( $_POST[$name] ) ) {
        switch( $type ) {
            case 'text': {
                return ' value="' . htmlspecialchars( trim( $_POST[$name] ) ) . '" ';
                break;
            }
            case 'textarea': {
                if ( trim( $_POST[$name] ) !== '' ) {
                    return htmlspecialchars( $_POST[$name] );
                }
                return '';
                break;
            }
            case 'checkbox': {
                return ' checked="checked" ';
                break;
            }
            case 'radio': {
                if( $_POST[$name] == $select_value ){
                    return ' checked="checked" ';
                }
                break;
            }
            case 'select': {
                if ( $_POST[$name] == $select_value ) {
                    return ' selected="selected" ';
                }
                break;
            }
        }
    }
    return '';
}

function form_token() {
    $token = md5( uniqid( "", true ) );
    // Save token and keep for 1 hour
    set_transient( 'token-'.$token, $token, HOUR_IN_SECONDS );
    return $token;
}

function members_form() {

    $token = form_token();

    $form = '
     <form action=""  id="members" method="POST">
        <input type="hidden" name="token" value="' . $token . '">
        <input type="hidden" name="timestamp" value="' . time() . '">
        <fieldset>
	        <div class="form-row">
                <label for="first_name">First name</label>
                <input type="text" id="first_name" name="first_name" ' . set_value( 'first_name' ) . '>
            </div>
            <div class="form-row">
                <label for="last_name">Last name</label>
                <input type="text" id="last_name" name="last_name" ' . set_value( 'last_name' ) . '>
            </div>
            <div class="form-row">
                <label for="email">Email address (required)</label>
                <input type="email" id="email" name="email" aria-required="true" required ' . set_value( 'email' ) . '>
            </div>
            <div class="form-row">
                <label for="number">Telephone or mobile number (required)</label>
                <input type="tel" id="number" name="number" aria-required="true" required ' . set_value( 'number' ) . '>
            </div>
            <div class="form-row">
                <label for="address">Postal address</label>
                <input type="text" id="address" name="address" ' . set_value( 'address' ) . '>
            </div>
            <div class="form-row">
                <label for="city">City</label>
                <input type="text" id="city" name="city" ' . set_value( 'city' ) . '>
            </div>
            <div class="form-row">
                <label for="state">State</label>
                <input type="text" id="state" name="state" ' . set_value( 'state' ) . '>
            </div>
            <div class="form-row">
                <label for="postcode">Postcode</label>
                <input type="text" id="postcode" name="postcode" ' . set_value( 'postcode' ) . '>
            </div>
            <div class="form-row form-message">
                <label for="message">Message</label>
                <input type="text" id="message" name="message">
            </div>
            <div class="form-row">
                <p><small><strong>Terms and conditions:</strong> By providing your contact details you subscribe to receive future special offers, wine release information 
                    and items exclusive to members from Grosset Wines and from our agents until such time as you request us to stop. 
                    Should you wish to opt out at any time simply let us know by phone or email. We will provide you with appropriate 
                    contact details every time we contact you.</small></p>
            </div>
            <div class="form-row">
                <input class="btn btn-primary btn-lg" type="submit" alt="Submit" name="member-submit" id="members-submit" value="Submit">
            </div>
        </fieldset>
    </form>
    ';

    return $form . disclaimer();
}

function call_back() {

    $token = form_token();

    $form = '
     <form action=""  id="members" method="POST">
        <input type="hidden" name="token" value="' . $token . '">
        <input type="hidden" name="timestamp" value="' . time() . '">
        <fieldset>
            <div class="form-row">
                <label for="contact_name">Name (optional)</label>
                <input type="text" id="contact_name" name="contact_name" ' . set_value( 'contact_name' ) . '>
            </div>
            <div class="form-row">
                <label for="number">Telephone or mobile number (required)</label>
                <input type="tel" id="number" name="number" aria-required="true" required ' . set_value( 'number' ) . '>
            </div>
            <div class="form-row form-message">
                <label for="message">Message</label>
                <input type="text" id="message" name="message">
            </div>
            <div class="form-row">
                <input class="btn btn-primary btn-lg" type="submit" alt="Submit" name="call-back-submit" id="members-submit" value="Request call back">
            </div>
        </fieldset>
    </form>
    ';

    return $form;

}

add_shortcode( 'call-back-form', 'call_back_shortcode' );
function call_back_shortcode() {

    if ( ! is_admin() && isset( $_POST['call-back-submit'] ) ) {

        // Is spam?
        if (  isset( $_POST['message'] ) ) {
            if ( trim($_POST['message'] ) != '' ) {
                // Spam!!
                return;
            }
        }
        if (  isset( $_POST['token'] ) ) {

            $token = filter_input( INPUT_POST, 'token' );
            $saved_token = get_transient( 'token-'.$token );

            if ( !$saved_token ) {
                // Spam!!
                return;
            } else {
                delete_transient( 'token-'.$token );
            }
        }
        if (  isset( $_POST['timestamp'] ) ) {

            if ( $_POST['timestamp'] + 3 > time() ) {
                // Spam!!
                echo members_form();
                return;
            }
        }

        // Process form
        $number = filter_input( INPUT_POST, 'number' );
        $name = filter_input( INPUT_POST, 'contact_name' );

        $form_content = '
        <p>Someone requested a call back for to purchase wine.</p>
        <p>Name : '.$name.'</p>
        <p>Telephone : '.$number.'</p>
        ';

        echo '<div class="alert alert-success"><p><strong>Thank you! Your request was sent successfully.</strong></p></div>';

        $email_headers = 'From: Grosset Wines <sales@grosset.com.au>';

        add_filter('wp_mail_content_type', function( $content_type ) {
            return 'text/html';
        });

        wp_mail( 'grossetsales@gmail.com', 'Membership call back request', $form_content, $email_headers );
        wp_mail( 'cb.creatistic@gmail.com', 'Membership call back request', $form_content, $email_headers );

    } else {
        return call_back();
    }
}

add_shortcode( 'member-form', 'member_shortcode' );
function member_shortcode() {

    if ( ! is_admin() && isset( $_POST['member-submit'] ) ) {

        // Is spam?
        if (  isset( $_POST['message'] ) ) {
            if ( trim($_POST['message'] ) != '' ) {
                // Spam!!
                return;
            }
        }
        if (  isset( $_POST['token'] ) ) {

            $token = filter_input( INPUT_POST, 'token' );
            $saved_token = get_transient( 'token-'.$token );

            if ( !$saved_token ) {
                // Spam!!
                return;
            } else {
                delete_transient( 'token-'.$token );
            }
        }
        if (  isset( $_POST['timestamp'] ) ) {

            if ( $_POST['timestamp'] + 3 > time() ) {
                // Spam!!
                echo members_form();
                return;
            }
        }

        // Process form
        $name = filter_input( INPUT_POST, 'first_name' );
        $surname = filter_input( INPUT_POST, 'last_name' );
        $email = filter_input( INPUT_POST, 'email' );
        $number = filter_input( INPUT_POST, 'number' );
        $address = filter_input( INPUT_POST, 'address' );
        $city = filter_input( INPUT_POST, 'city' );
        $state = filter_input( INPUT_POST, 'state' );
        $postcode = filter_input( INPUT_POST, 'postcode' );

        $form_content = '
        <p>Name : '.$name.' '.$surname.'</p>
        <p>Email : '.$email.'</p>
        <p>Telephone : '.$number.'</p>
        <p>Address : '.$address.'</p>
        <p>City : '.$city.'</p>
        <p>State : '.$state.'</p>
        <p>Postcode : '.$postcode.'</p>
        ';

        echo '<div class="alert alert-success"><p><strong>Thank you! Your request was sent successfully.</strong></p></div>';

        $email_headers = 'From: Grosset Wines <sales@grosset.com.au>';

        add_filter('wp_mail_content_type', function( $content_type ) {
            return 'text/html';
        });

        wp_mail( 'grossetsales@gmail.com', 'Membership request', $form_content, $email_headers );
        wp_mail( 'cb.creatistic@gmail.com', 'Membership request', $form_content, $email_headers );

        $thanks = thanks( $name );

        wp_mail( $email, 'Thank you for signing up to join the Grosset Wine Club', $thanks, $email_headers );

    } else {
        return members_form();
    }
}

function thanks( $name ) {

    $thanks = '
    <p><img src="https://www.grosset.com.au/wp-content/themes/grosset3/img/Grosset-Logo.png"></p>
    <p>Dear '.$name.',</p>
    <p>Thank you for signing up to join the <strong>Grosset Wine Club</strong>.</p>
    <p>There is currently a high demand to join the Grosset Wine Club so please allow 14 days for your membership to be confirmed. 
    We will notify you as soon as you are signed up. </p>
    <p>In the meantime if you have any queries, please don’t hesitate to call the office on 1800 088 223.</p>
    <p>Warm regards,<br><a href="https://www.grosset.com.au">Grosset Wines</a></p>
    ';

    return $thanks;
}

function disclaimer() {

    $disclaimer = '';

    return $disclaimer;
}

function register_page_css() {
    if ( isset( $_GET['register'] ) && $_GET['register'] == true ) {
        return '<style>
.woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1 {
    display: none;
}
.woocommerce .col2-set .col-2, .woocommerce-page .col2-set .col-2 {
    float: left;
    width: 100%
}
.g-recaptcha {
    margin: 1.6em 0;
}
.g-recaptcha iframe {
    margin: 0;
}
</style>';
    } else {
        return '<style>
.woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1 {
    float: left;
    width: 100%
}
.woocommerce .col2-set .col-2, .woocommerce-page .col2-set .col-2 {
    display: none;
}
.g-recaptcha {
    margin: 1.6em 0;
}
.g-recaptcha iframe {
    margin: 0;
}
</style>';
    }
}

function gw_wc_extra_register_fields() {
    echo register_page_css();
    ?>
    <p class="form-row form-row-wide">
        <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" required>
    </p>
    <p class="form-row form-row-wide">
        <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" required>
    </p>
    <p class="form-row form-row-wide">
        <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" required>
    </p>
    <div class="clear"></div>
    <?php
}
add_action( 'woocommerce_register_form_start', 'gw_wc_extra_register_fields' );

function gw_wc_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['register'] ) ) {
        update_user_meta( $customer_id, 'customer_status', 'grosset-club-members' );
    }
    if ( isset( $_POST['billing_phone'] ) ) {
        update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
    }
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    }
}
add_action( 'woocommerce_created_customer', 'gw_wc_save_extra_register_fields' );

// prevents the user from logging in automatically after registering their account
function gw_wc_registration_redirect( $redirect_to ) {
    wp_logout();
    wp_redirect( '/my-club-account/?n=true');
    exit;
}

// when the user logs in, checks whether their email is verified
function gw_wc_authenticate_user( $userdata ) {
    $has_activation_status = get_user_meta($userdata->ID, 'is_activated', false);
    // checks if this is an older account without activation status; skips the rest of the function if it is
    if ($has_activation_status) {
        $isActivated = get_user_meta($userdata->ID, 'is_activated', true);
        if ( !$isActivated ) {
            // resends the activation mail if the account is not activated
            my_user_register( $userdata->ID );
            $userdata = new WP_Error(
                'my_theme_confirmation_error',
                __( '<strong>Error:</strong> Your account has to be activated before you can login. Please click the link in the activation email that has been sent to you.<br /> If you do not receive the activation email within a few minutes, check your spam folder or <a href="/my-club-account/?u='.$userdata->ID.'">click here to resend it</a>.' )
            );
        }
    }
    return $userdata;
}

// when a user registers, sends them an email to verify their account
function gw_wc_user_register($user_id) {
    $user_info = get_userdata($user_id);
    $user_phone = get_user_meta( $user_id, 'billing_phone', true );
    $user_first_name = get_user_meta( $user_id, 'first_name', true );
    $user_last_name = get_user_meta( $user_id, 'last_name', true );
    $code = md5(time());
    $string = array('id'=>$user_id, 'code'=>$code);
    update_user_meta($user_id, 'is_activated', 0);
    update_user_meta($user_id, 'activationcode', $code);
    $url = get_site_url(). '/my-club-account/?member=' .base64_encode( serialize($string));
    $user_html = ( '<p><img src="https://www.grosset.com.au/wp-content/themes/grosset-wines/img/grosset-logo.png"></p>
        <h1>Your Grosset Wine Club account</h1>
        <p>Thank you for your interest in becoming a <strong>Grosset Wine Club Member</strong>. You’re nearly there!</p>
        <p>Within the next 48 hours, Sharna, Kath or Kim from our winery will contact you to finalise your first order and
        your account will be activated. If you prefer, you can call us on 1800 088 223.</p>
        <p>Remember, once you purchase six bottles or more, your membership is valid for 12 months.</p>
        <p>Warm regards,<br><a href="https://www.grosset.com.au">Grosset Wines</a></p>' );
    $gw_html = ( '<p><img src="https://www.grosset.com.au/wp-content/themes/grosset-wines/img/grosset-logo.png"></p>
        <h1>New Grosset Wine Club member account</h1>
        <p>Name: '.$user_first_name.' '.$user_last_name.'</p>
        <p>Phone: '.$user_phone.'</p>
        <p>Email: '.$user_info->user_email.'</p>
        <p><a href="'.$url.'"><strong>Click here to activate this account</strong></a>.</p>' );
    wc_mail('grossetwines@gmail.com', __( 'New Grosset Wine Club member account' ), $gw_html);
    wc_mail('cb.creatistic@gmail.com', __( 'New Grosset Wine Club member account' ), $gw_html);
    wc_mail($user_info->user_email, __( 'Your Grosset Wine Club member account' ), $user_html);
    wc_mail('cb.creatistic@gmail.com', __( 'Your Grosset Wine Club member account' ), $user_html);
}

// handles all this verification stuff
function gw_wc_verification_init() {
    // If accessed via an authentification link
    if(isset($_GET['member'])) {
        $data = unserialize(base64_decode($_GET['member']));
        $code = get_user_meta($data['id'], 'activationcode', true);
        // checks if the account has already been activated. We're doing this to prevent someone from logging in with an outdated confirmation link
        $isActivated = get_user_meta($data['id'], 'is_activated', true);
        // generates an error message if the account was already active
        if( $isActivated ) {
            wc_add_notice( __( 'This account has already been activated. Please log in with your username and password.' ), 'error' );
        }
        elseif($code) {
            // checks whether the decoded code given is the same as the one in the database
            if($code == $data['code']) {
                // updates the database upon successful activation
                update_user_meta($data['id'], 'is_activated', 1);
                // logs the user in
                $user_id = $data['id'];
                $user = get_user_by( 'id', $user_id );
                if( $user ) {
                    wp_set_current_user( $user_id, $user->user_login );
                    wp_set_auth_cookie( $user_id );
                    do_action( 'wp_login', $user->user_login, $user );
                }
                wc_add_notice( __( '<strong>Success:</strong> Your account has been activated! You have been logged in and can now use the site to its full extent.' ), 'notice' );
                $content = $user->user_login.' has activated their account.';
                $subject = 'New membership activated';
                $header = 'From: Grosset Wines <sales@grosset.com.au>';
                wp_mail( 'grossetsales@gmail.com', $subject, $content, $header );
                wp_mail( 'cb.creatistic@gmail.com', $subject, $content, $header );
            } else {
                $user_id = $data['id'];
                wc_add_notice( __( '<strong>Error:</strong> Account activation failed. Please try again in a few minutes or <a href="/my-club-account/?u='.$user_id.'">resend the activation email</a>.<br />Please note that any activation links previously sent lose their validity as soon as a new activation email gets sent.<br />If the verification fails repeatedly, please contact our administrator.' ), 'error' );
            }
        }
    }
    // If resending confirmation mail
    if(isset($_GET['u'])){
        gw_wc_user_register($_GET['u']);
        wc_add_notice( __( 'Your activation email has been resent. Please check your email and your spam folder.' ), 'notice' );
    }
    // If account has been freshly created
    if(isset($_GET['n'])){
        wc_add_notice( __( '<p><strong>Thank you for creating your account</strong></p>
            <p>Within the next 48 hours, Sharna, Kath or Kim from our winery will contact you to finalise your first 
            order and your account will be activated. If you prefer, you can call us on 1800 088 223.</p>
            <p>Remember, once you purchase six bottles or more, your membership is valid for 12 months.</p>' ), 'notice' );
    }
}

function gw_wc_email_as_username( $data ) {
    $data['user_login'] = $data['user_email'];
    return $data;
}

// the hooks to make it all work
// add_action( 'init', 'gw_wc_verification_init' );
add_filter('woocommerce_registration_redirect', 'gw_wc_registration_redirect');
// add_filter('wp_authenticate_user', 'gw_wc_authenticate_user',10,2);
// add_action('user_register', 'gw_wc_user_register',10,2);
// add_filter( 'woocommerce_new_customer_data', 'gw_wc_email_as_username' );

// add_filter('manage_users_columns', 'gw_wc_add_user_activated_column');
function gw_wc_add_user_activated_column($columns) {
    $columns['is_activated'] = 'Activated';
    return $columns;
}


// add_action('manage_users_custom_column',  'gw_wc_show_user_activated_column_content', 10, 3);
function gw_wc_show_user_activated_column_content($value, $column_name, $user_id) {

    switch($column_name) {

        case 'is_activated' :
            $isActivated = get_user_meta($user_id, 'is_activated', true);
            if ( $isActivated == 1 ) {
                $active = 'Active';
            } else {
                $active = 'Pending';
            }
            return $active;
            break;

        default:
    }
}
