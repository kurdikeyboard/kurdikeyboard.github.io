<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Glow
 */

?>
	<footer class="dt-footer">

		<?php if( is_active_sidebar( 'dt-footer1' ) || is_active_sidebar( 'dt-footer2' ) || is_active_sidebar( 'dt-footer3' ) || is_active_sidebar( 'dt-footer4' ) ) : ?>

		<div class="container">
			<div class="row">
				<div class="dt-footer-cont">
					<?php if( is_active_sidebar( 'dt-footer1' ) ) : ?>

						<div class="col-lg-3 col-md-3 col-sm-4 col-sx-6">
							<?php dynamic_sidebar( 'dt-footer1' ); ?>
						</div><!-- .col-lg-3 .col-md-3 .col-sm-6 -->

					<?php endif; ?>

					<?php if( is_active_sidebar( 'dt-footer2' ) ) : ?>

						<div class="col-lg-3 col-md-3 col-sm-4 col-sx-6">
							<?php dynamic_sidebar( 'dt-footer2' ); ?>
						</div><!-- .col-lg-3 .col-md-3 .col-sm-6 -->

					<?php endif; ?>

					<?php if( is_active_sidebar( 'dt-footer3' ) ) : ?>

						<div class="col-lg-3 col-md-3 col-sm-4 col-sx-6">
							<?php dynamic_sidebar( 'dt-footer3' ); ?>
						</div><!-- .col-lg-3 .col-md-3 .col-sm-6 -->

					<?php endif; ?>

					<?php if( is_active_sidebar( 'dt-footer4' ) ) : ?>

						<div class="col-lg-3 col-md-3 col-sm-6">
							<?php dynamic_sidebar( 'dt-footer4' ); ?>
						</div><!-- .col-lg-3 .col-md-3 .col-sm-6 -->

					<?php endif; ?>

					<div class="clearfix"></div>
				</div><!-- .dt-sidebar -->
			</div><!-- .row -->
		</div><!-- .container -->

		<?php endif; ?>
		<?php

        echo  is_customize_preview() ? '<div id="footer-preview-wrap" class="customize_preview_full_width">' : '';
        /**
         * @see glow_footer
         */
        do_action( 'glow_footer' );

        echo  is_customize_preview() ? '</div">' : '';

        ?>

	</footer><!-- .dt-footer -->

	<a id="back-to-top" class="transition35"><i class="fa fa-angle-up"></i></a><!-- #back-to-top -->

<?php wp_footer(); ?>
</div>
</body>
</html>
