<?php
/**
Template Name: Full Width
 */

get_header(); ?>

<div class="container">
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
get_footer();
