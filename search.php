<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Glow
 */

get_header(); ?>

	<div class="container">
		<div class="dt-main-cont">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					<section id="primary" class="content-area">
						<main id="main" class="site-main" role="main">

							<?php
							if ( have_posts() ) : ?>

								<header class="page-header">
									<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'glow' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
								</header><!-- .page-header -->

								<?php
								/* Start the Loop */
								while ( have_posts() ) : the_post();

									/**
									 * Run the loop for the search to output the results.
									 * If you want to overload this in a child theme then include a file
									 * called content-search.php and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'search' );

								endwhile;

								the_posts_navigation();

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif; ?>

						</main><!-- #main -->
					</section><!-- #primary -->
				</div><!-- .col-lg-12 .col-md-12 -->

				<div class="col-lg-4 col-md-4">
					<?php get_sidebar(); ?>
				</div><!-- .col-lg-4 .col-md-4 -->
			</div><!-- .row -->
		</div><!-- .dt-error-page dt-main-cont -->
	</div><!-- .container -->

<?php
get_footer();
