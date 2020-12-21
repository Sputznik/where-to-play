<?php get_header();
  $term = $wp_query->get_queried_object();;
?>
  <div class="container-fluid" style="padding-top: 35px; padding-bottom: 35px;">
    <div class="row">
      <div class="col-sm-8">
        <h1 class="archive-title" style="text-transform: capitalize;margin-bottom: 30px;color: #1f2939;">
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
      </div>
      <div class="col-sm-4">
        <?php if( is_active_sidebar( 'wtp-archive-sidebar' ) ){ dynamic_sidebar( 'wtp-archive-sidebar' ); }?>
      </div>
    </div>
  </div>
<?php get_footer();?>
