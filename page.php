<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <main id="main" class="main" role="main">
        <div class="content">
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
                        <div class="col-md-8">
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </article>
        </div>
    </main>

<?php endwhile; ?>

<?php get_footer(); ?>