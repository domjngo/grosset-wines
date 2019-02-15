<?php
/**
 * Template Name: Home page temp
 *
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <?php get_template_part( 'partials/home-header' ); ?>

    <main id="main" class="main" role="main">
        <div class="content">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
            </article>
        </div>
    </main>

<?php endwhile; ?>

<?php get_footer(); ?>