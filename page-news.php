<?php
/**
 * Template Name: News
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
                <?php If (the_content()) { ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </article>
            <?php endwhile; ?>
            <div class="container">
                <div class="row row-flex">
                    <?php
                    $args = array(
                        'posts_per_page' => 12,
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'category_name' => 'news'
                    );
                    $articles = new WP_Query( $args );

                    if ( $articles->have_posts() ) :
                        while ( $articles->have_posts() ) : $articles->the_post();
                            global $post;
                            $id = $post->ID;
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
                            if ($image) {
                                $background = 'style="background-image: url('. $image[0] . ');"';
                            } else {
                                $background = '';
                            }
                            ?>
                            <div class="col-md-4 card post-<?php the_ID(); ?>">
                                <a href="#" title="<?php the_title(); ?>" data-toggle="modal" data-target="#newsModal<?php the_ID(); ?>">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" <?php echo $background ?>>
                                        </div>
                                        <div class="panel-body">
                                            <h3><?php the_title(); ?></h3>
                                            <p><?php echo wp_trim_words(get_the_content(), 24); ?></p>
                                            <small><?php the_date(); ?></small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="modal fade" id="newsModal<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel<?php the_ID(); ?>">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-10 col-md-offset-1">
                                                    <h2 id="ModalLabel<?php the_ID(); ?>"><?php the_title(); ?></h2>
                                                    <?php the_content(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        ?>
                        <div class="col-md-12 page-nav text-center">
                        <?php
                        next_posts_link( 'Older news', $articles->max_num_pages );
                        previous_posts_link( 'Next &raquo;' );
                        ?>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>