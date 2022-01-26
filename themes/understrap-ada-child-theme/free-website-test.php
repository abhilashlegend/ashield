<?php /* Template Name: free-website-test */ ?>
<?php
get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>
	
<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main" role="main">
			
					
				<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<?php
	if(!is_front_page()) { 
?>
	<header class="entry-header bmg-page-banner">

		<?php the_title( '<h1 class="entry-title text-center bmg-banner-title">', '</h1>' ); ?>
		<?php echo get_the_post_thumbnail( $post->ID, 'full' ); ?>
	</header><!-- .entry-header -->
<?php } ?>


	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->


					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
