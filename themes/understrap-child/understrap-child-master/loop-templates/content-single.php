<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
		$post_meta = get_post_custom();
		$org_link = get_post_meta($post->ID, 'link', true);
		$title = get_the_title();

	?>
	<header class="entry-header">

		<h1><?php echo $title; ?></h1>


		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<div>
			<strong>Original Source:</strong> <?php echo "<a target='_blank' aria-label='Original Source' href=" . $org_link . ">" . $org_link . "</a>"; ?>	
		</div>

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

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
