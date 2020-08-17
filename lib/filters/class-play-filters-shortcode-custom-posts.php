<?php
	class PLAY_FILTERS_SHORTCODE_CUSTOM_POSTS extends PLAY_FILTERS_SHORTCODE{


		function __construct(){

			$this->shortcode 	= 'filter_custom_posts';
			$this->template 	= 'custom_posts.php';

			parent::__construct();

		}

		function unique_atts(){
			return array('post_type', 'showposts');
		}

		function get_default_atts(){
			return array(
				'post_type'			=> 'new_staffs',
				'filters' 			=> '',
				'showposts'			=> 100,
				'filter_by'			=> ''
				//'cache'				=> '4'
			);
		}

		/* GET POST TERMS FROM SELECTED TAXONOMIES */
		function get_the_terms( $filters, $post_id ){

			$terms = array();
			foreach( $filters as $tax ){
				if( $tax ){
					$post_terms = get_the_terms( $post_id, $tax );
					if( is_array( $post_terms ) ){
						foreach( $post_terms as $post_term ){

							if( !isset( $terms[ $tax ] ) ){
								$terms[ $tax ] = array();
							}
							array_push( $terms[ $tax ], $post_term->term_id );

						}
					}
				}
			}

			return $terms;
		}


	}

	new PLAY_FILTERS_SHORTCODE_CUSTOM_POSTS;
