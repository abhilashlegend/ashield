<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'understrap_posted_on' ) ) {
	function understrap_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> (%4$s) </time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on   = apply_filters(
			'understrap_posted_on', sprintf(
				'<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span>',
				esc_html_x( 'Posted on', 'post date', 'understrap' ),
				esc_url( get_permalink() ),
				apply_filters( 'understrap_posted_on_time', $time_string )
			)
		);
		$byline      = apply_filters(
			'understrap_posted_by', sprintf(
				'<span class="byline"> %1$s<span class="author vcard"><a class="url fn n" href="%2$s"> %3$s</a></span></span>',
				$posted_on ? esc_html_x( 'by', 'post author', 'understrap' ) : esc_html_x( 'Posted by', 'post author', 'understrap' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
		echo $posted_on . $byline; // WPCS: XSS OK.
	}
}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( 'understrap_entry_footer' ) ) {
	function understrap_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'understrap' ) );
			 $cat = strpos($categories_list, "Uncategorized");
			
			if(!$cat){
			if ( $categories_list && understrap_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				
					printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'understrap' ) . '</span>', $categories_list ); // WPCS: XSS OK.
				
			}
		}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'understrap' ) );
			if ( $tags_list ) {
				/* translators: %s: Tags of current post */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'understrap' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'understrap' ), esc_html__( '1 Comment', 'understrap' ), esc_html__( '% Comments', 'understrap' ) );
			echo '</span>';
		}
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'understrap' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'understrap_categorized_blog' ) ) {
	function understrap_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'understrap_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'understrap_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so components_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so components_categorized_blog should return false.
			return false;
		}
	}
}


/**
 * Flush out the transients used in understrap_categorized_blog.
 */
add_action( 'edit_category', 'understrap_category_transient_flusher' );
add_action( 'save_post',     'understrap_category_transient_flusher' );

if ( ! function_exists( 'understrap_category_transient_flusher' ) ) {
	function understrap_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'understrap_categories' );
	}
}



function bmg_display_services() {
	?>
	<div class="row">
		<div class="col-sm-12">
				<h2 class="primary-block-header"><span>Do I need to make</span> my site accessible? </h2>
		</div>
	</div>
	<div class="row">
		
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="bmg-cherry-banner style1">
				<div class="bmg-cherry-banner_wrap" style="">	
					<div class="cherry-banner_content px-3">
						<p class="blue-text">As developers, we’ve been aware of the disability requirements for over 20 years. We have helped many companies meet over 500 requirements. However, we always saw them as just some red tape. This all changed when a visually impaired client showed up at our door, complete with the stereotypical guide dog and white cane. He shared his experiences with us and we immediately saw digital accessibility as much more than red tape. It is a legitimate problem. A problem that we are now working to solve. It was in this instant that Accessibility Shield was founded and it has been our driving force for what we do.</p>

						<p class="blue-text">Covid really changed how we use the internet in our everyday lives. More importantly, it drastically changed how we us it in our business lives. This shift has affected people with disabilities more than anyone, as they now were required to be online. They can no longer walk to the corner store for what they needed. They are now forced to do more shopping online. Have you ever tried ordering groceries online with your eyes closed? It isn’t the easiest task.</p>

					</div>
					
				</div>
			</div>
		</div> <!-- End of cols -->

		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="bmg-cherry-banner style1">
				<div class="bmg-cherry-banner_wrap" style="">	
					<div class="cherry-banner_content px-3">
						<p class="blue-text">The human need is huge factor driving regulations. Digital Accessibility has been a requirement for over 20 years. Yes, 20 years. The issue, is that it’s only been enforced over the last few years. Most people are still not aware of these requirements, which at the very least will hurt your bottom dollar as you miss out on twenty-six percent of a market by being inaccessible to those with disabilities. That’s right, over one fourth of the population has some sort of physical or mental disability. If you do not take the needed steps to being ADA compliant, you’re hurting your bottom dollar in a significant manner. </p>

						<p class="blue-text">The consequences can be much worse than some missed business. The trend is clear, in 2019 and 2020, there was over ten thousand ADA Title III lawsuits in each of the last three years. The current global pandemic makes these ADA issues were more glaring for business. With more of a need to do business online, the more valuable you are to these lawsuits. The year 2021 is currently on pace to break the record for most of these ADA lawsuits. As more states become involved in consumer protection regulation, including accessibility, these numbers will only continue to rise. </p>

					</div>
					
				</div>
			</div>
		</div> <!-- End of cols -->	


	</div> <!-- End of row -->


	<div class="row cta-row">
		<div class="col-sm-12 text-center px-3">
			<h3 class="blue-text">Avoid these risks. Take the first step and get your free evaluation</h3>
			
		</div>	
	</div> <!-- End of row -->	
<?php 
} 
?>
<?php
function bmg_display_who() {
	?>
<div class="row mb-5">
	<div class="col-10 offset-1">
		<div class="">
		<?php
			// query for the about page
		    $your_query = new WP_Query( 'pagename=who-is-accessibility-shield' );
		    // "loop" through query (even though it's just one page) 
		    while ( $your_query->have_posts() ) : $your_query->the_post();
		    	?>

		    	<h2 class="bmg-block-title"> <?php  ucwords(the_title()); ?> </h2>
				<div> 
					<?php the_content(); ?>
				</div>
		       
		<?php
		    endwhile;
		    // reset post data (important!)
		    wp_reset_postdata();
		?>

		</div>	
	</div>
</div>
<?php
}
?>	

<?php
function bmg_display_contact_form() {
	?>

<div class="bmg-wrapper-contact">
	<div class="jumbotron">
		<div class="container">
			<div class="row">
		<div class="col-md-6 v-center">
			<img class="img-fluid asx-devices" src="<?php echo get_stylesheet_directory_uri();?>/img/devices.png" alt="">
		</div>		

		<div class="col-md-6">
		<h2 class="mb-5 text-center">Enter your information below, and we will reach out to schedule a free report</h2>

		<?php

		$error_message = [];
		$aria_state = [];
		$aria_state['name'] = 'false';
		$aria_state['company'] = 'false';
		$aria_state['url'] = 'false';
		$aria_state['email'] = 'false';
		$aria_state['phone'] = 'false';
		//$aria_state['message'] = 'false'
		$success = false;
		$name = $phone = $url = $email = $company = '';

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
		if(count($error_message) == 0 && !get_transient( 'token_' . $token_id )) {
				$success = true;
				set_transient( 'token_' . $token_id, 'dummy-content', 60 );
			$toadmin = 'sales@accessibilityshield.com';
			$mail_subject = 'Schedule Free Report from ' . $name;
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
	  				 Thank you! One of our compliance professionals will be in touch to schedule your free report.
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>';
		$name = $email = $phone = $url = $company = $message = '';
	}
	$output .= '<div role="form" class="bmg-contact-frm">
				<form method="post" action="" novalidate>
					<div class="form-group">
						<label for="bmg-name">Name: (required)</label>
						<input type="text" name="bmg-name" id="bmg-name" aria-required="true" aria-invalid="' . $aria_state['name'] . '" aria-describedby="bmg-name-error" placeholder="Name *" value="' . $name . '" class="form-control rnd-field" />';

						if($error_message['name']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-name-error">' . $error_message['name'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-name-error"></span>';	
						}

				$output .=	'</div>

					

					<div class="form-group">
						<label for="bmg-company">Company: (required)</label>
						<input type="text" name="bmg-company" id="bmg-company" aria-invalid="' . $aria_state['company'] . '" placeholder="Company *" class="form-control rnd-field" value="' . $company . '" />';
						if($error_message['company']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-company-error">' . $error_message['company'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-company-error"></span>';
						}

					$output .= '</div>

					<div class="form-group">
						<label for="bmg-url">URL: (required)</label>
						<input type="text" name="bmg-url" id="bmg-url" aria-required="true" aria-invalid="' . $aria_state['url'] . '" aria-describedby="bmg-url-error" placeholder="URL *" value="' . $url . '" class="form-control rnd-field" />';

						if($error_message['url']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-url-error">' . $error_message['url'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-url-error"></span>';
						}

					$output .=	'</div>
	
					<div class="form-group">
						<label for="bmg-email">Email: (required)</label>
						<input type="email" name="bmg-email" id="bmg-email" aria-required="true" aria-invalid="' . $aria_state['email'] . '" aria-describedby="bmg-email-error" placeholder="Email *" value="' . $email . '" class="form-control rnd-field" />';

						if($error_message['email']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-email-error">' . $error_message['email'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-email-error"></span>';
						}

				$output .=	'</div>


				<div class="form-group">
						<label for="bmg-phone">Phone: (required)</label>
						<input type="text" name="bmg-phone" id="bmg-phone" aria-required="true" aria-invalid="' . $aria_state['phone'] . '" aria-describedby="bmg-phone-error" placeholder="Phone *" value="' . $phone . '" class="form-control rnd-field" />';

						if($error_message['phone']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-phone-error">' . $error_message['phone'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-phone-error"></span>';
						}

				$output .=	'</div>


				<div class="form-group">
						<label class="sr-only" for="bmg-message">Message: (optional)</label>
						<textarea type="text" rows="5" name="bmg-message" id="bmg-message"  placeholder="Message (optional)"  class="form-control rnd-field" />' . $message . '</textarea>';
						/*
						if($error_message['message']) {
							$output .= '<span role="alert" class="bmg-input-error" id="bmg-message-error">' . $error_message['message'] . '</span>';
						} else {
							$output .= '<span role="alert" class="" id="bmg-message-error"></span>';
						}
						*/	
				$output .=	'</div>

					

					<div class="form-group">
					 <input type="hidden" name="token" value="' . $token_id . '" />
						<input type="submit" name="bmg_submit" value="Submit" class="btn blue-curvy-btn px-5">
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
</div>
</div>
<?php 
}

function bmg_display_how_it_works()  { 
?>
	<div class="row mt-5">
		<div class="col-sm-12">
				<h2 class="block-header">How do I make my site accessible?</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<p class="grey-text">
				At our core,  Accessibility Shield is a team of expert software developers and project managers that have mastered making complex projects easy. Our goal, plain and simple, is to make life easier for all clients. Accessibility Shield is your partner in accessibility and will take the stress out of ADA compliance. We will work with your development team, every step of the way, to ensure your site meets the needed ADA requirements. Don’t have a development team? Well, our developers are more than equipped to take on the project and get your site up to the needed standards.	
			</p>
			<p class="grey-text">
				Each project is individually evaluated, given an audit and has a remediation plan created. The project is audited by our team that includes certified auditors, native assistive technology users as well as experienced developers. Once we identify and record all violations within our proprietary project management system, we hand it off to the developers who use the information to pinpoint what areas need to be amended, then perform the needed remedies for your website.
			</p>
			<p class="grey-text">
				In our project management portal, we include direct references to the violations on your project so there is no guess work. We also include links to relevant sections of the WCAG standards, links to appropriate techniques, as well as code suggestions for the more complex violations. Everything you need is at your fingertips.
			</p>
			<p class="grey-text">
				Our experts don’t just provide you the best service, we do it in a time effective manner. In fact, letting Accessibility Shield do the work for you is not just easier, it’s roughly 60% faster. Less time, means less money. This translates to more money in your pocket. 
			</p>
			<p class="grey-text">Give us a website URL and we’ll send you a free report. An easier life, filled with less stress is just one click away. </p>
		</div>
	</div>

<?php
}


function bmg_display_recent_news() { 
?>
<div class="row">
	<div class="col-sm-12">
		<h2 class="block-header">Recent News</h2>
	</div>
</div>	
<div class="row">
	<div class="col-sm-12">
		<div class="card-deck">
			<?php
				 $the_query = new WP_Query( array(
				      'posts_per_page' => 3,
				   )); 
			?>
			<?php if ( $the_query->have_posts() ) : ?>
  			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		  <div class="card">
		  	<?php  if(has_post_thumbnail(get_the_ID())): ?>
	
				<a aria-hidden="true" tabindex="-1" href="<?php esc_url(the_permalink()); ?>">
					<img aria-hidden="true" src="<?php echo get_the_post_thumbnail_url( $post->ID, 'thumbnail' ); ?>" alt=""></a>
		    
		    <?php else: ?>
		    	<a aria-hidden="true" href="<?php esc_url(the_permalink()); ?>">
		    <img aria-hidden="true" class="card-img-top img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/news-img-3.png" alt="">
		    <?php endif; ?></a>
		    <div class="card-body">
		       	
		      <h3 class="card-title bmg-news-title"><?php echo wp_trim_words(get_the_title(), 7); ?></h3>
		      <p class="card-text">  <?php
		 echo wp_trim_words(get_the_content(),20); 
		?></p>
		      <p><a aria-label="read more about <?php the_title(); ?>" class="btn read-more-bordered-btn" href="<?php esc_url(the_permalink()); ?>">Read More</a></p>
		    </div>
		  </div>
		  <?php endwhile; ?>
 		  <?php wp_reset_postdata(); ?>
 		  <?php else : ?>
		  	<p><?php __('No News'); ?></p>
		  <?php endif; ?>
		</div> <!-- ENd of card deck -->
	</div>
</div>
<?php
}

function bmg_display_work_with_my_type_of_site()  { 
?>
	<div class="row">
		<div class="col-sm-12">
				<h2 class="block-header">Do you work with my type of site?</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<p class="grey-text">
				We work with many different types of clients from many different industries with annual revenues ranging from five million to over a billion dollars. We work with medical sites, legal compliance agencies, regional real estate management companies, non-profits, colleges and educational companies, financial institutions and more. We have developers on staff that work or have worked with every major framework and programming language that has been used for the last 30 years. 
			</p>
		</div>
	</div>

<?php
}
function bmg_display_clients() { 
?>
<div class="row">
	<div class="col-sm-12">
		<h2 class="block-header">Our Clients</h2>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
			<div id="client-carousel" class="carousel slide mb-5" data-ride="carousel">
				 <div class="carousel-inner">
						<div class="carousel-item bmg-carousel-item active">
							 <div class="container client-logo-content">
								<div class="row">
									<div class="col-sm-4">
										<img class="img-fluid client-logo" src="<?php echo get_stylesheet_directory_uri();?>/img/american-airlines.png" alt="american-airlines" />
									</div>	
									<div class="col-sm-4">
										<img class="img-fluid client-logo" src="<?php echo get_stylesheet_directory_uri();?>/img/quickbooks.png" alt="quick books" />
									</div>
									<div class="col-sm-4">
										<img class="img-fluid client-logo" src="<?php echo get_stylesheet_directory_uri();?>/img/billcom.png" alt="Bill com" />
									</div>
								</div> <!-- End of row -->
							 </div> <!-- End of container -->
						</div> <!-- End of carousel item -->

				 </div> <!-- End of carousel-inner -->	
				 
			</div>	<!-- ENd of carousel -->
	</div> <!-- ENd of col sm 12 -->
</div>
<?php
}

function bmg_display_testimonials() { 
?>
<div class="row">
	<div class="col-sm-12">
		<h2 class="block-header">Testimonials</h2>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
			<div id="myCarousel" class="carousel slide mb-5" data-ride="carousel">
				 <div class="carousel-inner  px-5">
					<div class="carousel-item bmg-carousel-item active">
							 <div class="container">
								<div class="row">
									<div class="col-sm-4 text-center">
										<img src="<?php echo get_stylesheet_directory_uri();?>/img/testimonial-profile.png" class="img-fluid" alt="profile pic">
										<h3 class="testimonial-header mb-0">Eric H</h3>
										<small class="text-muted">Sr Developer for a large medical records provider.</small>
										<p class="text-muted">"One of my client’s legal team had expressed the need for their website to be ADA compliant. I reached out to Accessibility Shield to assist me in this. Their team was amazing and helped make a very complex project quite simple (for us, at least) in the end. They are extremely thorough and knowledgeable."
										</p>
									</div>

									<div class="col-sm-4 text-center">
										<img src="<?php echo get_stylesheet_directory_uri();?>/img/testimonial-profile.png" class="img-fluid" alt="profile pic">
										<h3 class="testimonial-header mb-0">Talia </h3>
										<small class="text-muted">New Marketing Inc.</small>
										<p class="text-muted">"I've built a company offering Accessibility Shield to clients."
										</p>
									</div>

									<div class="col-sm-4 text-center">
										<img src="<?php echo get_stylesheet_directory_uri();?>/img/testimonial-profile.png" class="img-fluid" alt="profile pic">
										<h3 class="testimonial-header mb-0">Stephanie </h3>
										<small class="text-muted">New Marketing Inc.</small>
										<p class="text-muted">"When it comes to compliance, these guys are the best in the business."
										</p>
									</div>
								</div>	
							 </div> <!-- End of container -->
					</div>
				 </div> <!-- End of carousel inner -->
				  
			</div> <!-- End of carousel -->
	</div> <!-- End of col sm 12 -->
</div> <!-- End of row -->	

<?php
}
?>