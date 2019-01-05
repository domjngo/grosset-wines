<?php for ( $i=1 ; $i<=3 ; $i++ ) { ?>
    <div class="col-md-4">
        <div class="call-to-action text-center">
            <h2><?php echo get_option('g_title_'.$i); ?></h2>
            <p><?php echo get_option('g_text_'.$i); ?></p>
            <p>
                <a href="<?php echo get_option('g_url_'.$i); ?>" class="btn btn-home">
                    <?php echo get_option('g_button_'.$i); ?>
                </a>
            </p>
        </div>
    </div>
<?php } ?>