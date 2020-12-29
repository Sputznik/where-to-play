<?php
/*
	Widget Name: WTP Read More
	Description: Show/hide additional content by wrapping content in an expander.
	Author: Stephen Anil, Sputznik
	Author URI:	https://sputznik.com
	Widget URI:
	Video URI:
*/
class WTP_Read_More extends SiteOrigin_Widget {

	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'wtp-read-more',
			// The name of the widget for display purposes.
			__('WTP Read More', 'siteorigin-widgets'),
			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Show/hide additional content by wrapping content in an expander.'),
				'help'        => '',
			),
			//The $control_options array, which is passed through to WP_Widget
			array(),
			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'image' => array(
					'type' 		=> 'media',
					'label' 	=> __( 'Image', 'siteorigin-widgets' ),
					'choose' 	=> __( 'Choose image', 'siteorigin-widgets' ),
					'update' 	=> __( 'Set image', 'siteorigin-widgets' ),
					'library' 	=> 'image',
					'fallback' 	=> false
				),
				'caption' => array(
					'type' 			=> 'text',
					'label' 		=> __( 'Image Caption', 'siteorigin-widgets' ),
					'default' 	=> '',
				),
				'content' => array(
					'type' => 'tinymce',
					'label' => __( 'Content', 'siteorigin-widgets' ),
					'default' => '',
					'rows' => 10,
					'default_editor' => 'tinymce'
				),
				'section' => array(
					'type' 	=> 'builder',
					'label' => __( 'Section', 'siteorigin-widgets'),
				),

			),
			//The $base_folder path string.
			get_template_directory()."/so-widgets/wtp-read-more"
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
siteorigin_widget_register('wtp-read-more', __FILE__, 'WTP_Read_More');
