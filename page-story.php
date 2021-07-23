<?php
/**
 * Template Name: Story landing
 *
 */
get_header(); ?>

    <main id="main" class="main" role="main">
        <div class="content story-landing">
            <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="container-fluid">
                    <div class="row">
                        <?php if ( get_feature_image_as_bg() ) { ?>
                            <div class="page-header-banner" <?php echo get_feature_image_as_bg()?>>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="entry-header">
                                                <h1>
                                                    <?php the_title(); ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="entry-header">
                                                <h1>
                                                    <?php the_title(); ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
            <div class="container">
                <div class="row">
                    <?php get_template_part( 'partials/story-children' ); ?>
                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>