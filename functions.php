<?php
//turn on featured images
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );

//allows you to visually style different kinds of content
add_theme_support( 'post-formats', array('audio', 'video', 'aside', 'gallery', 'image', 'quote', 'status', 'chat', 'link') );

//critical if you have a blog or news feed
add_theme_support( 'automatic-feed-links' );

//upgrade the markup that WP uses to HTML5
add_theme_support( 'html5', array( 'search-form', 'gallery', 'comment-list', 
	'comment-form', 'caption' ) );

//don't forget to remove <title> tag from header.php
//this makes <title> more SEO friendly!
add_theme_support( 'title-tag' );

//make a custom image size for the home page banner
//regenerate your thumbnails after adding image sizes
//				 name,      width, height, crop?
add_image_size( 'big-banner', 1045, 350, true );

//allows you to add editor-style.css to control the look of the editor window
add_editor_style();

//customize the_excerpt()
function awesome_excerpt_length(){
	return 30; //words
}
add_filter( 'excerpt_length', 'awesome_excerpt_length' );

function awesome_readmore(){
	return ' <a href="' . get_permalink() . '" class="readmore">Keep Reading</a>';
}
add_filter( 'excerpt_more', 'awesome_readmore' );


//make comment replies more user friendly
function awesome_comment_reply(){
	//attach <script>
	wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'awesome_comment_reply' );

//just another example of an action
function awesome_randomness(){
	echo '<div class="randomness">frickin lasers</div>';
}
//add_action( 'wp_footer', 'awesome_randomness' );

//register all the menu areas you need
function awesome_menus(){
	register_nav_menus( array(
		'main_menu' 	=> 'Main Navigation Menu',
		'utilities' 	=> 'Utilities',
	) );
}
add_action( 'init', 'awesome_menus' );


//Helper function to display pagination on any template
function awesome_pagination(){
	?>
	
	<section class="pagination">
			<?php 
			//numbered pagination was added in 4.1, so check before using it
			if( function_exists( 'the_posts_pagination' ) ){
				//numbered 
				the_posts_pagination( array(
					'next_text' => 'Next Page &rarr;',
					'prev_text' => '&larr;',
					'mid_size' 	=> 3,
				) ); 
			}else{
				previous_posts_link();
				next_posts_link();
			} ?>
	</section>

	<?php
} //end awesome_pagination()

//Create Widget Areas
add_action( 'widgets_init', 'awesome_widget_areas' );
function awesome_widget_areas(){
	register_sidebar( array(
		'name'			=> 'Blog Sidebar',
		'description'	=> 'Appears next to all blog pages',
		'id'			=> 'blog_sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Footer Area',
		'description'	=> 'Appears at the bottom of every page',
		'id'			=> 'footer_area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name'			=> 'Page Sidebar',
		'description'	=> 'Appears next to static pages',
		'id'			=> 'page_sidebar',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	
}

//Helper function to display product thumbnails anywhere on the site
function awesome_products( $number = 5, $title = ''  ){
	//get recent products (post type)
	$products = new WP_Query( array(
		'post_type' 		=> 'product',
		'posts_per_page' 	=> $number,
	) );
	//custom loop
	if( $products->have_posts() ){	 ?>
	
	<section id="featured-content">
		<h2><?php echo $title; ?></h2>
		<ul class="latest-products">
		<?php while( $products->have_posts() ){
				$products->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
					<div class="product-info">
						<h3><?php the_title(); ?></h3>
						<p><?php the_excerpt(); ?></p>
					</div>
				</a>
			</li>
		<?php } //end while ?>
		</ul>
	</section>
	<?php } // end if
	//clean up after a custom query
	wp_reset_postdata();
}

//Helper function to show up to 5 special "slideshow" posts
function awesome_slider(){
	$slider_posts = new WP_Query( array(
		'category_name' => 'slideshow',
		'posts_per_page' => 5,
	) );
	//custom loop
	if( $slider_posts->have_posts() ){
	?>
	<section id="awesome-slider">
		<ul>
			<?php while( $slider_posts->have_posts() ){
				$slider_posts->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'big-banner' ); ?>
					<h2><?php the_title(); ?></h2>
				</a>
			</li>
			<?php } //end while ?>
		</ul>
	</section>
	<?php
	} //end if
	wp_reset_postdata();
} //end of slider function

//Attach Javascript and CSS files
function awesome_scripts(){
	//jquery
	wp_enqueue_script( 'jquery' );

	//responsiveslides.js
	$rs = get_stylesheet_directory_uri() . '/js/responsiveslides.min.js' ;
	//					handle             url   deps      ver   footer?
	wp_enqueue_script( 'responsiveslides', $rs, 'jquery', '1.54', true );

	//main.js
	$main = get_stylesheet_directory_uri() . '/js/main.js';
	wp_enqueue_script( 'main', $main , 'responsiveslides', '1.0', true);

	//reset.css
	$reset = get_stylesheet_directory_uri() . '/styles/reset.css';
	wp_enqueue_style( 'reset', $reset );

	//style.css
	wp_enqueue_style( 'main-stylesheet', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'awesome_scripts' );

//customize the CSS of the login/register form
function awesome_login_css(){
	$url = get_stylesheet_directory_uri() . '/styles/login.css';
	wp_enqueue_style( 'login-css', $url );
}
add_action( 'login_enqueue_scripts', 'awesome_login_css' );

//customize where the logo link on the login form goes
function awesome_logo_link(){
	return home_url();  //go to home page of the site
}
add_filter( 'login_headerurl', 'awesome_logo_link' );

function awesome_logo_tooltip(){
	return 'Return to ' . get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'awesome_logo_tooltip' );

//Remove the WP logo/dropdown menu from the admin toolbar
// https://codex.wordpress.org/Toolbar  
// $wp_admin_bar is the parent toolbar object
function awesome_toolbar( $wp_admin_bar ){
	$wp_admin_bar->remove_node( 'wp-logo' );
	$wp_admin_bar->remove_node( 'comments' );

	$wp_admin_bar->add_node( array(
		'id' => 'get-help',
		'title' => '<span class="ab-icon dashicons dashicons-editor-help"></span>  	
						Get Help',
		'href'	=> 'http://wordpress.melissacabral.com',
	) );
}
add_action( 'admin_bar_menu', 'awesome_toolbar', 999 );

//Remove and add custom admin dashboard widgets
function awesome_dash_widgets(){
	//remove wordpress news
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );

	//							ID, title, callback function
	wp_add_dashboard_widget( 'dashboard_awesome', 'Title of the widget', 
		'awesome_dash_widget' );
}
add_action( 'wp_dashboard_setup', 'awesome_dash_widgets' );


function awesome_dash_widget(){
	echo '<iframe width="250" height="150" src="https://www.youtube.com/embed/_bq3hodfB2M" frameborder="0" allowfullscreen></iframe>';
}

//Customization API stuff
//https://codex.wordpress.org/Theme_Customization_API
add_action( 'customize_register', 'awesome_customize' );
function awesome_customize( $wp_customize ){
	//Text Color
	//create the setting. this is the data that goes in the DB
	$wp_customize->add_setting( 'awesome_text_color', array( 'default' => '#fff' ) );
	//color picker control UI
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'text_color',
		array(
			'label' => 'Body Text Color',
			'section' => 'colors', //this one is built-in
			'settings' => 'awesome_text_color', //the one we registered above
		) 
	) );

	//Layout Choices
	//make a new accordion section
	$wp_customize->add_section( 'awesome_layout', array(
		'title' => 'Site Layout',
		'priority' => 30,
	) );
	//make the setting. this gets stored in the DB
	$wp_customize->add_setting( 'awesome_sidebar_layout', array( 'default' => 'right' ) );
	//add a radio button UI
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'sidebar_layout',
		array(
			'label' 	=> 'Sidebar Layout', //human friendly
			'section' 	=> 'awesome_layout', //the section we added above
			'settings' 	=> 'awesome_sidebar_layout', //the setting from above
			'type'		=> 'radio',
			'choices'	=> array(
				//code 		=> human
				'left' 		=> 'Sidebar on the left',
				'right'		=> 'Sidebar on the right',
			),
 		)
	) );


	//LOGO Uploader
	$wp_customize->add_setting('awesome_logo');
	//cropper image upload UI
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
		$wp_customize,
		'logo',
		array(
			'label' 		=> 'Upload Your Logo',
			'section'		=> 'title_tagline', //Site identity section
			'settings' 		=> 'awesome_logo',
			'width'			=> 300,
			'height'		=> 100,
			'flex_width'	=> false, //prevent user from changing aspect ratio
			'flex_height'	=> false,
		)
	) );
}




//Apply the Customization to an embedded style sheet
add_action( 'wp_head', 'awesome_custom_css' );
function awesome_custom_css(){
	?>
	<style>
		#content{
			color:<?php echo get_theme_mod('awesome_text_color'); ?>;
		}

		<?php 
		//if the user wants the sidebar on the left, override the default floats
		if( get_theme_mod( 'awesome_sidebar_layout' ) == 'left' ){
			?>
			body #sidebar{
				float:left;
			}
			body #content{
				float:right;
			}
			<?php
		} //end if sidebar = left		 
		?>		

	</style>
	<?php
}

//no close PHP