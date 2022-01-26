<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

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
