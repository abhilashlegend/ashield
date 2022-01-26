<?php
	$categories = get_the_category($post->ID);
?>


<article class="col-md-4" id="post-<?php the_ID(); ?>" >
		
	<?php  if(has_post_thumbnail(get_the_ID())): ?>
	
		
			<img src="<?php echo get_the_post_thumbnail_url( $post->ID, 'thumbnail' ); ?>" alt="" />
    
    <?php else: ?>
    	
		<img   style="border: 1px solid #ccc;" src="<?php echo get_stylesheet_directory_uri();?>/img/news-img-3.png ?>" alt="" />
	

<?php endif; ?>
<div class="card-body">
    <div class="title">
                <h2 class="card-title bmg-news-title">
                    <a aria-label="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
                </h2>
                <p>
                	<?php /* foreach ($categories as $category) : ?>
                         	
    						<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo $category->name; ?>" class="tag-default"><?php echo $category->name; ?></a>

    				<?php endforeach; */ ?>

    				<span class="legend-default">
        					<i class="fa fa-clock-o"></i><span class="updated"> <?php the_time('M d, Y'); ?></span>
        					
        			</span>
    
</p>
            </div> <!-- End of title -->

	

	

	<div class="intro">
		<p class="card-text">
		<?php
		 echo wp_trim_words(get_the_content(),65); 
		?>
		</p>
		<a aria-hidden="true" tabindex="-1" href="<?php esc_url(the_permalink()); ?>" class="more-link">Read more</a>
		

	</div><!-- end of intro -->
</div> <!-- ENd of card body -->
	

</article><!-- #post-## -->
