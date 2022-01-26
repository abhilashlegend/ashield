<?php
/**
 * Hero setup.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php if ( !is_active_sidebar( 'hero' ) || is_active_sidebar( 'statichero' ) || is_active_sidebar( 'herocanvas' ) ) : ?>

<div class="row mr-0">
<div class="col-11 pl-0">
	<div class="wrapper wrapper-hero" id="wrapper-hero">
		<div class="bmg-hero-content">
		<div class="container-fluid">	
		<div class="row text-center">
			<div class="col-10 offset-1">
				<div class="bmg-hero-text">
				    	<h1 class="bmg-hero-block-title mb-4">ADA WEB PROTECT</h1>
						<div> 
							<h2>Your ADA Web Site Compliance Partner</h2>
								<ul class="bmg-hero-points">
									<li>Did you know that Title III of the Federal Americans with Disability Act, mandates that your companies web site and digital on line presence must ADA compliant ?</li>
									<li>Did you know that non complaint companies, large and small, are being sued daily for non compliance ?
									</li>
									<li>
										Did you know that most sites are non compliant and less then 5% of government web sites are compliant?
									</li>
								</ul>
						</div>
				</div>	
			</div>
		</div>
	</div>
		</div>

		<?php get_template_part( 'sidebar-templates/sidebar', 'hero' ); ?>

		<?php get_template_part( 'sidebar-templates/sidebar', 'herocanvas' ); ?>

		<?php get_template_part( 'sidebar-templates/sidebar', 'statichero' ); ?>

	</div>
</div> <!-- ENd of col 11 -->
<div class="col-1">
		<div class="bmg-vertical-social-links">
			<a href="#" aria-label="facebook link"><i class="fa fa-facebook"></i></a>
			<a href="#" aria-label="linkedin link"><i class="fa fa-linkedin"></i></a>
			<a href="#" aria-label="twitter link"><i class="fa fa-twitter"></i></a>
		</div>
</div>	
</div>

<?php endif; ?>
