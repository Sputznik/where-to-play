<?php

/*ENQUEUE STYLES*/
add_action('wp_enqueue_scripts',function(){

	wp_enqueue_style('rubik-google-fonts', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap', array('sp-core-style'), '1.0.4' );

  wp_enqueue_style('sp-child-css', get_stylesheet_directory_uri().'/assets/css/where-to-play.css', array('sp-core-style'), '1.0.18' );

},99);

//Include Files
include('lib/custom-header/header-functions.php');
include('lib/cpt/cpt.php');
include('lib/filters/filters.php');

/* ADD SOW FROM THE THEME */
add_action('siteorigin_widgets_widget_folders', function( $folders ){
  $folders[] = get_stylesheet_directory() . '/so-widgets/';
  return $folders;
});


//Add google fonts
add_filter( 'sp_list_google_fonts', function( $fonts ){

  $fonts[] = array(
      'slug'	=> 'rubik',
      'name'	=> 'Rubik',
      'url'	  => 'Rubik'
    );
  return $fonts;
});

add_shortcode( 'wtp_web_btns', function(){
	ob_start();
	?>
	<ul class='list-inline list-web-btns'>
		<li><a href="#" class="btn-blue-outline">TRY OUR WEB APP</a></li>
		<li class='or-text'><span>or</span></li>
		<li><a href="https://staging1.wheretoplay.co/worksheets-2/" class="anchor-blue">DOWNLOAD WORKSHEETS</a></li>
		<li class='free-text'><span>Its Free!</span></li>
	</ul>
	<?php
	return ob_get_clean();
} );

//Excerpt
function excerpt( $limit ) {

	global $post;

	$excerpt = $post->post_excerpt;

	if( !$excerpt && !strlen( $excerpt ) ){

    $excerpt = $post->post_content;
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = excerpt_remove_blocks( $excerpt );
		$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );

	}

	$excerpt = wp_trim_words( $excerpt, $limit, '...' );

	return $excerpt;
}
