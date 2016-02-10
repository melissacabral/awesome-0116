<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix cf' ); ?>>

			<?php the_post_thumbnail( 'large' ); ?>

			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>
			<div class="entry-content">

				<?php the_terms( get_the_id(), 'brand', '<div>Brand: ', ', ', '</div>'  ); 
				?>

				<?php the_terms( get_the_id(), 'feature', '<div>Features: ', ', ', '</div>'  ); ?>
				
				<?php the_meta();  //show all custom fields (price/size) ?>

				<?php the_content(); ?>
				<?php 
				//for paginated posts 
				wp_link_pages( array(
					'next_or_number' => 'next',
					'before' 		=> '<div class="post-pagination">Keep reading this post: ', 
					'after'			=> '</div>',

				) );  
				?>
			</div>
					
		</article><!-- end post -->

		<section class="pagination">
			<?php previous_post_link( '%link', 'Previously: %title' ); ?>
			<?php next_post_link( '%link', 'Next: %title' ); ?>
		</section>

		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar('shop'); //include sidebar-shop.php ?>
<?php get_footer(); //include footer.php ?>