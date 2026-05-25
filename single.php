<?php
  get_header();
  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];
?>
  <div class="container-fluid wtp-blog-post">
    <?php if( have_posts() ): while ( have_posts() ): the_post();?>
      <div class="post-header">
        <div class="breadcrumb">
          <a href="<?php echo home_url( '/blog/' ); ?>">The Blog</a> / <?php the_title();?>
        </div>
        <?php echo do_shortcode('[wtp_social_share]');?>
      </div>
      <div class="post-body">
        <h6 class="title"><?php the_title();?></h6>
        <div class='post-meta'><?php the_author(); echo ', '.get_the_date('M j, Y');?></div>
        <?php echo do_shortcode('[blog_terms]');?>
        <img class="post-img" src="<?php _e( $image_url );?>" alt="Featured Image">
        <div class="sub-title"></div>
        <div class="post-content"><?php the_content();?> </div>
      </div>
    <?php endwhile;endif;?>
  </div>
  <div class="container-fluid">
    <?php
      $banner_name = get_post_meta( get_the_ID(), 'wtp_form', true );
      $args = array(
        'post_type' => 'wtp-banner',
        "posts_per_page" => 1,
        'post_name__in'  => array( $banner_name )
      );
      $query = new WP_Query($args);
      if( $query->have_posts() ){
        while ( $query->have_posts() ) : $query->the_post();
        the_content();
        endwhile;
      }
      else{
        if( is_active_sidebar( 'single-post-footer' ) ){
          dynamic_sidebar( 'single-post-footer' );
        }
      }
		 	wp_reset_postdata();
		?>
  </div>
  <?php echo do_shortcode('[wtp_social_share style="sticky"]');?>

<?php get_footer();?>
