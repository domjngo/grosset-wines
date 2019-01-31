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

            if ( $_POST['timestamp'] + 5 > time() ) {
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

        echo '<p><strong>Thank you! Your request was sent successfully.</strong></p>';

        echo $form_content;

        $email_headers = 'From: Grosset Wines <sales@grosset.com.au>';

        wp_mail( 'domingobishop@gmail.com', 'Membership request', $form_content, $email_headers );

        $thanks = thanks( $name );

        wp_mail( $email, 'Thank you for signing up to join the Grosset Wine Club', $thanks, $email_headers );

    } else {
        echo members_form();
    }
}

function thanks( $name ) {

    $thanks = '
    <p><img src="'.bloginfo("stylesheet_directory").'/img/grosset-logo.png"></p>
    <p>Dear '.$name.'</p>
    <p>Thank you for signing up to join the Grosset Wine Club.</p>
    <p>Currently the members list is fully subscribed and there is a short waiting list.</p>
    <p>As soon as this situation changes, we will notify you. This shouldn’t be more than a few weeks.</p>
    <p>In the meantime if you have any queries, please don’t hesitate to call the office on 1800 088 223.</p>
    <p>Warm regards,<br><a href="https://grosset.com.au">Grosset Wines</a></p>
    ';

    return $thanks;
}