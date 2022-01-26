<?php

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper page free-scan-page" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" role="main" id="content" tabindex="-1">
		<div class="row">
			<div class="col-md-12">
				<p class="bmg-form-heading">To receive a Free Scan of your site fill out the form below. We will provide a domain analysis and an overview of any issues pertaining to ADA compliance.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 offset-3 mt-4">
				<?php

		$error_message = [];
		$aria_state = [];
		$success = false;
		$name = $phone = $url = $email = $company = '';
		$aria_state['name'] = 'false';
		$aria_state['company'] = 'false';
		$aria_state['url'] = 'false';
		$aria_state['email'] = 'false';
		$aria_state['phone'] = 'false';	
		//$aria_state['message'] = 'false'

			if(isset($_POST['bmg_submit']) && empty($_SESSION['form_submit'])) {
	
		$name = esc_attr($_POST['bmg-name']);
		$company = esc_attr($_POST['bmg-company']);
		$url = esc_attr($_POST['bmg-url']);
		$email = esc_attr($_POST['bmg-email']);
		$phone = esc_attr($_POST['bmg-phone']);
		$message = esc_attr($_POST['bmg-message']);
		$token_id = stripslashes( $_POST['token'] );

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


			// If there is no error 
		if(count($error_message) == 0 && !get_transient( 'token_' . $token_id ) && $_POST['HP-accept'] == null) {
				$success = true;
				set_transient( 'token_' . $token_id, 'dummy-content', 60 );
			$toadmin = 'sales@accessibilityshield.com';
			$mail_subject = 'Free Scan Request from ' . $name;
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
									<th> Message </th>
									<td>" . $message . "</td>
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
			$output = '<div class="alert alert-success alert-dismissible fade show" role="alert">
	  				Thank you! One of our compliance professionals will be in touch to verify your information.
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>';
		$name = $email = $phone = $url = $company = $message = '';
	}
	$output .= '<div role="form" class="bmg-contact-frm mb-5">
				<form method="post" action="" novalidate>
					<div class="form-group">
						<label class="sr-only" for="bmg-name">Name: (required)</label>
						<input type="text" name="bmg-name" id="bmg-name" aria-required="true" aria-invalid="' . $aria_state['name'] . '" aria-describedby="bmg-name-error" placeholder="Name" value="' . $name . '" class="form-control sqr-field" />';

						if($error_message['name']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-name-error">' . $error_message['name'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-name-error"></span>';	
						}

				$output .=	'</div>

					

					<div class="form-group">
						<label class="sr-only" for="bmg-company">Company: (required)</label>
						<input type="text" name="bmg-company" id="bmg-company" aria-invalid="' . $aria_state['company'] . '" placeholder="Company" class="form-control sqr-field" value="' . $company . '" />';
						if($error_message['company']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-company-error">' . $error_message['company'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-company-error"></span>';
						}

					$output .= '</div>

					<div class="form-group">
						<label class="sr-only" for="bmg-url">URL: (required)</label>
						<input type="text" name="bmg-url" id="bmg-url" aria-required="true" aria-invalid="' . $aria_state['url'] . '" aria-describedby="bmg-url-error" placeholder="URL" value="' . $url . '" class="form-control sqr-field" />';

						if($error_message['url']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-url-error">' . $error_message['url'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-url-error"></span>';
						}

					$output .=	'</div>
	
					<div class="form-group">
						<label class="sr-only" for="bmg-email">Email: (required)</label>
						<input type="email" name="bmg-email" id="bmg-email" aria-required="true" aria-invalid="' . $aria_state['email'] . '" aria-describedby="bmg-email-error" placeholder="Email" value="' . $email . '" class="form-control sqr-field" />';

						if($error_message['email']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-email-error">' . $error_message['email'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-email-error"></span>';
						}

				$output .=	'</div>


				<div class="form-group">
						<label class="sr-only" for="bmg-phone">Phone: (required)</label>
						<input type="text" name="bmg-phone" id="bmg-phone" aria-required="true" aria-invalid="' . $aria_state['phone'] . '" aria-describedby="bmg-phone-error" placeholder="Phone" value="' . $phone . '" class="form-control sqr-field" />';

						if($error_message['phone']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-phone-error">' . $error_message['phone'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-phone-error"></span>';
						}

				$output .=	'</div>


				<div class="form-group">
						<label class="sr-only" for="bmg-message">Message: (optional)</label>
						<textarea type="text" rows="5" name="bmg-message" id="bmg-message"  placeholder="Message (optional)"  class="form-control sqr-field" />' . $message . '</textarea>';
						/*
						if($error_message['message']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-message-error">' . $error_message['message'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-message-error"></span>';
						}
						*/	
				$output .=	'</div>

					

					<div class="form-group text-center">
					 <input type="hidden" name="token" value="' . $token_id . '" />';

					  if($_POST["HP-accept"]) {
							$is_spam = "checked";
					 } else {
							$is_spam = "";
					  }

					  $output .= '<label for="HP-accept" aria-hidden="true" class="sr-only">Accept<input type="radio" name="HP-accept" id="HP-accept" style="display:none" value="1"></label>
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
		</div>
	</div>

</div>

<?php get_footer(); ?>