<?php

  $instance = array(
    'post_type' => 'resource',
    'showposts' => 100,
    'label_all' => 'All',
    'primary_filter' => 'resource_types',
    'secondary_filter' => 'roles',
    'cache' => 0
  );


	$resources_double_filters = new PLAY_FILTERS_SHORTCODE_NESTED_FILTERS ;

	echo do_shortcode( $resources_double_filters->form_shortcode( $instance ) );

?>
