<?php
/**
 * Template Name: Home page
 *
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <?php get_template_part( 'partials/header-home' ); ?>

    <main id="main" class="main" role="main">
        <div class="content">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="container">
                    <div class="row">
                        <?php get_template_part( 'partials/call-to-action' ); ?>
                    </div>
                </div>
            </article>
        </div>
    </main>

<?php endwhile; ?>

<?php get_footer(); ?>