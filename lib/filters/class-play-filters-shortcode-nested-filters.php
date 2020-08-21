<?php

	class PLAY_FILTERS_SHORTCODE_NESTED_FILTERS extends PLAY_FILTERS_SHORTCODE{

		function __construct(){

			$this->shortcode = 'nested_filters';
			$this->template = 'nested_filters.php';

			parent::__construct();

		}

		function unique_atts(){
			return array('post_type', 'showposts', 'primary_filter', 'secondary_filter');
		}

		function get_default_atts(){
			return array(
				'post_type'					=> '',
				'primary_filter' 		=> '',
				'secondary_filter'	=> '',
				'label_all'					=> 'All',
				'showposts'					=> 100,
				'cache'							=> '0'
			);
		}

		/* GET TERMS FOR PRIMARY AND SECONDARY FILTERS */
		function get_terms( $taxonomy ){

			$terms = array();
			$updated_terms = array();

			// TERMS CUSTOM ORDER
			$roles_order = ['entrepreneurs', 'business-managers','educators', 'consultants' ];

			$resource_types_order = ['worksheets', 'book', 'case-studies', 'online-training', 'teaching-materials', 'research', 'blog'];

			if( $taxonomy ){

				$terms = get_terms( array(
			    'taxonomy' => $taxonomy,
			    'hide_empty' => false,
				));

				$order = $taxonomy === 'roles' ? $roles_order : $resource_types_order;

				$updated_terms = $this->change_terms_order( $order, $terms );
			}

			return $updated_terms;

		}

		// CHANGES THE DEFAULT ORDER OF TERMS
		function change_terms_order( $order, $terms ){

			$updated_terms = $terms;

			usort( $updated_terms, function ( $a, $b ) use ( $order ) {
		    $pos_a = array_search( $a->slug, $order );
		    $pos_b = array_search( $b->slug, $order );
				return $pos_a - $pos_b;
			});

			return $updated_terms;

		}



		function print_terms_list( $taxonomy, $list_class, $filter_type, $global_text = '' ){

			$terms = $this->get_terms( $taxonomy );

			if( count( $terms ) ):
				echo "<ul class='". $list_class ."-list filter-btn-wrapper list-unstyled'>";

				if( $global_text ):

				?>
				<li class="universal-filter">
					<a href="#" class="btn btn-sm"  data-filter='universal'><?php _e( $global_text );?></a>
				</li>
				<?php endif;

				/* ITERATING THROUGH THE LIST OF TERMS AND PRINTING THEM AS THE PART OF THE LIST */
				foreach( $terms as $term ):?>
				<li class="<?php _e( $list_class );?>">
					<a href="#" class="btn btn-sm" data-filter='<?php _e( $filter_type );?>' data-tax='<?php _e( $term->taxonomy );?>' data-id='<?php _e( $term->term_id );?>'><?php _e( $term->name );?></a>
				</li>
				<?php endforeach;

				echo "</ul>";
			endif;
		}

	}
