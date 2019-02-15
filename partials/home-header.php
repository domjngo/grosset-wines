<div id="home_banner" class="home-header" <?php echo get_home_img( 'home_img' ) ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="home-entry text-center">
                    <img src="<?php echo get_template_directory_uri() . '/img/grosset-logo-trans.png' ?>" class="img-responsive">
                    <div class="discover">
                        <?php if ( get_option('g_location') ) { ?>
                        <p><?php echo get_option('g_location'); ?></p>
                        <?php } ?>
                        <p>
                            <a href="<?php echo site_url( '/wines/' ) ?>" class="btn">
                                Latest releases
                            </a>
                            <a href="<?php echo site_url( '/members-online/' ) ?>" class="btn">
                                Buy wine
                            </a>
                        </p>
                        <p>
                            <a href="#main">Discover more<br>
                                <img src="<?php echo get_template_directory_uri() . '/img/arrow-down.png' ?>">
                            </a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>