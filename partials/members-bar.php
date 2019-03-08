<div class="members-bar">
    <div class="container-fluid">
        <div class="row">
            <?php
            if ( is_user_logged_in() ) { ?>
            <div class="col-md-6">
                Welcome, you are <strong>signed in</strong>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?php echo site_url(); ?>/members-online/" class="btn btn-xs">Buy wine</a>
                <!--<a href="<?php /*echo wc_get_cart_url(); */?>" class="btn btn-xs">Basket</a>
                <a href="<?php /*echo wc_get_checkout_url(); */?>" class="btn btn-xs">Checkout</a>-->
                <a href="<?php echo site_url(); ?>/my-account/" class="btn btn-xs">My account</a>
                <a href="<?php echo site_url(); ?>/my-account/customer-logout/" class="btn btn-xs">Sign out</a>
            </div>
            <?php } else { ?>
            <div class="col-md-12 text-right">
                <a href="<?php echo site_url(); ?>/my-account/" class="btn btn-xs">Sign in</a>
                <a href="<?php echo site_url(); ?>/contact/grosset-wine-club-member/" class="btn btn-xs">Join</a>
                <a href="<?php echo site_url(); ?>/club-member/help/" class="btn btn-xs">Help</a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>