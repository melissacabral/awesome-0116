<?php
//turn on featured images
add_theme_support( 'post-thumbnails' );

//make a custom image size for the home page banner
//regenerate your thumbnails after adding image sizes
//				 name,      width, height, crop?
add_image_size( 'big-banner', 1045, 350, true );

//no close PHP