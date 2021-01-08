<?php
/*
	Widget Name: WTP Categories
	Description: Custom categories widget.
	Author: Stephen Anil, Sputznik
	Author URI:	http://sputznik.com
	Widget URI:
	Video URI:
*/
class WTP_Custom_Categories extends SiteOrigin_Widget {

	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'wtp-categories',
			// The name of the widget for display purposes.
			__('WTP Categories', 'siteorigin-widgets'),
			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Custom categories widget.'),
				'help'        => '',
			),
			//The $control_options array, which is passed through to WP_Widget
			array(),
			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'title' => array(
					'type' 			=> 'text',
					'label' 		=> __( 'Title', 'siteorigin-widgets' ),
					'default' 	=> '',
				),
				'blog_url' => array(
					'type' 			=> 'text',
					'label' 		=> __( 'Blog Page Url', 'siteorigin-widgets' ),
					'default' 	=> '',
				),

			),
			//The $base_folder path string.
			get_template_directory()."/so-widgets/wtp-categories"
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
siteorigin_widget_register('wtp-categories', __FILE__, 'WTP_Custom_Categories');
