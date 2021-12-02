<div class="members-bar">
    <div class="container-fluid">
        <div class="row">
            <?php
            $user = wp_get_current_user();
            if ( is_user_logged_in() ) { ?>
            <div class="col-md-6">
                Welcome, you are <strong>signed in</strong>
            </div>
            <div class="col-md-6 text-right">
                <?php if ( in_array( 'customer', (array) $user->roles ) ) { ?>
                    <a href="<?php echo site_url(); ?>/members-online/" class="btn btn-xs">Members wine shop</a>
                <?php } else { ?>
                    <a href="<?php echo site_url(); ?>/wine-shop/" class="btn btn-xs">Wine shop</a>
                <?php } ?>
                <!--<a href="<?php /*echo wc_get_cart_url(); */?>" class="btn btn-xs">Basket</a>
                <a href="<?php /*echo wc_get_checkout_url(); */?>" class="btn btn-xs">Checkout</a>-->
                <a href="<?php echo site_url(); ?>/my-club-account/" class="btn btn-xs">My account</a>
                <a href="<?php echo site_url(); ?>/my-club-account/customer-logout/" class="btn btn-xs">Sign out</a>
            </div>
            <?php } else { ?>
            <div class="col-md-12 text-right">
                <a href="<?php echo site_url(); ?>/wine-shop/" class="btn btn-xs">Wine shop</a>
                <a href="<?php echo site_url(); ?>/my-club-account/" class="btn btn-xs">Sign in</a>
                <a href="<?php echo site_url(); ?>/contact/grosset-wine-club-member/" class="btn btn-xs">Join</a>
                <a href="<?php echo site_url(); ?>/club-member/help/" class="btn btn-xs">Help</a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>