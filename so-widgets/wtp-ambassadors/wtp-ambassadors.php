<?php
/*
	Widget Name: WTP Ambassadors
	Description: User popup modal.
	Author: Stephen Anil, Sputznik
	Author URI:	https://sputznik.com
	Widget URI:
	Video URI:
*/
class WTP_Ambassadors extends SiteOrigin_Widget {

	function __construct() {
		//Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.
		//Call the parent constructor with the required arguments.
		parent::__construct(
			// The unique id for your widget.
			'wtp-ambassadors',
			// The name of the widget for display purposes.
			__('WTP Ambassadors', 'siteorigin-widgets'),
			// The $widget_options array, which is passed through to WP_Widget.
			// It has a couple of extras like the optional help URL, which should link to your sites help or support page.
			array(
				'description' => __('User popup modal.'),
				'help'        => '',
			),
			//The $control_options array, which is passed through to WP_Widget
			array(),
			//The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
			array(
				'wtp_ambassadors' => array(
					'type' 	=> 'repeater',
					'label' => __( 'Panels' , 'siteorigin-widgets' ),
					'item_label' => array(
						'selector' => "[id*='user_name']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'user_image' => array(
							'type' 		=> 'media',
							'label' 	=> __( 'Profile Picture', 'siteorigin-widgets' ),
							'choose' 	=> __( 'Choose image', 'siteorigin-widgets' ),
							'update' 	=> __( 'Set image', 'siteorigin-widgets' ),
							'library' 	=> 'image',
							'fallback' 	=> false
						),
						'key_projects' => array(
							'type' 	=> 'repeater',
							'label' => __( 'Key Projects' , 'siteorigin-widgets' ),
							'item_label' => array(
								'selector' => "[id*='user_project']",
								'update_event' => 'change',
								'value_method' => 'val'
							),
							'fields' => array(
								'user_project' => array(
									'type' 			=> 'text',
									'label' 		=> __( 'Project', 'siteorigin-widgets' ),
									'default' 	=> '',
								),
							)
						), // key projects repeater
						'user_name' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Name', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
						'user_location' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Location', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
						'user_website' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Website', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
						'user_mail' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Mail', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
						'li_profile' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Linkedin Profile URL', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
						'tw_profile' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Twitter Profile URL', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
						'user_year' => array(
							'type' 			=> 'text',
							'label' 		=> __( 'Year', 'siteorigin-widgets' ),
							'default' 	=> '',
						),
						'user_bio' => array(
			        'type' => 'tinymce',
			        'label' => __( 'About', 'siteorigin-widgets' ),
			        'default' => '',
			        'rows' => 10,
			        'default_editor' => 'tinymce'
				    ),

					)
				), // ambassadors repeater

			),
			//The $base_folder path string.
			get_template_directory()."/so-widgets/wtp-ambassadors"
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
siteorigin_widget_register('wtp-ambassadors', __FILE__, 'WTP_Ambassadors');
