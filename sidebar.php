<?php
global $product;
if (!$product) { ?>
<div class="col-md-4">
    <?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
        <div class="entry-sidebar">
            <?php dynamic_sidebar( 'sidebar' ); ?>
        </div>
    <?php } ?>
</div>
<?php } ?>