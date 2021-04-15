<?php

// CREATES CUSTOM POST TYPE
add_filter( 'orbit_post_type_vars', function( $orbit_types ){

	$orbit_types['resource'] = array(
		'slug' 		=> 'resource',
		'labels'	=> array(
			'name' 					=> 'Resources',
			'singular_name' => 'Resource',
		),
		'menu_icon'	=> 'dashicons-format-aside',
		'public'		=> true,
		'supports'	=> array( 'title', 'editor','thumbnail','excerpt' )
	);

	$orbit_types['wtp-banner'] = array(
		'slug' 		=> 'wtp-banner',
		'labels'	=> array(
			'name' 					=> 'Banners',
			'singular_name' => 'Banner',
			'edit_item'			=> 'Edit Banner',
			'add_new_item'  => 'Add New Banner',
			'all_items'     =>  'All Banners'
		),
		'menu_icon'	=> 'dashicons-text-page',
		'public'		=> true,
		'supports'	=> array( 'title', 'editor' )
	);

	return $orbit_types;
} );

//CREATES META FIELDS
add_filter( 'orbit_meta_box_vars', function( $meta_box ){

	$meta_box['resource'] = array(
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

/* PUSH INTO THE GLOBAL VARS OF ORBIT TAXNOMIES */
add_filter( 'orbit_taxonomy_vars', function( $orbit_tax ){

  $resources_taxonomies = array(
    'resource_types'    => 'Resource Types',
    'roles'       	 		=> 'Roles'
  );

  foreach( $resources_taxonomies as $slug => $label ){
    $orbit_tax[ $slug ]	= array(
      'label'			  => $label,
      'slug' 			  => $slug,
      'post_types'	=> array( 'resource' )
    );
  }

  return $orbit_tax;

} );
