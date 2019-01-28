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
                <?php get_template_part( 'partials/home-sections' ); ?>
            </article>
        </div>
    </main>

<?php endwhile; ?>

<?php get_footer(); ?>