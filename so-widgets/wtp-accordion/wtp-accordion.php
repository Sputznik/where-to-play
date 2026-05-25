<?php
/*
	Widget Name: WTP Accordion
	Description: Custom accordion to squeeze a lot of content into a small space.
	Author: Stephen Anil, Sputznik
	Author URI:	http://sputznik.com
	Widget URI:
	Video URI:
*/
class WTP_Custom_Accordion extends SiteOrigin_Widget {

	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'wtp-accordion',
			// The name of the widget for display purposes.
			__('WTP Accordion', 'siteorigin-widgets'),
			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('Custom accordion to squeeze a lot of content into a small space.'),
				'help'        => '',
			),
			//The $control_options array, which is passed through to WP_Widget
			array(),
			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'wtp_accordion_items' => array(
					'type' 	=> 'repeater',
					'label' => __( 'Panels' , 'siteorigin-widgets' ),
					'item_label' => array(
						'selector' => "[id*='accordion_title']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'accordion_image' => array(
							'type' 		=> 'media',
							'label' 	=> __( 'Image', 'siteorigin-widgets' ),
							'choose' 	=> __( 'Choose image', 'siteorigin-widgets' ),
							'update' 	=> __( 'Set image', 'siteorigin-widgets' ),
							'library' 	=> 'image',
							'fallback' 	=> false
						),
						'accordion_title' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Title', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
            'accordion_content' => array(
							'type' 			=> 'textarea',
							'label' 		=> __( 'Content', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
						'accordion_section' => array(
							'type' 	=> 'builder',
							'label' => __( 'Accordion Section', 'siteorigin-widgets'),
						),
					)
				),

			),
			//The $base_folder path string.
			get_template_directory()."/so-widgets/wtp-accordion"
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
siteorigin_widget_register('wtp-accordion', __FILE__, 'WTP_Custom_Accordion');
