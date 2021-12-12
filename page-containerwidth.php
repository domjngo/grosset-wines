<?php
/**
 * Template Name: Container width
 *
 */
$class = 'not-logged-in';
$categories = get_the_category();
foreach ($categories as $cat){
    if ( $cat->slug == 'members-only' ) {
        if ( is_member() ) {
            $class = 'members-only';
        } else {
            wp_redirect( home_url() ); exit;
        }
    }
}

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <main id="main" class="main <?php echo $class; ?>" role="main">
        <div class="content">
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
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="entry-content clearfix">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </main>

<?php endwhile; ?>

<?php get_footer(); ?>