<section class="home-section section-intro">
    <div class="section-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h1><?php echo get_home_text('g_title_1') ; ?></h1>
                    <p><?php echo get_home_text('g_text_1') ; ?></p>
                    <?php echo get_button('g_button_1', 'g_url_1' ) ; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if ( get_option( 'g_title_2' ) ) { ?>
<section class="home-section section-img" <?php echo get_home_img( 'g_img_url_2' ) ?>>
    <div class="section-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2><?php echo get_home_text('g_title_2'); ?></h2>
                    <p><?php echo get_home_text('g_text_2'); ?></p>
                    <?php echo get_button('g_button_2', 'g_url_2' ) ; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ( get_option( 'g_title_3' ) ) { ?>
<section class="home-section">
    <div class="section-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2><?php echo get_home_text('g_title_3'); ?></h2>
                </div>
                <div class="col-md-6">
                    <p><?php echo get_home_text('g_text_3'); ?></p>
                    <?php echo get_button('g_button_3', 'g_url_3' ) ; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ( get_option( 'g_title_4' ) ) { ?>
<section class="home-section section-img" <?php echo get_home_img( 'g_img_url_4' ) ?>>
    <div class="section-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-6 text-right">
                    <h2><?php echo get_home_text('g_title_4'); ?></h2>
                    <p><?php echo get_home_text('g_text_4'); ?></p>
                    <?php echo get_button('g_button_4', 'g_url_4' ) ; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ( get_option( 'g_title_5' ) ) { ?>
<section class="home-section">
    <div class="section-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p><?php echo get_home_text('g_text_5'); ?></p>
                    <?php echo get_button('g_button_5', 'g_url_5' ) ; ?>
                </div>
                <div class="col-md-6">
                    <h2><?php echo get_home_text('g_title_5'); ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ( get_option( 'g_title_6' ) ) { ?>
<section class="home-section section-img" <?php echo get_home_img( 'g_img_url_6' ) ?>>
    <div class="section-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2><?php echo get_home_text('g_title_6'); ?></h2>
                    <p><?php echo get_home_text('g_text_6'); ?></p>
                    <?php echo get_button('g_button_6', 'g_url_6' ) ; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ( get_option( 'g_title_7' ) ) { ?>
<section class="home-section">
    <div class="section-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2><?php echo get_home_text('g_title_7'); ?></h2>
                </div>
                <div class="col-md-6">
                    <p><?php echo get_home_text('g_text_7'); ?></p>
                    <?php echo get_button('g_button_7', 'g_url_7' ) ; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
