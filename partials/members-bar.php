<div class="members-bar">
    <div class="container-fluid">
        <div class="row">
            <?php
            if ( is_user_logged_in() ) { ?>
            <div class="col-md-6">
                Welcome, you are <strong>signed in</strong>
            </div>
            <div class="col-md-6 text-right">
                <a href="https://www.grosset.com.au/members-online/" class="btn btn-xs">Buy wine</a>
                <a href="https://www.grosset.com.au/my-account/" class="btn btn-xs">My account</a>
                <a href="https://www.grosset.com.au/my-account/customer-logout/" class="btn btn-xs">Sign out</a>
            </div>
            <?php } else { ?>
            <div class="col-md-12 text-right">
                <a href="https://www.grosset.com.au/my-account/" class="btn btn-xs">Sign in</a>
                <a href="https://www.grosset.com.au/club-member/help/" class="btn btn-xs">Help</a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>