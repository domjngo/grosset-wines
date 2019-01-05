<div id="home_banner" class="header-home" style="background-image: url(<?php echo get_option_img('home_img'); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="home-entry text-center">
                    <?php $n = rand( 1, 3 ); ?>
                    <h1><?php echo get_option('home_quote_'.$n); ?></h1>
                    <p><?php echo get_option('home_source_'.$n); ?></p>
                    <div class="home-call-to-action">
                        <a href="<?php echo get_option('g_url_1'); ?>" class="btn btn-action">
                            <?php echo get_option('g_button_1'); ?>
                        </a>
                        <a href="<?php echo get_option('g_url_2'); ?>" class="btn btn-action">
                            <?php echo get_option('g_button_2'); ?>
                        </a>
                        <a href="<?php echo get_option('g_url_3'); ?>" class="btn btn-action">
                            <?php echo get_option('g_button_3'); ?>
                        </a>
                    </div>
                    <div class="discover">
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