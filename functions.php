<?php

/*ENQUEUE STYLES*/
add_action('wp_enqueue_scripts',function(){

	wp_enqueue_style('rubik-google-fonts', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap', array('sp-core-style'), '1.0.4' );

  wp_enqueue_style('sp-child-css', get_stylesheet_directory_uri().'/assets/css/where-to-play.css', array('sp-core-style'), '1.0.12' );
},99);

//Include Files
include('lib/custom-header/header-functions.php');
include('lib/cpt/cpt.php');

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
		<li><a href="#" class="anchor-blue">DOWNLOAD WORKSHEETS</a></li>
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

/* CREATE ATTS ARRAY FROM DEFAULT AND USER PARAMETERS IN THE SHORTCODE */
add_shortcode( 'filter_terms', function( $atts ){
  $atts = shortcode_atts( array(
    'taxonomy' 	=> '',
  ), $atts, 'filter_terms' );

  global $post;

	$term_list = get_terms( array(
    'taxonomy' => $atts['taxonomy'],
    'hide_empty' => false,
	));


  $final_terms = array();

  $parent_terms = array();

  // ITERATING THE LIST TO FIND ONLY PARENT TERMS
  foreach( $term_list as $term ){
    if( $term->parent == 0 ){
			  $final_terms[$term->term_id] = "<a href='#' class='btn btn-sm' data-term='".$term->slug."'>" . $term->name . "</a>";
    }
  }

  foreach( $final_terms as $final_term ){
    array_push( $parent_terms, $final_term );
  }

	$data_term = 'all-roles';
	if( $atts['taxonomy'] === 'resource_types' ){$data_term = 'all-resource-types';}

  $html = "<ul class='filter-btn-wrapper list-unstyled'>";
	$html .= "<li class='active-filter'><a class='btn btn-sm' data-term='".$data_term."'>All</a></li>";
	$html .= "<li>".implode("</li><li>", $parent_terms )."</li>";
  $html .= "</ul>";

  return $html;

});
