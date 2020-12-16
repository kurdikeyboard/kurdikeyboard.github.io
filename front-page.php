<?php
/**
 * The Front Page template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glow
 */

get_header();

if ( get_theme_mod( 'home_featured_posts' ) != '' ) :

    $dt_featured_posts = esc_attr( get_theme_mod( 'home_featured_posts_select' ) );

    if ( $dt_featured_posts == '') {
        $dt_featured_posts = '';
    }

    $dt_slide_number   = esc_attr( get_theme_mod( 'dt_slide_number' ) );
    $args = array(
        'post_type'		 => 'post',
        'posts_per_page' => $dt_slide_number,
        'orderby' 		 => 'ASC',
        'category__in'   => $dt_featured_posts
    );

    $dt_featured_posts = new WP_Query($args); ?>

    <div class="dt-front-slider <?php echo ( get_theme_mod( 'home_featured_full_screen' ) == 1 ) ? ' s-full' : 's-padding'; ?>">
        <div class="dt-featured-post-slider">
            <div class="swiper-wrapper">

                <?php while ( $dt_featured_posts->have_posts() ) : $dt_featured_posts->the_post(); ?>

                    <div class="swiper-slide">
                        <div class="dt-featured-post">
                            <header class="entry-header">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="dt-featured-post-meta animated fadeInUp">
                                                <h2><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_attr( get_the_title() ); ?></a></h2>

                                                <p class="animated fadeInUp"><?php the_excerpt() ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </header>

                            <figure>
                                <?php
                                if ( has_post_thumbnail() ) :
                                    $image = '';
                                    $title_attribute = get_the_title( $post->ID );
                                    $image .= '<a href="'. esc_url( get_permalink() ) . '" title="' . esc_attr( the_title( '', '', false ) ) .'">';
                                    $image .= get_the_post_thumbnail( $post->ID, 'glow-featured-slider-img', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                                    echo $image;

                                else : ?>
                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/blank-slider.jpg" alt="<?php _e( 'no image found', 'glow' ); ?>"/>
                                <?php endif; ?>

                            </figure>
                        </div><!-- .dt-featured-post -->
                    </div><!-- .swiper-slide -->
                <?php endwhile; ?>
            </div><!-- .swiper-wrapper -->

            <!-- Add Arrows -->
            <div class="swiper-button-next transition5"><i class="fa fa-angle-right"></i></div>
            <div class="swiper-button-prev transition5"><i class="fa fa-angle-left"></i></div>
        </div><!-- .dt-featured-post-slider -->
    </div><!-- .dt-front-slider -->

<?php endif; ?>

<div class="container">
    <div class="row">

        <?php if ( is_active_sidebar( 'dt_home_page' ) ) : ?>

            <div class="col-lg-12">
                <div class="dt-home-widgets">
                    <?php dynamic_sidebar( 'dt_home_page' ); ?>
                </div>
            </div>

        <?php else: ?>

        <div class="col-lg-8 col-md-8">
            <div id="primary" class="dt-archive-wrap">

            <?php if ( have_posts() ) :

                while ( have_posts() ) : the_post();
                    if ( 'page' == get_option( 'show_on_front' ) ) { ?>

                        <div class="dt-content-area">
                            <?php

                            get_template_part( 'template-parts/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                            ?>
                        </div>

                    <?php } else { ?>

                        <div <?php post_class( 'dt-archive-post' ); ?>>

                            <?php if ( has_post_thumbnail() ) : ?>

                            <figure>

                                <?php

                                    $image = '';
                                    $title_attribute = get_the_title( $post->ID );
                                    $image .= '<a href="'. esc_url( get_permalink() ) . '" title="' . the_title( '', '', false ) .'">';
                                    $image .= get_the_post_thumbnail( $post->ID, 'glow-archive-img', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
                                    echo $image;

                                ?>

                            </figure>

                            <?php endif; ?>

                            <article>
                                <header class="entry-header">
                                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                                </header><!-- .entry-header -->

                                <div class="dt-archive-post-content">

                                    <?php the_excerpt(); ?>

                                </div><!-- .dt-archive-post-content -->

                                <div class="entry-footer">
                                    <a class="transition35" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'Read more', 'glow' ); ?></a>
                                </div><!-- .entry-footer -->
                            </article>
                        </div><!-- .dt-archive-post -->

                    <?php } ?>

                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

                <div class="clearfix"></div>

                <div class="dt-pagination-nav">
                    <?php echo the_posts_pagination(); ?>
                </div><!---- .dt-pagination-nav ---->

            <?php else : ?>

                <p><?php _e( 'Sorry, no posts matched your criteria.', 'glow' ); ?></p>

            <?php endif; ?>

            </div>
        </div>

        <aside class="col-lg-4 col-md-4">
            <div class="dt-sidebar">
                <?php get_sidebar(); ?>
            </div><!-- dt-sidebar -->
        </aside><!-- .col-lg-4 -->

        <?php endif; ?>

    </div>
</div>

<?php
get_footer();
