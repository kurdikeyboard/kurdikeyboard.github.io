<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Glow
 */

get_header(); ?>

	<div class="container">
		<div class="row">
				<div class="col-lg-8 col-md-8">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">

							<section class="error-404 not-found">
								<header class="page-header">
									<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'glow' ); ?></h1>
								</header><!-- .page-header -->

								<div class="page-content">
									<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'glow' ); ?></p>

									<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

								</div><!-- .page-content -->
							</section><!-- .error-404 -->

						</main><!-- #main -->
					</div><!-- #primary -->
				</div><!-- .col-lg-12 .col-md-12 -->

				<div class="col-lg-4 col-md-4">
					<div class="dt-sidebar">

						<?php get_sidebar(); ?>

					</div>
				</div><!-- .col-lg-4 .col-md-4 -->
			</div><!-- .row -->
	</div><!-- .container -->

<?php
get_footer();
