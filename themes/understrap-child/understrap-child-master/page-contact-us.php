<?php

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<header class="entry-header bmg-page-banner">
		<img src="<?php echo get_stylesheet_directory_uri();?>/img/contactus-banner.png">
	</header>
<div class="wrapper page contact-us-page" id="page-wrapper">

	

	<div class="<?php echo esc_attr( $container ); ?>" role="main" id="content" tabindex="-1">
		<div class="row" >
			<div class="bmg-cf-parent">

				<div class="bmg-cf-child">
				<h1 class="text-center">Contact Us</h1>
				<p class="bmg-form-heading text-center">Enter your comments / queries and we will reach out to you.</p>


				<?php

		$error_message = [];
		$aria_state = [];
		$success = false;
		$name = $email = $comment = '';
		$aria_state['name'] = 'false';
		$aria_state['email'] = 'false';
		$aria_state['comment'] = 'false';

			if(isset($_POST['bmg_submit']) && empty($_SESSION['form_submit'])) {
	
		$name = esc_attr($_POST['bmg-name']);
		$email = esc_attr($_POST['bmg-email']);
		$comment = esc_attr($_POST['bmg-comment']);
		$token_id = stripslashes( $_POST['token'] );

		if(empty($name)) {
			$error_message['name'] = 'Please enter your name'; 
			$aria_state['name'] = 'true';
		}
		if(empty($email)) {
			$error_message['email'] = 'Please enter your email address';
			$aria_state['email'] = 'true';
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
			$error_message['email'] = 'Please enter a valid email address';
			$aria_state['email'] = 'true';
		}
		if(empty($comment)) {
			$error_message['comment'] = 'Please enter your comments'; 
			$aria_state['comment'] = 'true';
		}
		


			// If there is no error 
		if(count($error_message) == 0 && !get_transient( 'token_' . $token_id ) && $_POST['HP-accept'] == null) {
				$success = true;
				set_transient( 'token_' . $token_id, 'dummy-content', 60 );
			$toadmin = 'sales@accessibilityshield.com';
			$mail_subject = 'Contact Submission from ' . $name;
			$body = "<table>
								<tr>
								 	<th>Name</th>
								 	<td>" . $name . "</td>
								 </tr>
								 <tr>
									<th> Email </th>
									<td>" . $email . "</td>
							  	  </tr>
							  	  <tr>
								 	<th> Comment</th>
								 	<td>" . $comment . "</td>
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
	  				Thank you! we will soon contact you.
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>';
		$name = $email = $comment = '';
	}
	$output .= '<div role="form" class="bmg-contactus-frm mb-3">
				<form method="post" action="" novalidate>
					<div class="form-group">
						<label class="" for="bmg-name">Name: (required)</label>
						<input type="text" name="bmg-name" id="bmg-name" aria-required="true" aria-invalid="' . $aria_state['name'] . '" aria-describedby="bmg-name-error" placeholder="Name *" value="' . $name . '" class="form-control sqr-field" />';

						if($error_message['name']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-name-error">' . $error_message['name'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-name-error"></span>';	
						}

				$output .=	'</div>

				<div class="form-group">
						<label class="" for="bmg-email">Email: (required)</label>
						<input type="email" name="bmg-email" id="bmg-email" aria-required="true" aria-invalid="' . $aria_state['email'] . '" aria-describedby="bmg-email-error" placeholder="Email *" value="' . $email . '" class="form-control sqr-field" />';

						if($error_message['email']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-email-error">' . $error_message['email'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-email-error"></span>';
						}

				$output .=	'</div>

					<div class="form-group">
						<label for="bmg-comment">Comment: (required)</label>
						<textarea name="bmg-comment" id="bmg-comment" aria-invalid="' . $aria_state['comment'] . '" placeholder="Your comments *" class="form-control sqr-field">' . $comment . '</textarea>';
						if($error_message['comment']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-comment-error">' . $error_message['comment'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-comment-error"></span>';
						}

					$output .= '</div>

					<div class="form-group text-center mb-0">
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

</div> <!-- End of wrapper -->


<?php get_footer(); ?>