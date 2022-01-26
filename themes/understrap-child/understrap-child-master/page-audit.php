<?php
	
		$error_message = [];
		$aria_state = [];
		$aria_state['name'] = 'false';
		$aria_state['url'] = 'false';
		$aria_state['email'] = 'false';
		$aria_state['phone'] = 'false';
		$aria_state['promo_code'] = 'false';
		$success = false;
		$name = $phone = $url = $email = $company = $notes = $promo_code = '';

		if(isset($_POST['bmg_submit']) && empty($_SESSION['form_submit'])) {
	
		$name = esc_attr($_POST['bmg-name']);
		$url = esc_attr($_POST['bmg-url']);
		$email = esc_attr($_POST['bmg-email']);
		$phone = esc_attr($_POST['bmg-phone']);
		$token_id = stripslashes( $_POST['token']);
		$promo_code = esc_attr($_POST['bmg-promo-code']);

		if(empty($name)) {
			$error_message['name'] = 'Please enter your name'; 
			$aria_state['name'] = 'true';
		}
		
		if(empty($url)) {
			$error_message['url'] = 'Please enter URL'; 
			$aria_state['url'] = 'true';
		}
		if(empty($email)) {
			$error_message['email'] = 'Please enter your email address';
			$aria_state['email'] = 'true';
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
			$error_message['email'] = 'Please enter a valid email address';
			$aria_state['email'] = 'true';
		}
		if(empty($phone)) {
			$error_message['phone'] = 'Please enter phone number'; 
			$aria_state['phone'] = 'true';
		}
		if(!empty($promo_code)) {

			$posts = get_posts(array(
	'numberposts'	=> -1,
	'post_type'		=> 'promo_system',
	'meta_key'		=> 'promo_code',
	'meta_value'	=> $promo_code
));

		if(count($posts) == 0) {
			 $error_message['promo_code'] = "Coupon code does not exists";
			 $aria_state['promo_code'] = 'true';
		}

		if($posts) {
			$expiration_date = get_post_meta($posts[0]->ID, "expiration_date", true);
			$current_date = date("m-d-Y");	
			$exp_date = date("m-d-Y", strtotime($expiration_date));
			$active = get_post_meta($posts[0]->ID, "active", true);
			if($active)
			{
				if($exp_date < $current_date){
				 $error_message['promo_code'] = "Coupon code is expired";
			 	$aria_state['promo_code'] = 'true';
				}	
			} else {
				$error_message['promo_code'] = "Coupon code does not exists";
			 	$aria_state['promo_code'] = 'true';
			}
		
			
		}

			
	}



			// If there is no error 
		if(count($error_message) == 0 && !get_transient( 'token_' . $token_id )) {


				$success = true;
				set_transient( 'token_' . $token_id, 'dummy-content', 60 );
			$toadmin = 'sales@accessibilityshield.com';
			$mail_subject = 'Schedule Demo Request from ' . $name;
			$body = "<table>
								<tr>
								 	<th>Name</th>
								 	<td>" . $name . "</td>
								 </tr>
								 <tr>
								 	<th> URL</th>
								 	<td>" . $url . "</td>
								 </tr>
								 <tr>
									<th> Email </th>
									<td>" . $email . "</td>
							  	  </tr>
							  	  <tr>
									<th> Phone </th>
									<td>" . $phone . "</td>
							  	  </tr>
							  	  <tr>
									<th> Coupon code </th>
									<td>" . $promo_code . "</td>
							  	  </tr>
							  </table>
							  ";
			$headers = array('Content-Type: text/html; charset=UTF-8');
			 
			$admin_mail = wp_mail( $toadmin, $mail_subject, $body, $headers );

			if($admin_mail == false) {
				$mail_error = "Failed to send your message. Please try later or contact the administrator by another method.";
			}
			$_SESSION['form_submit'] = 'true';			  
		} else {
			$_SESSION['form_submit'] = NULL;
		}

	}
	$token_id = md5( uniqid( "", true ) );
	

		if($success && $admin_mail) {
			
		$url = get_site_url() . "/promo/" . $promo_code;

		
		wp_redirect( $url );
		exit;
	}


	$container   = get_theme_mod( 'understrap_container_type' );

?>	
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics --> <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142589892-1"></script>
	<script>
	   window.dataLayer = window.dataLayer || [];
	   function gtag(){dataLayer.push(arguments);}
	   gtag('js', new Date());

	   gtag('config', 'UA-142589892-1');
	</script>
</head>

<body <?php body_class(); ?>>

<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->

		<header class="navbar navbar-expand-md navbar-dark py-3">

			<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>		

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>

					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>


					<?php } else {
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						echo '<a class="logo" rel="home" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" itemprop="url">';
						echo '<img width="338" class="logo" src="' . $image[0] . '" alt="return to home page">';
						echo '</a>';
					} ?><!-- end custom logo -->


				

			   

               

				
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</header><!-- .site-navigation -->



<div class="wrapper pt-0" id="page-wrapper" id="main" role="main">
	<div class="container">
	<div class="row">
		<div class="col-sm-7 v-center">
			<div style="">
<div class="row">
    <div class="col-md-3"><span style="font-size: 2rem; vertical-align:top;">$</span><span style="font-size: 3.25rem">1,000</span><br><span style="font-size:0.8rem"> <span style="margin-left:30px; vertical-align:top"><em>Limited time offer</em><span> </span></span></span></div>
    <div class="col-md-7" style="text-align:justify; margin-left: 20px"><ul>
			<li>Partner with an accessibility team to build your legal defense.</li>
			<li>Learn what you need to be compliant and expand your market.</li>
		</ul>
</div>

    </div>    
    <p></p>
			<h1> The Web ADA Starter Pack</h1>
			<h2 class="audit-sub-title"> The simplest, most secure way to begin your company's journey toward ADA
				 compliance</h2>
			<p>
				Web ADA Starter Pack Includes:
				<ul>
					<li>Manual Assessment from IAAP Certified Testers using Screen Readers</li>
					<li>Accessibility Statement</li>
					<li>Preliminary Audit including customized recommended Course of Action</li>
				</ul>
			<p style="Text-align:Justify; Margin-right: 40px">
				Understanding the accessibility of your company's website is the first step on the journey to peace of mind. Maintaining an accessible website allows all users to access your content, expanding your potential audience by more than 20%. It also gives you peace of mind, knowing that you are protected from costly litigation.
			</p>
			</div>
		</div>	
		<div class="col-sm-5">
			<div class="audit-contact-form">
				 <h1>Contact Us</h1>	
				<?php
					

			
	$output .= '<div role="form" class="">
				<form method="post" action="" novalidate>
					<div class="form-group">
						<label for="bmg-url">URL: (required)</label>
						<input type="text" name="bmg-url" id="bmg-url" aria-required="true" aria-invalid="' . $aria_state['url'] . '" aria-describedby="bmg-url-error" placeholder="Enter URL" value="' . $url . '" class="form-control sqr-field" />';

						if($error_message['url']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-url-error">' . $error_message['url'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-url-error"></span>';
						}

					$output .=	'</div>

					<div class="form-group">
						<label for="bmg-name">Full Name: (required)</label>
						<input type="text" name="bmg-name" id="bmg-name" aria-required="true" aria-invalid="' . $aria_state['name'] . '" aria-describedby="bmg-name-error" placeholder="Enter Full Name" value="' . $name . '" class="form-control sqr-field" />';

						if($error_message['name']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-name-error">' . $error_message['name'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-name-error"></span>';	
						}

				$output .=	'</div>


					<div class="form-group">
						<label for="bmg-phone">Phone: (required)</label>
						<input type="text" name="bmg-phone" id="bmg-phone" aria-required="true" aria-invalid="' . $aria_state['phone'] . '" aria-describedby="bmg-phone-error" placeholder="Enter Phone" value="' . $phone . '" class="form-control sqr-field" />';

						if($error_message['phone']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-phone-error">' . $error_message['phone'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-phone-error"></span>';
						}

				$output .=	'</div>

					
	
					<div class="form-group">
						<label for="bmg-email">Email: (required)</label>
						<input type="email" name="bmg-email" id="bmg-email" aria-required="true" aria-invalid="' . $aria_state['email'] . '" aria-describedby="bmg-email-error" placeholder="Enter Email" value="' . $email . '" class="form-control sqr-field" />';

						if($error_message['email']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-email-error">' . $error_message['email'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-email-error"></span>';
						}

				$output .=	'</div>


					<div class="form-group">
						<label for="bmg-promo-code">Coupon code:</label>
						<input type="text" name="bmg-promo-code" id="bmg-promo-code" aria-required="true" aria-invalid="' . $aria_state['promo_code'] . '" aria-describedby="bmg-promo-code-error" placeholder="Enter coupon code" value="' . $promo_code . '" class="form-control sqr-field" />';

						if($error_message['promo_code']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-promo-code-error">' . $error_message['promo_code'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-promo-code-error"></span>';
						}

				$output .=	'</div>

						

					<div class="form-group">
					 <input type="hidden" name="token" value="' . $token_id . '" />
						<input type="submit" name="bmg_submit" value="Submit" class="btn btn-lg bmg-submit">
					</div>';
						if($mail_error) {
							$output .= '<div role="alert" class="bmg-forms-mail-error">' . $mail_error . '</div>';
						}
					
				$output .= '</form>
	';

	echo $output;

	
				?>
				<div class="audit-form-note">
					By submitting your information you agree to be contacted by Accessibility Shield. Submitting this form is not an agreement to purchase. One of our representatives will contact you and discuss terms of payment. There is no obligation to purchase.
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-12 text-center">
			<h1>Web ADA Lawsuits Are On The Rise</h1>
			<h2 class="audit-sub-title-2">
				Avoid costly litigation by understanding the accessibility of your company's website. The Web ADA Starter Pack provides everything you need to understand start your compliance journey and defend against drive-by lawsuits. The sooner you begin the safer you will be.
			</h2>
		</div>
	</div>
</div>

<div class="container">
	<div class="row mt-5 audit-feature">
		<div class="col-md-3 text-center">
			<img class="img-fluid" style="" src="<?php echo get_stylesheet_directory_uri();?>/img/bulb.png" alt="">
			<h3 class="audit-feature-title mt-2">Understand Compliance</h3>
		</div>

		<div class="col-md-3 text-center">
			<img class="img-fluid" style="" src="<?php echo get_stylesheet_directory_uri();?>/img/shield.png" alt="">
			<h3 class="audit-feature-title mt-2">Protect Against Drive-By Lawsuits</h3>
		</div>

		<div class="col-md-3 text-center">
			<img class="img-fluid" style="" src="<?php echo get_stylesheet_directory_uri();?>/img/aim.png" alt="">
			<h3 class="audit-feature-title mt-2">Target Accessibility; Increase Your Audience </h3>
		</div>

		<div class="col-md-3 text-center">
			<img class="img-fluid" style="" src="<?php echo get_stylesheet_directory_uri();?>/img/yoga.png" alt="">
			<h3 class="audit-feature-title mt-2">Peace of Mind</h3>
		</div>

	</div>
</div>

				
</div>
<div class="container-fluid">
	<div class="row mt-5 mb-2">
		<div class="col-md-6  audit-bottom-column">
			<h1>Magic Software Doesn't Exist</h1>
			<h2 class="audit-sub-title-2">Becoming ADA compliant requires manual testing. There is no magic artificial intelligence software that automates the work. </h2>
		</div>

		<div class="col-md-6 ashield-checklist">
			
				<div class="chk-container"><span class="check-icon"></span> <span class="chk-list-text">Scan up to 100 pages</span></div>
				<div class="chk-container"><span class="check-icon"></span> <span class="chk-list-text">Manual Test of up to 5 pages</span></div>
				<div class="chk-container"><span class="check-icon"></span> <span class="chk-list-text">Breakdown of violation types across your site</span></div>
				<div class="chk-container"><span class="check-icon"></span> <span class="chk-list-text">Recommended path for Remediation</span></div>
				<div class="chk-container"><span class="check-icon"></span> <span class="chk-list-text">Professional Customized Assessment from our IAAP certified team</span></div>
			
		</div>
	</div>
</div>	
</div>

<?php get_footer(); ?>