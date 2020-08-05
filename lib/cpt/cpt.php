<?php

// CREATES CUSTOM POST TYPE
add_filter( 'orbit_post_type_vars', function( $orbit_types ){

	$orbit_types['resources'] = array(
		'slug' 		=> 'resources',
		'labels'	=> array(
			'name' 					=> 'Resources',
			'singular_name' => 'Resource',
		),
		// 'menu_icon'	=> 'dashicons-video-alt3',
		'public'		=> true,
		'supports'	=> array( 'title', 'editor','thumbnail','excerpt' )
	);

	return $orbit_types;
} );

//CREATES META FIELDS
add_filter( 'orbit_meta_box_vars', function( $meta_box ){

	$meta_box['resources'] = array(
		array(
			'id'			=> 'resources-meta-field',
			'title'		=> 'Additional Information',
			'fields'	=> array(
				'btn_text'	=> array(
					'type' => 'text',
					'text' => 'Button Text'
				),
				'btn_url'	=> array(
					'type' => 'text',
					'text' => 'Redirect URL'
				)
			)
		)
	);

	return $meta_box;
});
