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
add_action( 'wp_footer', 'awesome_randomness' );

//no close PHP