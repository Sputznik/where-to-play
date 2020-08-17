<?php
	_e('<ul class="list-unstyled articles-resources '.$atts['post_type'].'">');

	$query_atts = array( 'post_type' => $atts['post_type'], 'showposts' => $atts['showposts'], );

	/* TAXONOMY QUERY - CUSTOM TYPES AND TERMS */
	if( isset( $atts['filter_by'] ) ){
		$atts['filter_by'] = explode( ':',  $atts['filter_by'] );
		if( is_array( $atts['filter_by'] ) && ( count( $atts['filter_by'] ) > 1 ) ){
			$query_atts['tax_query'] = array(
				array(
					'taxonomy' => $atts['filter_by'][0],
					'field'    => 'slug',
					'terms'    => $atts['filter_by'][1],
				)
			);
		}
	}
	/* TAXONOMY QUERY - CUSTOM TYPES AND TERMS */

	$the_query = new WP_Query( $query_atts );

	if( $the_query->have_posts() ):

		/* CONVERT THE COMMA SEPERATED LIST INTO ARRAY */
		$filters = explode(',', $atts['filters'] );

		while( $the_query->have_posts() ) : $the_query->the_post();

			$data_str = "data-item='1'";

			if( count( $filters ) ){
				$terms = $this->get_the_terms( $filters, get_the_ID() );

				foreach( $terms as $slug => $ids ){
					$data_str .= " data-".$slug."='".implode( ' ', $ids )."'";			/* ACCUMULATING DATA STRING FROM TERMS */
				}
			}

			$post_class	= '';
			$post_class = apply_filters( 'custom_posts_'.$atts['post_type'].'_class', $post_class );

			_e( '<li class="orbit-article post" id="post-'.get_the_ID().'" '.$data_str.'>' );

			// INCLUDE POST ITEM TEMPLATE
			get_template_part( "partials/post", "common" );

			_e('</li>');

		endwhile;
	endif;
	wp_reset_query();
	_e('</ul>');
