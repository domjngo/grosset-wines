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
                        <div class="wine-hero" style="background-image: url(<?php echo get_option('g_wine_img_'.$i ) ?>)"></div>
                    </div>
                    <div class="<?php echo $second_col_position ?>">
                        <h2><?php echo get_home_text('g_wine_title_'.$i ) ?></h2>
                        <p><?php echo get_home_text('g_wine_text_'.$i ) ?></p>
                        <p>
                            <a href="<?php echo get_option('g_wine_url_'.$i ) ?>" class="btn">Read more</a>
                            <?php
								if ( is_user_logged_in() ) {
									$shop = 'members-online/';
								} else {
									$shop = 'wine-shop/';
								}
                                if (has_category('members-only')) {
                                    echo '<a class="btn btn-default" href="https://www.grosset.com.au/'.$shop.'">Buy now <small>(Members only)</small></a>';
                                } elseif (has_category('sold-out')) {
                                    echo '<a class="btn btn-default" href="">Sold out</a>';
                                } elseif (has_category('coming-soon')) {
                                    echo '<a class="btn btn-default" href="">Coming Soon</a>';
                                } else {
                                    echo '<a class="btn btn-default" href="https://www.grosset.com.au/'.$shop.'">Buy now</a>';
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }
    }
