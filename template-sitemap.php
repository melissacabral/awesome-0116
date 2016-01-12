<?php 
/*
Template Name: Automatic Sitemap
*/
?>
<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
			<h2 class="entry-title"> 				
					<?php the_title(); ?> 				
			</h2>
			<div class="entry-content">
				<section class="onethird">
					<h3>Pages</h3>
					<ul>
						<?php wp_list_pages( array(
							'title_li' 		=> '',
							'sort_column'	=> 'post_title', 
						) ); ?>
					</ul>
				</section>
				<section class="onethird">
					<h3>Categories</h3>
					<ul>
						<?php wp_list_categories( array(
							'title_li' 		=> '',
							'show_count'	=> true,
						) ); ?>
					</ul>
				</section>
				<section class="onethird">
					<h3>Posts</h3>
					<ul>
						<?php wp_get_archives( array(
							'type' => 'alpha',
						) ); ?>	
					</ul>				
				</section>
			</div>
				
		</article><!-- end post -->

		<?php endwhile; ?>
	<?php else: ?>

	<h2>Sorry, Page not found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->


<?php get_footer(); //include footer.php ?>