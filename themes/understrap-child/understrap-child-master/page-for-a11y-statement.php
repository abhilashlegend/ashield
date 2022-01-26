<?php /* Template Name: page-for-a11y-statement */ ?>
<?php

$showLogo = isset($_GET['showlogo']) ? $_GET['showlogo'] : 1;
$showHr = isset($_GET['showhr']) ? $_GET['showhr'] : 1;
$newPage = isset($_GET['newpage']) ? $_GET['newpage'] : 0;
$linkOpen = $newPage ? "target='_blank'" : "";
$color = isset($_GET['color']) ? '#' . $_GET['color'] : '#000000';
$backgroundColor = isset($_GET['bgcolor']) ? '#' . $_GET['bgcolor'] : '#FFFFFF';

/* Link styles */
$link = isset($_GET['link']) ? '#' . $_GET['link'] : '#0000EE';
$alink = isset($_GET['alink']) ? '#' . $_GET['alink'] : '#0000EE';
$vlink = isset($_GET['vlink']) ? '#' . $_GET['vlink'] : '#551A8B';
$hlink = isset($_GET['hlink']) ? '#' . $_GET['hlink'] : '#551A8B';
?>
<style type="text/css">
	body { width: 70%; margin: 40px auto 20px auto; font-family: Arial; 
		color: <?php echo $color; ?>;
		background-color: <?php echo $backgroundColor; ?>;
	 }

	 a:link { color: <?php echo $link; ?>; }
	 a:active { color: <?php echo $alink; ?>; }
	 a:visited { color: <?php echo $vlink; ?>; }
	 a:hover { color: <?php echo $hlink; ?>;  }
	h1 { font-size: 24px; margin-bottom: 20px; }
 .center-text { text-align: center; }	
 .mb-10 { margin-bottom: 20px; }
 .mt-50 { margin-top: 50px; }
 .mb-50 { margin-bottom: 50px; }
 ul li { margin-bottom: 20px; }
</style>

<?php if($showLogo): ?>
<div class="center-text mb-10">
	
	<img class="size-medium wp-image-166 aligncenter" src="http://s00.d24.myftpupload.com/wp-content/uploads/2019/05/Color.png" alt="" width="400" />
</div>
<?php endif; ?>
<?php if($showHr): ?>
<hr size="10" color="#0D7D7C" />
<?php endif; ?>
<?php 
global $post;



$site_guid = get_the_title();

		$posts = get_posts(array(
	'numberposts'	=> -1,
	'post_type'		=> 'badge_program',
	'meta_key'		=> 'site_guid',
	'meta_value'	=> $site_guid
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
				$status = get_post_meta($posts[0]->ID, "status", true);

				$post_date = date("F jS Y", strtotime($posting_date));

				if($status): 
?>

<h1 class="center-text mt-50">Accessibility Statement</h1>

<p><b><?php echo $client_name; ?></b> is committed to facilitating the accessibility and usability of its website for people with disabilities. <b><?php echo $client_name; ?></b> has partnered with <a href="https://accessibilityshield.com/" <?php echo $linkOpen; ?>>Accessibility Shield</a> to make this site WCAG compliant and accessible for all users. <a href="https://accessibilityshield.com/" <?php echo $linkOpen; ?>>Accessibility Shield</a> has been retained to identify and fix accessibility barriers. <b><?php echo $client_name; ?></b> will be improving the accessibility of their website to all users including those with special needs such as visual, hearing, cognitive and motor impairments. <b><?php echo $client_name; ?></b> is committed to constantly improving the accessibility of their website to ensure they provide an equal and fair experience for all users.<p>

<p><b>Web Content Accessibility Guidelines (WCAG) 2.1</b></p>

<p>Wherever possible, the <?php echo $client_name; ?>’s site will adhere to a conformance level of AA of the <a href="https://www.w3.org/WAI/WCAG21/Understanding/" <?php echo $linkOpen; ?>>Web Content Accessibility Guidelines (WCAG 2.1)</a>. These guidelines outline four main principles that state that sites should be:</p>

<ul>
	<li><b>Perceivable</b> - Information and user interface components must be presentable to users in ways they can perceive</li>
	<li><b>Operable</b> - User interface components and navigation must be operable</li>
	<li><b>Understandable</b> - Information and the operation of user interface must be understandable</li>
	<li><b>Robust</b> - Content must be robust enough that it can be interpreted reliably by a wide variety of user agents, including assistive technologies</li>
</ul>

<p>Please be aware that our efforts are ongoing. If, at any time, you have specific questions or concerns about the accessibility of any of our Web pages, or if you’d like additional assistance please contact us at <b><a href="mailto:<?php echo $email; ?>"  <?php echo $linkOpen; ?>><?php echo $email; ?></a></b> <?php echo $phone; ?>. If you do encounter an accessibility issue, please be sure to specify the Web page in your email, and we will make all reasonable efforts to make that page accessible for you. We try to respond to feedback within 5 business days.</p>

<p>To help us assist you with any issues you have, it is recommended that you read the WAI’s <a href="https://www.w3.org/WAI/users/inaccessible" <?php echo $linkOpen; ?>>Contacting Organizations about Inaccessible Websites</a>, and provide the information advised in your request.</p>

<p><b>Website:</b> <?php echo $website; ?></p>
<p><b>Revised on:</b> <?php echo $post_date; ?></p>

<?php else: ?>
<h1 class="center-text mt-50 mb-50">This site is not currently being monitored by Accessibility Shield</h1>

<?php endif; ?>

<?php if($showHr): ?>
<hr size="10" color="#0D7D7C" />
<?php endif; ?>

<?php
		}		
wp_reset_postdata(); 
?>