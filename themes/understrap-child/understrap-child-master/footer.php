<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper bmg-wrapper-footer" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-3">

				<footer class="site-footer" id="colophon">

					<div class="site-info">
						<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>white_logo_footer.png" alt="" />
						

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

			<div class="col-md-3">
				<div class="footer-title">Quick Links</div>
				<div class="footer-link-box" role="navigation">
					<ul class="footer-links">
						<li><a href="<?php echo get_site_url(); ?>">Home</a></li>
						<li><a href="<?php echo get_site_url(null, '/project-management/'); ?>">How it Works</a></li>
						<li><a href="<?php echo get_site_url(null, '/auditing/'); ?>">Manual Testing</a></li>
						<li><a href="<?php echo get_site_url(null, '/remediation-consulting/'); ?>">Remediation</a></li>
						<li><a href="<?php echo get_site_url(null, '/schedule-demo/'); ?>">Schedule Demo</a></li>
					</ul>

					<ul class="footer-links">
						<li><a href="<?php echo get_site_url(null, '/our-mission/'); ?>">Our Mission</a></li>
						<li><a href="<?php echo get_site_url(null, '/news-blog/'); ?>">News/Blog</a></li>
						
						<li><a href="<?php echo get_site_url(null, '/contact-us/'); ?>">Contact Us</a></li>
						<li><a href="<?php echo get_site_url(null, '/terms-of-service/'); ?>">Terms</a></li>
						<li><a href="<?php echo get_site_url(null, '/privacy-policy/'); ?>">Privacy</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-3">
				<div class="footer-title">Contact</div>
				<div class="footer-contact-box">
					<ul class="footer-links">
						<li>1920 W. Marshall St., Suite #2D, Norristown, Pa. 19403</li>
						<li>866-525-9195 </li>
						<li> sales@accessibilityshield.com </li>
						<li><a href="https://accessibilityshield.com/accessibility-statement/" aria-label="Accessibility Statement"><img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/' ?>white_logo_footer_icon.png" alt="" /> Accessibility Statement</a>
						</li>
					</ul>
					
				</div>
			</div>

			<div class="col-md-3">
				<div class="footer-title">Subscribe to our Newsletter
</div>
				<?php
				es_subbox( $namefield =  "NO", $desc = "", $group = "" );  
				?>
				<div class="footer-social-links">
					<a href="https://www.facebook.com/a11yshield/" aria-label="facebook link"><i class="fa fa-facebook-f"></i></a>
					<a href="https://www.linkedin.com/company/accessibility-shield/" aria-label="linkedln link"><i class="fa fa-linkedin"></i></a>
					<a href="https://twitter.com/A11yShield" aria-label="twitter link"><i class="fa fa-twitter"></i></a>
					
				</div>
			</div>

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->
<div class="footer-bottom">
	<small class="text-muted">© Copyright <?php echo date('Y'); ?>. All Rights Reserved.</small>

</div>
</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>
<!-- begin olark code -->
<script type="text/javascript">
;(function(o,l,a,r,k,y){if(o.olark)return;
r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0];
y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r);
y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)};
y.extend=function(i,j){y("extend",i,j)};
y.identify=function(i){y("identify",k.i=i)};
y.configure=function(i,j){y("configure",i,j);k.c[i]=j};
k=y._={s:[],t:[+new Date],c:{},l:a};
})(window,document,"static.olark.com/jsclient/loader.js");
/* Add configuration calls below this comment */
olark.identify('5636-331-10-7039');</script>
<!-- end olark code -->

</body>

</html>

