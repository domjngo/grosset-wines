<?php get_header(); ?>

    <div id="banner" class="banner" role="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>
                        <?php bloginfo('name'); ?>
                    </h1>
                    <p>
                        <?php bloginfo('description'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <main id="main" class="main" role="main">
        <div class="content">
            <?php $categories = get_categories( array(
                'orderby' => 'name',
                'parent'  => 0
            ) );
            if ($categories) { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="cat-nav">
                        <?php
                        foreach ( $categories as $category ) {
                            if ( is_category( $category ) ) {
                                $current_category = 'btn-primary';
                            } else {
                                $current_category = '';
                            }
                            if ( $category->name !== 'Uncategorized' && $category->name !== 'Uncategorised' ) {
                                printf( '<a href="%1$s" class="btn btn-default ' . $current_category . '">%2$s</a> ',
                                    esc_url( get_category_link( $category->term_id ) ),
                                    esc_html( $category->name )
                                );
                            }
                        } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="cards">
                            <?php if (have_posts()) : ?>
                                <?php while (have_posts()) : the_post(); ?>
                                    <article id="post-<?php the_ID(); ?>">
                                        <?php if (has_post_thumbnail() && !post_password_required() && !is_attachment()) : ?>
                                            <div class="entry-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="entry-content clearfix">
                                            <div class="entry-header">
                                                <h2>
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h2>
                                            </div>
                                            <div class="entry-summary">
                                                <p><?php echo excerpt(32) ; ?></p>
                                            </div>
                                        </div>
                                    </article>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <h1>No content</h1>
                            <?php endif; ?>
                            <nav class="paged-posts clearfix">
                                    <div class="previous"><?php next_posts_link( '&#8249; Older posts' ); ?></div>
                                    <div class="next"><?php previous_posts_link( 'Newer posts &#8250;' ); ?></div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>