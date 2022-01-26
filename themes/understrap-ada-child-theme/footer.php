<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer" class="bmg-wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-3">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>adalogo-w.png" alt="ADA Web Protect" />

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->
			
			<div class="col-md-3 text-right">
				
				
			</div>

			<div class="col-md-3 text-right">
				(877) 424-7050 <br />
				support@adawebprotect.com <br />
				3857 Birch St, Suite 3069 <br />
				Newport Beach Ca 92660 <br />
			</div>

			<div class="col-md-3 text-right">
				<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>usa-flag.png" alt="USA Flag" />	
				
			</div>

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

