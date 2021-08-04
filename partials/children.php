<?php
/**
 * Partial for Story landing page (page-story-landing.php)
 *
 */
global $post;
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
);
$parent = new WP_Query( $args );

if ( $parent->have_posts() ) : ?>
    <?php while ( $parent->have_posts() ) : $parent->the_post();
        global $post;
        $id = $post->ID;
        $background = '';
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
        if ($image) {
            $background = 'style="background-image: url('. $image[0] . ');"';
        }
    ?>
        <div class="col-md-6 card post-<?php the_ID(); ?>">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <div class="panel panel-default">
                    <div class="panel-heading" <?php echo $background ?>>
                    </div>
                    <div class="panel-body">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words(get_the_content(), 24); ?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php endwhile; ?>
<?php endif; wp_reset_postdata(); ?>
