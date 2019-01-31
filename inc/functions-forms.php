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
	        <legend>Join here</legend>
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
                <input class="btn btn-primary btn-lg" type="submit" alt="Submit" name="submit" id="members-submit" value="Join">
            </div>
        </fieldset>
    </form>
    ';

    return $form;
}

add_shortcode( 'member-form', 'member_shortcode' );

function member_shortcode() {

    if ( ! is_admin() && isset( $_POST['submit'] ) ) {

        // Process form
        if (  isset( $_POST['message'] ) ) {
            if ( trim($_POST['message'] ) != '' ) {
                // Spam!!
                return;
            }
        }
        if (  isset( $_POST['token'] ) ) {

            $saved_token = get_transient( 'token-'.$_POST['token'] );

            if ( !$saved_token ) {
                // Spam!!
                return;
            } else {
                delete_transient( 'token-'.$_POST['token'] );
            }
        }
        if (  isset( $_POST['timestamp'] ) ) {

            if ( $_POST['timestamp'] + 5 > time() ) {
                // Spam!!
                echo members_form();
                return;
            }
        }

        $email = '
        <p>Name : '.filter_input( INPUT_POST, 'first_name' ).' '.filter_input( INPUT_POST, 'last_name' ).'</p>
        <p>Email : '.filter_input( INPUT_POST, 'email' ).'</p>
        <p>Telephone : '.filter_input( INPUT_POST, 'number' ).'</p>
        <p>Address : '.filter_input( INPUT_POST, 'address' ).'</p>
        <p>City : '.filter_input( INPUT_POST, 'city' ).'</p>
        <p>State : '.filter_input( INPUT_POST, 'state' ).'</p>
        <p>Postcode : '.filter_input( INPUT_POST, 'postcode' ).'</p>
        ';

        echo '<p><strong>Thank you! Your request was sent successfully.</strong></p>';

        echo $email;

        $email_headers = 'From: Grosset Wines (DO NOT REPLY) <no-reply@grosset.com.au>';

        wp_mail( 'domingobishop@gmail.com', 'Membership request', $email, $email_headers );

    } else {
        echo members_form();
    }
}