<?php
/**
 * Template Name: Wine landing
 *
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <main id="main" class="main" role="main">
        <div class="content wines-landing">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
                    <div class="row">
                        <div class="col-md-8">
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <?php get_template_part( 'partials/wine-sections' ); ?>
        </div>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>