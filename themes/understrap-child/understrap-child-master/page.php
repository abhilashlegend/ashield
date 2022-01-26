<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if(is_page('checkout') || is_page('cart')) {
	get_header('second');
} else {
	get_header();	
}


$container = get_theme_mod( 'understrap_container_type' );

?>



<div class="wrapper pt-0" id="page-wrapper" id="main" role="main">
	<?php if ( is_front_page() ) : ?>


	<div id="myCarousel" class="carousel slide mb-0" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="first-slide img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/hero-bg.png" alt="">
            <img class="second-slide img-fluid" src="<?php echo get_stylesheet_directory_uri();?>/img/hero-bg-medium.png" alt="">
            <div class="container-fluid">
				<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
	               			<img class="img-fluid asx-ppl-img" src="<?php echo get_stylesheet_directory_uri();?>/img/people-meeting.png" alt="">
	               			<img class="img-fluid asx-ppl-img-medium" src="<?php echo get_stylesheet_directory_uri();?>/img/people-meeting-medium.png" alt="">
	               </div>
	              <div class="text-left col-md-6 col-sm-6 col-xs-12 hero-content">
	                <h1 class="primary-block-header mb-3 text-left"><span>Take Control of Your</span> Digital Accessibility. </h1>
	                <h2 class="hero-tagline blue-text">Complexity should not be a barrier</h2>
	               <p class="carosel-text blue-text">Accessibility Shield’s revolutionary WCAG Accessibility Compliance project management system takes the stress out of accessibility compliance. There is no longer a need worry about the consequences if you are not ADA compliant, leave that to us.</p>
	               <p class="carosel-text blue-text">Start with a free evaluation and leave the stress to us. Let us show demonstrate how simple digital accessibility can be for you.</p>
	                <p class="hero-cta"><a class="btn blue-curvy-btn mr-2" href="<?php echo get_site_url(null, '/free-scan/'); ?>" role="button">Get a Free Report</a></p>
	                	
	              </div>
	               
              	</div> <!-- End of row -->
            </div> <!-- ENd of container -->
          </div>
        </div>
       
      </div>
	<?php // get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>
	<?php
	if(!is_front_page() && has_post_thumbnail( get_the_ID())) { 
?>
	<header class="entry-header bmg-page-banner">
		<?php 
		if($post->post_title == 'Our Mission') { 
		echo ''; 
	 } else if($post->post_title == 'Project Management Software') {
	 	echo '<div class="project-management-banner-context">';
		 the_title( '<h1 class="entry-title text-right">', '</h1>' );
		 echo '<div class="banner-sub-title text-right">for WCAG Compliance</div>';
		 echo '</div>';
	 } else {
	 	the_title( '<h1 class="entry-title text-center bmg-banner-title">', '</h1>' ); 
	 }
	 echo get_the_post_thumbnail( $post->ID, 'full' ); 
	 ?>
	</header><!-- .entry-header -->
<?php } ?>

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<div class="site-main"  >
				<!-- Add services block -->
				<?php if ( is_front_page() ) :
					
					bmg_display_services();

					bmg_display_who();

				 endif; 
				 ?>
				<!-- End of services block -->
					
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content', 'page' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>



			</div><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

<div class="container-fluid">
	<?php if ( is_front_page() ) :
					

					bmg_display_contact_form();

		    endif; 
	?>
</div>
<?php if ( is_front_page() ) : ?>
<div class="<?php echo esc_attr( $container ); ?>">
	<?php	bmg_display_how_it_works(); ?>
  <?php /* bmg_display_recent_news(); */ ?>
</div>
<?php endif; ?>

<?php if ( is_front_page() ) : ?>
<div class="free-scan-cta">  
<div class="container">
 
      <div class="row">
        <div class="col-sm-6">
            <img class="free-scan-img" src="<?php echo get_stylesheet_directory_uri();?>/img/free-scan.png" alt="">
        </div>
        <div class="col-sm-6 text-center">
            <h2> Free Scan </h2>
            <p>Do your clients need help with compliance?</p>
            
            <a href="<?php echo get_site_url(null, '/free-scan/'); ?>" class="btn free-scan-btn px-5">Free Scan</a>
        </div>
      </div>  
  </div>
</div>
<?php endif; ?>  

<?php if ( is_front_page() ) : ?>
<div class="<?php echo esc_attr( $container ); ?>">
  <?php  bmg_display_work_with_my_type_of_site();   ?>
</div>
<?php endif; ?>


<?php /* if ( is_front_page() ) : ?>
<div class="free-downloads">
  <h2> Free downloads ?</h2>
</div>
<?php endif; */ ?> 

<?php  if ( is_front_page() ) : ?> 
  <div class="<?php echo esc_attr( $container ); ?>">
       <?php bmg_display_testimonials(); ?>
  </div>  
<?php endif; ?>  

</div><!-- #page-wrapper -->
<?php
if(is_page('checkout') || is_page('cart')) {
 get_footer('second');
 }
 else {
 	get_footer();	
 } 
