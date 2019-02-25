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
    <p>Currently the members list is fully subscribed and there is a short waiting list.</p>
    <p>As soon as this situation changes, we will notify you. This shouldn’t be more than a few weeks.</p>
    <p>In the meantime if you have any queries, please don’t hesitate to call the office on 1800 088 223.</p>
    <p>Warm regards,<br><a href="https://www.grosset.com.au">Grosset Wines</a></p>
    ';

    return $thanks;
}

function disclaimer() {

    $disclaimer = '
    <p>We will acknowledge your request by return, and advise as soon as we have you signed up! 
    There is currently a high demand to join the Grosset Wine Club so please allow 14 days for your 
    membership to be confirmed.</p>
    <p>As a Grosset Wine Club Member you will receive one <strong>Spring Release</strong> newsletter by post or 
    email if no postal address is provided. In addition, 3-4 emails detailing our <strong>Autumn Release</strong> 
    and <strong>Special Offers</strong> to members.</p>
    <p>To remain a Grosset Wine Club Member you are required to purchase six bottles from us each year. That\'s all!</p>
    ';

    return $disclaimer;
}