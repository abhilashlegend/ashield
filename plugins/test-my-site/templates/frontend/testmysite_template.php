<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$hide = get_field('hide');

if($hide) {
	$home_url = get_home_url();
	wp_redirect($home_url);
}

?>

<?php

global $post;

$company_image = get_field('company_image');

$company_image_alt = get_field('company_image_alt_tag');

$company_name = get_field('company_name');

$image_background = get_field('image_background');

if($image_background == 'blue') {
	$image_background = '#01366D';
}


?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<title><?php wp_title('sdfsdf'); ?></title>
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
	<a class="skip-link sr-only sr-only-focusable" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to accessibility shield homepage', 'understrap' ); ?></a>	


<style type="text/css">
	.tms-target::before, .tms-target::after {
		background: <?php  echo $image_background; ?>
	}
</style>

<div class="container-fluid report-container">
	<div class="cover-page">
		<a href="https://accessibilityshield.com/" class="asx-inv-link">WWW.ACCESSIBILITYSHIELD.COM</a>
		<div class="tms-target-outer" style="background-color: <?php echo $image_background; ?>">
			<div class="tms-target <?php echo $cls = $image_background == '#01366D' ? 'tms-target-color-white' : ''; ?>"" style="background-color: <?php echo $image_background; ?>">
				<div class="tms-target-cont">
					<h1 aria-label="test my site report">TEST MY SITE</h1>
					<div class="tms-h2-style" aria-hidden="true">REPORT</div>

					<div class="for">FOR</div>

					<div class="tms-cmp-name"><?php echo $company_name; ?></div>
					<?php if(isset($company_image)): ?>
					<img src="<?php echo $company_image; ?>" alt="<?php echo $company_image_alt; ?>" class="tms-company-logo" />
					<?php endif; ?>
				</div>
			</div>
		</div>


		

		<?php /*
		<div class="<?php echo $cls = $image_background != 'none' ? 'tms-company-img-cont' : ''; ?>" style="background-color: <?php echo $image_background; ?>" >
			<?php if(isset($company_image)): ?>
			<img src="<?php echo $company_image; ?>" alt="<?php echo $company_image_alt; ?>" class="tms-company-logo" />
			<?php endif; ?>
		</div>
		*/ ?>

			
		<img src="<?php echo plugins_url( '../../assets/public/images/shield.png' , __FILE__ ); ?>" alt="" class="tms-asx-logo" />
	</div> <!-- End of cover page -->
</div>

	<?php

		$scope =  get_field('scope');	

		$logo = $scope["logo"];

		$logo_alt = $scope["logo_alt_tag"];

		$scope_website = $scope["website"];

		$review_date = $scope["date"];

		$eval_details = get_field('eval_details');

		$site_score = $eval_details["site_score"];

		$site_status = $eval_details["site_status"];

		

		



		$summary = $eval_details["summary"];

	?>
<div class="container">
	<div class="row mt-5">
		<div class="col-sm-12">
			<span class="tms-title-arrow"></span><h2 class="tms-section-title">  Executive Summary</h2>
			<p class="tms-para">This focused report is intended to be the first step in accessibility compliance. Accessibility Shield, together with Pennsylvania’s Office of Vocational Rehabilitation Services, has created an Accessibility Testing program for native Assistive Technology users to provide authentic feedback on digital accessibility and usability. This valuable blend of accessibility and usability results in the most inclusive experience for all users.
			</p>


			<span class="tms-title-arrow"></span><h2 class="tms-section-title">Background about Evaluation </h2>
			<p class="tms-para">Our mission is to make websites and other digital assets as inclusive as possible without relying long term on band aid approaches. We have paired developers who are passionate about accessibility along with native Assistive Technology users who directly benefit from the changes we make. Through this collaboration and our focus not only on accessibility but also usability we are helping our clients create truly accessible and inclusive digital products. </p>


			<span class="tms-title-arrow"></span><h2 class="tms-section-title">Scope of Review</h2>

			<?php if(isset($logo)): ?>
				<img src="<?php echo $logo; ?>" alt="<?php echo $logo_alt; ?>" class="tms-scope-logo" />
			<?php endif; ?>
			<div class="mt-3">
				<img src="<?php echo plugins_url( '../../assets/public/images/globe.png' , __FILE__ ); ?>" alt="" class="tms-scope-icon" />
				<a href="#"  class="tms-scope-website"><?php echo $scope_website; ?></a>
			</div>

			<div class="mt-4 mb-3">
					<img src="<?php echo plugins_url( '../../assets/public/images/calendar.png' , __FILE__ ); ?>" alt="" class="tms-scope-icon" />
					<span class="tms-dor">Date of Review: <?php echo $review_date; ?></span>
			</div>
			<p style="page-break-after: Always"></p>
			<div class="mt-5">
				<span class="tms-title-arrow"></span><h2 class="tms-section-title">Review Process </h2>
				<p class="tms-para mb-4">
					Site scoring is based on an automated analysis of the four core principles of accessibility: Perceivable, Operable, Understandable and Robust. It is intended to provide a general overview of WCAG compliance and to measure progress. 
				</p>
				<p class="tms-para">
					The page(s) listed were evaluated using Accessibility Shield’s proprietary auto-scan system in accordance with WCAG 2.1 AA conformance standards. Manual auditing was performed using NVDA and JAWS screen readers on Windows 10 along with Chrome and Firefox browsers. This review was performed using methodology developed by Accessibility Shield and in conformance with W3C and 508 standards. 
				</p>
			</div>


			
		</div>
	</div>

	<div class="row">
		<div class="col-sm-7">
			<span class="tms-title-arrow"></span>
			<h2 class="tms-section-title">Site Evaluation Details</h2>

			<div class="tms-tab-summary">
				<h3 class="tms-sub-title">Summary</h3>
				<p class="tms-para mt-1">
				<?php echo $summary; ?>
				</p> 
			</div>
		</div>

		<div class="col-sm-5 text-center">

				<?php if($site_score): ?>
				<div class="circle" id="site-score"></div>

					<script type="text/javascript">
						
						Circles.create({
							id:           'site-score',
							value:        <?php echo $site_score; ?>,
							radius:       100,
							width:        10,
							duration:     1,
							colors:       ['#e4e4e4', '#145b8e']
						});

						
					</script>

				<?php else: 

					if($site_status == "needs improvement") { ?>
						<img src="<?php echo plugins_url( '../../assets/public/images/needs_improvement.png' , __FILE__ ); ?>" alt="" class="tms-site-status" />
					<div><p class="tms-para">Needs Improvement</p></div>

				<?php	} elseif($site_status == "accessible") { ?>
						<img src="<?php echo plugins_url( '../../assets/public/images/accessible.png' , __FILE__ ); ?>" alt="" class="tms-site-status" />
						<div><p class="tms-para">Accessible</p></div>

			<?php	} else { ?>
						<img src="<?php echo plugins_url( '../../assets/public/images/not_accessible.png' , __FILE__ ); ?>" alt="" class="tms-site-status" />	
						<div><p class="tms-para">Not Accessible</p></div>			
				<?php } ?>
				<?php endif; ?>
		</div>
	</div>

	<?php

	$usability_details = get_field('usability_details');	

	?>

	<div class="row">
		<div class="col-sm-12">
				<div class="tms-usability">
					<div>
					<img src="<?php echo plugins_url( '../../assets/public/images/usability.png' , __FILE__ ); ?>" alt="" class="tms-usability-image" />
					</div><h2 class="tms-usability-title">Usability Details</h2>
				</div>

				

				<?php
					foreach ($usability_details as $detail) {
						echo '<span class="tms-title-arrow"></span><h3 class="tms-section-title">' . $detail['title'] . '</h3>';

						echo '<p class="tms-para mb-5">' . $detail['note'] . '</p>';
					}
				?>


				
		</div>
	</div>

	<?php

		$accessibility_details = get_field('accessibility_details');

	?>
	<div class="row">
		<div class="col-sm-12">
				
				<div class="tms-accessibility">
					<div>
					<img src="<?php echo plugins_url( '../../assets/public/images/accessibility.png' , __FILE__ ); ?>" alt="" class="tms-usability-image" />
					</div><h2 class="tms-usability-title">Accessibility Details</h2>
				</div>

				<div class="tms-asx-note">
					Below you will find several violations found by our team on the Home Page. The CSS selector and WCAG Success Criteria are listed along with a note from the tester about the violation. 
				</div>	


				<div class="tms-accessibility-details">

				<?php if(count($accessibility_details) > 0 && $accessibility_details[0]["css_selector"] != ""): ?>
				<ul>

				<?php

						foreach ($accessibility_details as $detail) {
							echo '<li><span class="tms-arrow-icon"></span>
							<div class="tms-css-selector">' 
								. $detail["css_selector"] . '
							</div>
							<div class="tms-wcag-def">' . $detail["wcag_definition"] . '</div>
							<div class="tms-asx-dtl-notes">' 
								. $detail["notes"] . '
							</div>
							</li>';
						}

				?>
				</ul>
			<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<span class="tms-title-arrow"></span><h2 class="tms-section-title">Recommendations</h2>

			<?php 
				$recommendations = get_field('recommendations');
				if($recommendations): 
				?>
				<ul class="tms-recommendations mb-5">
				<?php 

					

						foreach ($recommendations as $recommendation) {

						echo '<li><span class="tms-tick-icon"></span> ' . $recommendation["recommendation"] . '</li>';
						
						}		

				?>
				</ul>
			<?php endif; ?>

			<span class="tms-title-arrow"></span><h2 class="tms-section-title">Limitations </h2>

			<p class="tms-para mb-1">
			Site Score - The results have not been validated to eliminate false positive results. This score is not comprehensive due to the limitations of automated scanning. Validation and Manual auditing are required to increase the accuracy of this score. This score is not intended to be compared with other accessibility company scores. 
			</p>
			<p class="tms-para mt-0">
				This report was performed on the dates listed above and the site may have changed since that time. 
			</p>

			<div class="mt-3">
				<span class="tms-title-arrow"></span><h2 class="tms-section-title">References </h2>
			</div>
			<ul class="tms-references">
			<li>
				<span class="tms-arrow-icon"></span>
				<div class="tms-ref"><a target="_blank" href="https://www.w3.org/WAI/intro/wcag">Web Content Accessibility Guidelines (WCAG) Overview</a></div>
				<div class="tms-reflink"><a target="_blank" aria-hidden="true" href="https://www.w3.org/WAI/intro/wcag">https://www.w3.org/WAI/intro/wcag</a></div>
			</li>

			<li>
				<span class="tms-arrow-icon"></span>
				<div class="tms-ref"><a target="_blank" href="https://www.w3.org/TR/WCAG21/">Web Content Accessibility Guidelines 2.1</a></div>
				<div class="tms-reflink"><a target="_blank" aria-hidden="true" href="https://www.w3.org/TR/WCAG21/">https://www.w3.org/TR/WCAG21/</a></div>
			</li>

			<li>
				<span class="tms-arrow-icon"></span>
				<div class="tms-ref"><a target="_blank" href="https://www.w3.org/WAI/WCAG21/Techniques/">Techniques for WCAG 2.1</a></div>
				<div class="tms-reflink"><a target="_blank" aria-hidden="true" href="https://www.w3.org/WAI/WCAG21/Techniques/">https://www.w3.org/WAI/WCAG21/Techniques/</a></div>
			</li>

			<li>
				<span class="tms-arrow-icon"></span>
				<div class="tms-ref"><a target="_blank" href="http://www.w3.org/WAI/eval/">Accessibility Evaluation Resources</a></div>
				<div class="tms-reflink"><a target="_blank" aria-hidden="true" href="http://www.w3.org/WAI/eval/">http://www.w3.org/WAI/eval/</a></div>
			</li>

			<li>
				<span class="tms-arrow-icon"></span>
				<div class="tms-ref"><a target="_blank" href="https://www.w3.org/WAI/ER/tools/">Web Accessibility Evaluation Tools List</a></div>
				<div class="tms-reflink"><a target="_blank" aria-hidden="true" href="https://www.w3.org/WAI/ER/tools/">https://www.w3.org/WAI/ER/tools/</a></div>
			</li>

			<li>
				<span class="tms-arrow-icon"></span>
				<div class="tms-ref"><a target="_blank" href="https://www.w3.org/WAI/eval/reviewteams">Using Combined Expertise to Evaluate Web Accessibility</a></div>
				<div class="tms-reflink"><a target="_blank" aria-hidden="true" href="https://www.w3.org/WAI/eval/reviewteams">https://www.w3.org/WAI/eval/reviewteams</a></div>
			</li>
			
		</ul>

		<div class="tms-footer-link">
			<a href="https://accessibilityshield.com/">W  W  W  .  A  C  C  E  S  S  I  B  I  L  I  T  Y  S  H  I  E  L  D  .  C  O  M</a>
		</div>
		</div>


				
	</div>	

</div>	



	<?php wp_footer(); ?>
</body>
</html>