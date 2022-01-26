<?php


get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>	
<div class="wrapper" id="page-wrapper" id="main" role="main">


	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">
			<div class="col-sm-12 mb-5 pb-5">
				<h1 class="center-text mt-50">Accessibility Starter Pack</h1>
				<p class="bmg-form-heading">Thank you. You're submission has been sent and someone will contact you within 48 hours</p>
			</div>
		</div>
	</div>
</div>

<?php 

get_footer();

?>