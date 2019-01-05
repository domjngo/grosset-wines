<!-- /.carousel -->
<div id="carousel-example-generic" class="carousel slide text-center" data-ride="carousel">
    <div class="glogo-trans">

    </div>
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active" style="background: url(<?php echo get_option('g_image_1'); ?>) no-repeat center center;background-size:cover;">

            <div class="carousel-caption">
                <h3><?php echo get_option('g_quote_1'); ?></h3>
                <p><?php echo get_option('g_source_1'); ?></p>
            </div>
        </div>
        <div class="item" style="background: url(<?php echo get_option('g_image_2'); ?>) no-repeat center center;background-size:cover;">

            <div class="carousel-caption">
                <h3><?php echo get_option('g_quote_2'); ?></h3>
                <p><?php echo get_option('g_source_2'); ?></p>
            </div>
        </div>
        <div class="item" style="background: url(<?php echo get_option('g_image_3'); ?>) no-repeat center center;background-size:cover;">

            <div class="carousel-caption">
                <h3><?php echo get_option('g_quote_3'); ?></h3>
                <p><?php echo get_option('g_source_3'); ?></p>
            </div>
        </div>
    </div>
</div>
<!-- /.carousel -->