<?php

$error_message = [];
		$aria_state = [];
		$aria_state['name'] = 'false';
		$aria_state['company'] = 'false';
		$aria_state['url'] = 'false';
		$aria_state['email'] = 'false';
		$aria_state['phone'] = 'false';
		$aria_state['notes'] = 'false';
		$aria_state['promo_code'] = 'false';
		$success = false;
		$name = $phone = $url = $email = $company = $notes = $promo_code = '';
		$coupon_entered = false;

		if(isset($_POST['bmg_submit']) && empty($_SESSION['form_submit'])) {
	
		$name = esc_attr($_POST['bmg-name']);
		$company = esc_attr($_POST['bmg-company']);
		$url = esc_attr($_POST['bmg-url']);
		$email = esc_attr($_POST['bmg-email']);
		$phone = esc_attr($_POST['bmg-phone']);
		$token_id = stripslashes( $_POST['token'] );
		$notes = esc_attr($_POST['bmg-notes']);
		$promo_code = esc_attr($_POST['bmg-promo-code']);


		if(empty($name)) {
			$error_message['name'] = 'Please enter your name'; 
			$aria_state['name'] = 'true';
		}
		if(empty($company)) {
			$error_message['company'] = 'Please enter company name'; 
			$aria_state['company'] = 'true';
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
				 $error_message['promo_code'] = "Promo code does not exists";
				 $aria_state['promo_code'] = 'true';
			}

			if($posts) {
				$coupon_entered = true;
				$expiration_date = get_post_meta($posts[0]->ID, "expiration_date", true);
				$current_date = date("m-d-Y");	
				$exp_date = date("m-d-Y", strtotime($expiration_date));
				$active = get_post_meta($posts[0]->ID, "active", true);
				if($active)
				{
					if($exp_date < $current_date){
					 $error_message['promo_code'] = "Promo code is expired";
				 	$aria_state['promo_code'] = 'true';
					}	
				} else {
					$error_message['promo_code'] = "Promo code does not exists";
				 	$aria_state['promo_code'] = 'true';
				}
			
			}
		} 

		

		



			// If there is no error 
		if(count($error_message) == 0 && !get_transient( 'token_' . $token_id )) {


				$success = true;
				set_transient( 'token_' . $token_id, 'dummy-content', 60 );
			$toadmin = 'sales@accessibilityshield.com';
			$mail_subject = 'Promo Code Request from ' . $name;
			$body = "<table>
								<tr>
								 	<th>Name</th>
								 	<td>" . $name . "</td>
								 </tr>
								 <tr>
								 	<th> Company</th>
								 	<td>" . $company . "</td>
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
									<th> Notes </th>
									<td>" . $notes . "</td>
							  	  </tr>
							  	  <tr>
									<th> Promo code </th>
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


			if($coupon_entered)
			{
				$url = get_site_url() . "/promo/" . $promo_code;		
			}
			else 
			{
				$url = get_site_url() . "/promo-success/";
			}
		

		
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
				<p class="bmg-form-heading">Thank you for your interest in our promotion!</p>
				<p>Our low price is: 50 $ </p>
				<?php
					

			
	$output .= '<div role="form" class="bmg-schedule-demo-frm mb-5">
				<form method="post" action="" novalidate>
					<div class="form-group">
						<label for="bmg-name">Name: (required)</label>
						<input type="text" name="bmg-name" id="bmg-name" aria-required="true" aria-invalid="' . $aria_state['name'] . '" aria-describedby="bmg-name-error" placeholder="Name *" value="' . $name . '" class="form-control sqr-field" />';

						if($error_message['name']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-name-error">' . $error_message['name'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-name-error"></span>';	
						}

				$output .=	'</div>

					

					<div class="form-group">
						<label for="bmg-company">Company: (required)</label>
						<input type="text" name="bmg-company" id="bmg-company" aria-invalid="' . $aria_state['company'] . '" placeholder="Company *" class="form-control sqr-field" value="' . $company . '" />';
						if($error_message['company']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-company-error">' . $error_message['company'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-company-error"></span>';
						}

					$output .= '</div>

					<div class="form-group">
						<label for="bmg-url">URL: (required)</label>
						<input type="text" name="bmg-url" id="bmg-url" aria-required="true" aria-invalid="' . $aria_state['url'] . '" aria-describedby="bmg-url-error" placeholder="URL *" value="' . $url . '" class="form-control sqr-field" />';

						if($error_message['url']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-url-error">' . $error_message['url'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-url-error"></span>';
						}

					$output .=	'</div>
	
					<div class="form-group">
						<label for="bmg-email">Email: (required)</label>
						<input type="email" name="bmg-email" id="bmg-email" aria-required="true" aria-invalid="' . $aria_state['email'] . '" aria-describedby="bmg-email-error" placeholder="Email *" value="' . $email . '" class="form-control sqr-field" />';

						if($error_message['email']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-email-error">' . $error_message['email'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-email-error"></span>';
						}

				$output .=	'</div>


				<div class="form-group">
						<label for="bmg-phone">Phone: (required)</label>
						<input type="text" name="bmg-phone" id="bmg-phone" aria-required="true" aria-invalid="' . $aria_state['phone'] . '" aria-describedby="bmg-phone-error" placeholder="Phone *" value="' . $phone . '" class="form-control sqr-field" />';

						if($error_message['phone']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-phone-error">' . $error_message['phone'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-phone-error"></span>';
						}

				$output .=	'</div>


				<div class="form-group">
						<label for="bmg-notes">Notes:</label>
						<textarea type="text" name="bmg-notes" id="bmg-notes" rows="5" aria-required="true" aria-invalid="' . $aria_state['notes'] . '" aria-describedby="bmg-notes-error" placeholder="Notes " value="' . $notes . '" class="form-control sqr-field"></textarea>';

						if($error_message['notes']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-notes-error">' . $error_message['notes'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-notes-error"></span>';
						}

				$output .=	'</div>

					<div class="form-group">
						<label for="bmg-promo-code">Coupon code:</label>
						<input type="text" name="bmg-promo-code" id="bmg-promo-code" aria-required="true" aria-invalid="' . $aria_state['promo_code'] . '" aria-describedby="bmg-promo-code-error" placeholder="Do you have a coupon? *" value="' . $promo_code . '" class="form-control sqr-field" />';

						if($error_message['promo_code']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-promo-code-error">' . $error_message['promo_code'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-promo-code-error"></span>';
						}

				$output .=	'</div>

						

					<div class="form-group text-center">
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
			</div>	

			<div class="col-sm-6">

			</div>
		</div>
	</div>
</div>	

<?php get_footer(); ?>