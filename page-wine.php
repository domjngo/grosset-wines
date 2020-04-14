<?php
	/**
	 * Template Name: Wine
	 *
	 */
	get_header(); ?>


	<?php while (have_posts()) : the_post(); ?>


	    <main id="main" class="main wine-page" role="main">
	        <div class="content">
	            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	                <div class="wine-page-header">
	                    <div class="container">
	                        <div class="row">
	                            <div class="col-xs-6 wine-img">
	                                <?php echo get_feature_wine_img( get_the_title() ); ?>
	                            </div>
	                            <div class="col-xs-6 col-sm-4">
	                                <div class="entry-header">
	                                    <h1>
	                                        <?php the_title(); ?>
	                                    </h1>
	                                    <p>
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
	                                        } else {
	                                            echo '<a class="btn btn-default" href="https://www.grosset.com.au/'.$shop.'">Buy now</a>';
	                                        }
	                                        ?>
	                                    </p>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="wine-page-content">
	                    <div class="container">
	                        <div class="row">
	                            <div class="col-md-8 col-md-offset-2">
	                                <div class="entry-content">
	                                    <?php the_content(); ?>
	                                </div>
	                                <?php if ( is_active_sidebar( 'sidebar' ) ) { ?>
	                                <div class="entry-sidebar">
	                                    <?php dynamic_sidebar( 'sidebar' ); ?>
	                                </div>
	                                <?php } ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </article>
	        </div>
	    </main>


	<?php endwhile; ?>


	<?php get_footer(); ?>

