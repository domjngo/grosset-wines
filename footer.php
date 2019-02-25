<div class="social">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/img/aco-logo.png">
                </p>
                <p><small>Grosset Wines is an A-Grade Certified Organic Winery (ACO)</small></p>
                <p>
                    <?php if ( get_option('g_facebook') ) { ?>
                    <a href="<?php echo get_option('g_facebook'); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/facebook.png"></a>
                    <?php } ?>
                    <?php if ( get_option('g_twitter') ) { ?>
                    <a href="<?php echo get_option('g_twitter'); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/twitter.png"></a>
                    <?php } ?>
                    <?php if ( get_option('g_instagram') ) { ?>
                    <a href="<?php echo get_option('g_instagram'); ?>" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/instagram.png"></a>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
</div>
<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <?php if ( is_active_sidebar( 'footer-col-1' ) ) { ?>
                <div class="footer-col col-md-4">
                    <?php dynamic_sidebar( 'footer-col-1' ); ?>
                </div>
            <?php } ?>
            <?php if ( is_active_sidebar( 'footer-col-2' ) ) { ?>
                <div class="footer-col col-md-4">
                    <?php dynamic_sidebar( 'footer-col-2' ); ?>
                </div>
            <?php } ?>
            <?php if ( is_active_sidebar( 'footer-col-3' ) ) { ?>
                <div class="footer-col col-md-4">
                    <?php dynamic_sidebar( 'footer-col-3' ); ?>
                </div>
            <?php } ?>
            <div class="col-md-12 text-center site-info">
                <?php if ( get_option('g_trustwave') ) { ?>
                    <p><?php echo get_option('g_trustwave'); ?></p>
                <?php } ?>
                <h3><?php bloginfo('name'); ?></h3>
                <?php if ( get_option('g_location') ) { ?>
                    <p><?php echo get_option('g_location'); ?></p>
                <?php } ?>
                <p>
                    <small>
                        Copyright © <?php echo date("Y"); ?> <br>
                        Website by <a href="http://chrisbishop.me.uk/" target="_blank">Chris Bishop</a>
                    </small>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>