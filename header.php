<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php 
	//Necessary in <head> for JS and plugins to work. 
	//I like it before style.css loads so the theme stylesheet is more specific than all others.
	wp_head();  ?>

	<!-- note!  All stylesheets and scripts are added in the functions.php file -->
</head>
<body <?php body_class(); ?>>	
	<div id="wrapper">
	<header role="banner">
		<div class="top-bar clearfix">
			
			<?php //logo customizer demo. this will look like shite ?>
			<!--  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			 <?php echo wp_get_attachment_image( get_theme_mod('awesome_logo'), 'full' ); ?>
			 </a> -->

			<h1 class="site-name">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ) ?>" rel="home"> 
					<?php bloginfo('name'); ?> 
				</a>
			</h1>
			<h2 class="site-description"> <?php bloginfo('description'); ?> </h2>
			  
			<?php 
			//don't forget to register theme locations in functions.php
			wp_nav_menu( array(
				'theme_location' => 'main_menu',
				'container'		=> 'nav', 	//wrap woth <nav>
				'menu_class'	=> 'nav', 	//<ul class="nav">
			) ); ?>


		</div><!-- end .top-bar -->
		
		<?php wp_nav_menu( array(
			'theme_location' => 'utilities',
			'container' 	=> false,
			'menu_class'	=> 'utilities',
			'fallback_cb'	=> false,  //no fallback behavior if this menu area is empty
		) ); ?>

		<?php get_search_form(); //includes searchform.php if it exists, if not, this outputs the default search bar ?>	
	</header>
