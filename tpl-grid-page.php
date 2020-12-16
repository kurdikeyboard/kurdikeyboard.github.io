<?php
/**
 * Template Name: Grid Page
 *
 */
get_header(); ?>

    <div class="container grid-page-content">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div id="primary" class="content-area dt-content-area">
                    <main id="main" class="site-main" role="main">
                        <?php
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!-- .col-lg-12 -->

        </div><!-- .row -->
    </div><!-- .container -->
    <?php
    global $post;
    $child_pages = new WP_Query( array(
        'post_type'      => 'page',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_parent'    => $post->ID,
        'posts_per_page' => -1,
        'no_found_rows'  => true,
    ) );

    $layout =  apply_filters( 'grid_child_page_layout', 3 );
    ?>
    <?php if ( $child_pages->have_posts() ) : ?>
    <div class="grid-child-pages container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dt-services-wrap eq-row-col-<?php echo $layout; ?>">
                    <?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>
                        <?php get_template_part( 'template-parts/content', 'grid' ); ?>
                    <?php endwhile; ?>
                </div><!-- .grid-area -->
            </div><!-- .col-lg-12 -->
        </div><!-- .row -->
    </div><!-- .container -->
    <?php
    wp_reset_postdata();
    endif;
    ?>
<?php
get_footer();
