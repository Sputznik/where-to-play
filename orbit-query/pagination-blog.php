<?php if($atts['pagination'] != '0'):

  $paged = ( get_query_var('orbit-paged')) ? get_query_var('orbit-paged') : 1;

  if( $this->query->max_num_pages > 1 ){
    $current_page = max( 1, $paged );
    $big = 9999999;
    echo paginate_links( array(
      'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format'     => '?orbit-paged=%#%',
      'type'       => 'list',
      'mid_size'   => 1,
      'current'    => $current_page,
      'total'      => $this->query->max_num_pages,
      'prev_text'  => __('&laquo;', 'textdomain'),
      'next_text'  => __('&raquo;', 'textdomain'),
    ) );
  }

  endif;

?>
