<?php
/**
 * Partial for Wines landing page (page-wine-landing.php)
 *
 */

for ( $i=1 ; $i<=12 ; $i++ ) {
    if ( get_option('g_wine_title_'.$i ) ) {

        if ( $i%2 ) {
            $class = 'bg-grey';
            $first_col_position = 'col-md-6';
            $second_col_position = 'col-md-6';
        } else {
            $class = 'bg-white';
            $first_col_position = 'col-md-6 col-md-push-6';
            $second_col_position = 'col-md-6 col-md-pull-6';
        }
        ?>
    <section class="wine-section <?php echo $class ?>">
        <div class="section-bg">
            <div class="container">
                <div class="row">
                    <div class="<?php echo $first_col_position ?>">
                        <div class="wine-hero" style="background-image: url(<?php echo get_site_url().get_option('g_wine_img_'.$i ) ?>)"></div>
                    </div>
                    <div class="<?php echo $second_col_position ?>">
                        <h2><?php echo get_home_text('g_wine_title_'.$i ) ?></h2>
                        <p><?php echo get_home_text('g_wine_text_'.$i ) ?></p>

                            <?php
                            if ( is_user_logged_in() ) {
                                $shop_page = get_site_url().'/members-online/';
                                $shop_btn_text = 'Buy now';
                            } else {
                                $shop_page = get_site_url().'/wine-shop/';
                                $shop_btn_text = 'Buy now';
                            }
                            if (has_category('members-only')) {
                                $shop_btn_text = 'Buy now <small>(Members only)</small>';
                            } elseif (has_category('sold-out')) {
                                $shop_page = '#';
                                $shop_btn_text = 'Sold out';
                            } elseif (has_category('coming-soon')) {
                                $shop_page = '#';
                                $shop_btn_text = 'Coming Soon';
                            }
                            ?>
                            <a class="btn btn-default" href="<?php echo $shop_page ?>"><?php echo $shop_btn_text ?></a>
                            <?php
                            $wine   = get_post( get_home_text('g_wine_page_id_'.$i ) );
                            if ($wine) {
                            $featured_img_url = get_the_post_thumbnail_url($wine->ID,'medium');
                            ?>
                            <a href="#" class="btn" data-toggle="modal" data-target="#wineModal<?php echo $i ?>">Read more</a>
                            <div class="modal fade" id="wineModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel<?php echo $i ?>">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h3 class="modal-title" id="ModalLabel<?php echo $i ?>"><?php echo $wine->post_title ?></h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="<?php echo $featured_img_url ?>" alt="Bottle image of <?php echo $wine->post_title ?>" class="img-responsive">
                                                </div>
                                                <div class="col-md-9">
                                                    <p><a class="btn btn-default" href="<?php echo $shop_page ?>"><?php echo $shop_btn_text ?></a></p>
                                                    <?php echo $wine->post_content ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } else { ?>
                                <a href="<?php echo get_option('g_wine_url_'.$i ) ?>" class="btn">Read more</a>
                            <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }
    }
