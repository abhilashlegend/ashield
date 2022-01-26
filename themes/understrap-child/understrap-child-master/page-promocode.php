<?php /* Template Name: page-promocode */ ?>


<?php 
global $post;


$promo_code = get_the_title();

		$posts = get_posts(array(
	'numberposts'	=> -1,
	'post_type'		=> 'promo_system',
	'meta_key'		=> 'promo_code',
	'meta_value'	=> $promo_code
));

		if($posts) {
				$price = get_post_meta($posts[0]->ID, "price", true);
				$greeting = get_post_meta($posts[0]->ID, "greeting", true);
				$expiration_date = get_post_meta($posts[0]->ID, "expiration_date", true);
				$active = (boolean) get_post_meta($posts[0]->ID, "active", true);
				$notes = get_post_meta($posts[0]->ID, "notes", true);
				$days_left = get_post_meta($posts[0]->ID, "days_valid", true);
		}

		$current_date =  date("m-d-Y");	
		$exp_date = date("m-d-Y", strtotime($expiration_date));

		$d1 = date("Y-m-d");
		$d2 = date("Y-m-d", strtotime($expiration_date));

		


		if(!$active)
		{
			$url = get_site_url() . "/promo/";

		
			wp_redirect( $url );
			exit;
		}

		if( $exp_date < $current_date)
		{
			$url = get_site_url() . "/promo/";

		
			wp_redirect( $url );
			exit;
		}


get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>		

<div class="wrapper" id="page-wrapper" id="main" role="main">


	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">
			<div class="col-sm-6">
				<h1 class="center-text mt-50">Accessibility Starter Pack</h1>
				<h2><?php echo $greeting; ?></h2>
				<p class="bmg-form-heading">Your coupon code has been accepted and your form has been submitted. Someone will contact you within 48 hours.</p>
				<p>Your discounted price of $<?php echo $price; ?>  is valid for <?php echo $days_left; ?> days</p>
				<p><?php echo $notes ?></p>
			</div>

			<div class="col-sm-6">

			</div>
		</div>
	</div>
</div>


<?php
	
 get_footer();

?>