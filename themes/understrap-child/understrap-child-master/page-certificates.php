<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
a { color:#077af1; text-decoration: none; }
a:hover { text-decoration: underline; }
body { font-family: Arial; }
	@font-face {
  font-family: 'FontAwesome';
  src: url("<?php echo get_bloginfo('stylesheet_directory') . "/fonts/fontawesome-webfont.eot?v=4.7.0"; ?>");
  src: url("<?php echo get_bloginfo('stylesheet_directory') . "/fonts/fontawesome-webfont.eot?#iefix&v=4.7.0"; ?>") format("embedded-opentype"), 
  url("<?php echo get_bloginfo('stylesheet_directory') . "/fonts/fontawesome-webfont.woff2?v=4.7.0"; ?>") format("woff2"), 
  url("<?php echo get_bloginfo('stylesheet_directory') . "/fonts/fontawesome-webfont.woff?v=4.7.0"; ?>") format("woff"), url("../fonts/fontawesome-webfont.ttf?v=4.7.0") format("truetype"), url("<?php echo get_bloginfo('stylesheet_directory') . "/fonts/fontawesome-webfont.svg?v=4.7.0#fontawesomeregular"; ?>") format("svg");
  font-weight: normal;
  font-style: normal; }
.fa {
  display: inline-block;
  font: normal normal normal 14px/1 FontAwesome;
  font-size: inherit;
  text-rendering: auto;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale; }

	@font-face {
  font-family: 'KameronBold';
  src: url("<?php echo get_bloginfo('stylesheet_directory') . "/fonts/Kameron-Bold.ttf"; ?>") format("truetype");
  }

 .fa-check-circle-o:before {
  content: ""; }

 .fa-times-circle-o:before {
  content: ""; }


   
.cp-page { width:80%; border: 8px solid #000; margin: 75px auto; border-radius: 8px; padding: 75px;   }
.cp-heading { margin-top:100px; font-size:57px; font-family: 'KameronBold', Sans Serif; }
.cp-logo { width: 300px; }
.cp-status-content { display: flex; background-color: #ebebeb; padding: 30px; margin: 0 auto; border-radius: 15px; align-items: center; margin-bottom: 38px; width:35%; word-wrap: break-word; word-break: break-all; }
.asx-check, .asx-cross { color: #309226; font-size: 100px; margin-right: 40px;}
.asx-cross { color: red; }
.cp-status {  flex-grow: 1; font-size: 20px; font-family: Arial; }
.cp-status-value {  float: right; }
.cp-valid, .cp-invalid { text-transform: uppercase; color: #309226; font-weight: bold; }
.cp-invalid {  color:red; }
@media (max-width: 1024px) {
		.cp-status-content { width: 55%; }
		.cp-page { padding: 50px; margin: 50px auto; }
}

@media (max-width: 800px) {
	.cp-status-content { width: auto; }
	.cp-heading { font-size: 18px; }
}

@media(max-width: 416px) {
	.cp-page { padding: 30px; margin: 30px auto; border:5px solid #000; }
	.cp-logo { width: 150px; }
	.asx-check, .asx-cross { font-size: 40px; margin-right: 25px; }
	.cp-status { font-size: 16px; }

}

@media(max-width: 360px) {
	.cp-page { padding: 15px; margin: 15px auto; }
}
</style>
</head>
<body class='A11y'>
<?php
$guid = isset($_GET['guid']) ? $_GET['guid'] : 1;
$showLogo = isset($_GET['showlogo']) ? $_GET['showlogo'] : 1;
$showHr = isset($_GET['showhr']) ? $_GET['showhr'] : 1;
$newPage = isset($_GET['newpage']) ? $_GET['newpage'] : 0;
$linkOpen = $newPage ? "target='_blank'" : "";


/* Link styles */
$link = isset($_GET['link']) ? '#' . $_GET['link'] : '#0000EE';
$alink = isset($_GET['alink']) ? '#' . $_GET['alink'] : '#0000EE';
$vlink = isset($_GET['vlink']) ? '#' . $_GET['vlink'] : '#551A8B';
$hlink = isset($_GET['hlink']) ? '#' . $_GET['hlink'] : '#551A8B';


function get_category_statement($value) {
	if($value == "certified") {
		return "certified compliant";
	} else {
		return "in the process of becoming certified";
	}
}

?>

<div class="cp-page">
<div class="a11yStatement">	
<?php if($showLogo): ?>

<div class="center-text mb-10">
	<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>logo-r-clear.png" alt="" class="cp-logo" />
	
</div>
<?php endif; ?>

<?php 
global $post;



$site_guid = get_the_title();

		$posts = get_posts(array(
	'numberposts'	=> 1,
	'post_type'		=> 'badge',
	's'	=> $guid
));


		
		if($posts) {
				$client_name = get_post_meta($posts[0]->ID, "client_name", true);
				$website = get_post_meta($posts[0]->ID, "website_name", true);
				$email = get_post_meta($posts[0]->ID, "email", true);
				$phone = get_post_meta($posts[0]->ID, "phone", true);
				
				if($phone !== "") {
					$phone = " or by telephone at <b>" . $phone . "</b>";
				} else {
					$phone = "";
				}
				$posting_date = get_post_meta($posts[0]->ID, "post_date", true);
				$active = get_post_meta($posts[0]->ID, "active", true);
				$status = get_field_object('status', $posts[0]->ID); //get_post_meta($posts[0]->ID, "status", true);

				$category = get_field_object('category', $posts[0]->ID);	
				$valid_to = get_field_object('valid_to', $posts[0]->ID);
				$post_date = date("F jS Y", strtotime($posting_date));



				if($active): 
?>

<h1 class="cp-heading">Accessibility Shield Badge Certification</h1>

<div class="cp-status-content">

	<div>
	<?php if ($status['value'] == "valid") { ?>
		<i class="fa fa-check-circle-o asx-check" aria-hidden="true"></i>
<?php	} else { ?>
		<i class="fa fa-times-circle-o asx-cross" aria-hidden="true"></i>
<?php
}
?>
</div>
	<div class="cp-status">
		<div><strong>URL :</strong><span class="cp-status-value"><?php echo $website; ?></span></div>
		<div style="clear: both;"></div>
		<div><strong>Status :</strong><span class="cp-status-value <?php echo $status['value'] == 'valid' ?  'cp-valid' : 'cp-invalid'; ?>"><?php echo ucwords($status['value']); ?></span></div>
		<div style="clear: both;"></div>
	</div>
</div>


<p>The website listed above is certified WCAG 2.1 AA compliant by Accessibility Shield. This means the site meets significant conformance to these standards and is accessible with Assistive Technology (AT) devices such as screen readers. Websites displaying this badge are being monitored by Accessibility Shield using professional testers who are native AT users. This means they live with a disability, such as blindness, paralysis, deafness, tremors or cognitive disabilities that requires them to use methods other than a mouse or touchscreen to navigate the web.</p>

<p>Testers are trained for this work and their perspectives provide valuable insight into accessibility barriers that make navigation difficult or impossible for other disabled users. These individuals work alongside our auditors and programmers to implement solutions that make all content inclusive to all users.</p>

<p>
The Accessibility Shield Badge Certification is a labor-intensive, comprehensive process which involves extensive testing by auditors and testers, some of whom who are living with disabilities. All assessments are carried out using methodology based on the <a href="https://www.w3.org/TR/WCAG21/">Web Content Accessibility Guidelines (WCAG) 2.1,Level AA criteria</a>. This standard meets or exceeds the legal requirements for private industry and government agencies in North America, the European Union, the United Kingdom, and other nations. For more detail on specific requirements in any country please consult the relevant governing body
</p>

<p>If you would like more information about how Accessibility Shield works to make the web fair and equal for all users, please contact us at <a href="mailto:sales@accessibilityshield.com">sales@accessibilityshield.com </a>.</p>

<p><a href="mailto:support@accessibilityshield.com?subject=Misuse%20of%20Badge">Report a misuse of this badge</a></p>


<?php else: ?>
<h1 class="center-text mt-50 mb-50">This site is not currently being monitored by Accessibility Shield</h1>

<?php endif; ?>

<?php
		}		
wp_reset_postdata(); 
?>
</div>
</div>
</body>