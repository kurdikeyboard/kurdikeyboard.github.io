<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Glow
 */

get_header(); ?>

	<div class="container">
		<div class="dt-category-wrap dt-main-cont">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<div id="primary" class="dt-archive-wrap">
						<?php if ( have_posts() ) :

							while ( have_posts() ) : the_post(); ?>

								<div class="dt-archive-post">

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

				<div class="col-lg-4 col-md-4">
					<div class="dt-sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div><!-- .row -->
		</div><!-- .dt-category-wrap .dt-main-cont -->
	</div><!-- .container -->

<?php
get_footer();
