<?php

/*ENQUEUE STYLES*/
add_action('wp_enqueue_scripts',function(){

	wp_enqueue_style('rubik-google-fonts', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap', array('sp-core-style'), '1.0.4' );

	wp_enqueue_style('inter-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap', array('sp-core-style'), '1.0.4' );

  wp_enqueue_style('sp-child-css', get_stylesheet_directory_uri().'/assets/css/where-to-play.css', array('sp-core-style'), time() );

	wp_enqueue_script('wtp-accordion-js', get_stylesheet_directory_uri().'/assets/js/wtp-accordion.js', array('jquery'), '1.0.0' ); // SOW ACCORDION SCRIPT

	wp_enqueue_script('wtp-user-popup-js', get_stylesheet_directory_uri().'/assets/js/wtp-user-popup.js', array('jquery'), time() ); // SOW ACCORDION SCRIPT

},99);

//Include Files
include('lib/custom-header/header-functions.php');
include('lib/cpt/cpt.php');
include('lib/filters/filters.php');
include('partials/share-socialmedia.php');

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
		<li><a href="https://app.wheretoplay.co/" class="btn-blue-outline" target="_blank">TRY OUR WEB APP</a></li>
		<li class='or-text'><span>or</span></li>
		<li><a href="https://wheretoplay.co/worksheets/" class="anchor-blue" target="_blank">DOWNLOAD WORKSHEETS</a></li>
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

function getUniqueID( $data ){
	return substr( md5( json_encode( $data ) ), 0, 8 );
}

/* CREATE ATTS ARRAY FROM DEFAULT AND USER PARAMETERS IN THE SHORTCODE */
add_shortcode( 'blog_terms', function( $atts ){

	$atts = shortcode_atts( array(
    'taxonomy' 	=> 'category',
  ), $atts, 'blog_terms' );

  global $post;

  $term_list = wp_get_post_terms( $post->ID, $atts['taxonomy'] );

  $final_terms = array();

  // ITERATING THE LIST OF TERMS
  foreach( $term_list as $term ){
		$final_terms[$term->term_id] = $term->name;
	}

  $html  = "<ul class='list-unstyled post-terms'>";
	$html .= "<li class='term'>".implode("</li><li class='term'>", $final_terms )."</li>";
	$html .= "</ul>";

  return $html;

});

//Sidebar Widget
add_action( 'widgets_init', function(){
  // Sidebar widget for archive
  register_sidebar( array(
    'name' 			    => 'Sidebar for Archive',
    'id' 			      => 'wtp-archive-sidebar',
    'description' 	=> 'Sidebar appears in the archive page',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' 	=> '</aside>',
    'before_title' 	=> '<h3 class="widget-title">',
    'after_title' 	=> '</h3>',
  ) );

});
