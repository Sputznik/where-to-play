<?php
/*
	Widget Name: Breadcrumb Navigation
	Description: Breadcrumb Navigation
	Author: Stephen Anil, Sputznik
	Author URI:	http://sputznik.com
	Widget URI:
	Video URI:
*/
class Breadcrumb_Navigation extends SiteOrigin_Widget {

	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'breadcrumb-navigation',
			// The name of the widget for display purposes.
			__('Breadcrumb Navigation', 'siteorigin-widgets'),
			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Breadcrumb Navigation'),
				'help'        => '',
			),
			//The $control_options array, which is passed through to WP_Widget
			array(),
			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'breadcrumb_items' => array(
					'type' 	=> 'repeater',
					'label' => __( 'Breadcrumb Items Repeater' , 'siteorigin-widgets' ),
					'item_label' => array(
						'selector' => "[id*='item_title']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'item_title' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Item Title', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
            'item_url' => array(
							'type' 			=> 'link',
							'label' 		=> __( 'Item URL', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
					)
				),
			),
			//The $base_folder path string.
			get_template_directory()."/so-widgets/breadcrumb-navigation"
		);
	}

	function get_template_name($instance) {
		return 'template';
	}
	function get_template_dir($instance) {
		return 'templates';
	}
  function get_style_name($instance) {
      return '';
  }
}
siteorigin_widget_register('breadcrumb-navigation', __FILE__, 'Breadcrumb_Navigation');
