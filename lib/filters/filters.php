<?php

	$inc_files = array(
		'class-play-filters-shortcode.php',
		'class-play-filters-shortcode-nested-filters.php',
		'class-play-filters-shortcode-custom-posts.php'
	);

	foreach( $inc_files as $inc_file ){
		include( $inc_file );
	}


	class PLAY_FILTERS_TEMPLATE{

		function __construct(){
			add_action('wp_enqueue_scripts', array( $this, 'assets' ) );
		}

		function assets(){
			wp_enqueue_script('filters-script', get_stylesheet_directory_uri().'/assets/js/filters.js', array('jquery'), '1.0.5', true );
		}

	}

	global $play_filters_template;
	$play_filters_template = new PLAY_FILTERS_TEMPLATE;
