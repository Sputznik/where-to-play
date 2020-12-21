<?php get_header();
  $term = $wp_query->get_queried_object();;
?>
  <div class="container-fluid post-archive">
    <div class="row">
      <div class="col-sm-8">
        <h1 class="archive-title">
            Tagged Under: <?php echo $term->name; ?>
        </h1>
        <?php if( have_posts() ): ?>
          <ul class="list-unstyled articles-blog">
            <?php while( have_posts() ) : the_post(); ?>
            <li class="orbit-article">
              <?php get_template_part( "partials/blog", "post" );?>
            </li>
            <?php endwhile;?>
          </ul>
        <?php endif;?>
        <?php global $wp_query; if ( $wp_query->max_num_pages > 1 ): ?>
          <div class="search-pagination">
            <div class=" text-center">
              <?php
                the_posts_pagination(
                  array(
                    'mid_size' 	=> 1,
                    'prev_text' => __( '&laquo;' ),
                    'next_text' => __( '&raquo;' ),
                    'screen_reader_text' => __( ' ' ),
                  )
                );
              ?>
            </div>
          </div>
        <?php endif;?>
      </div>
      <div class="col-sm-4">
        <?php if( is_active_sidebar( 'wtp-archive-sidebar' ) ){ dynamic_sidebar( 'wtp-archive-sidebar' ); }?>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?php if( is_active_sidebar( 'single-post-footer' ) ){ dynamic_sidebar( 'single-post-footer' ); }?>
  </div>
<?php get_footer();?>
