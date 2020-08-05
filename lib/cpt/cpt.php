<?php

// CREATES CUSTOM POST TYPE
add_filter( 'orbit_post_type_vars', function( $orbit_types ){

	$orbit_types['resources'] = array(
		'slug' 		=> 'resources',
		'labels'	=> array(
			'name' 					=> 'Resources',
			'singular_name' => 'Resource',
		),
		'menu_icon'	=> 'dashicons-format-aside',
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
      'post_types'	=> array( 'resources' )
    );
  }

  return $orbit_tax;

} );
