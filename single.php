<?php
  get_header();
  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];
?>
  <div class="container-fluid wtp-blog-post">
    <?php if( have_posts() ): while ( have_posts() ): the_post();?>
      <div class="post-header">
        <div class="breadcrumb">
          The blog / <?php the_title();?>
        </div>
        <?php echo do_shortcode('[wtp_social_share]');?>
      </div>
      <div class="post-body">
        <h6 class="title"><?php the_title();?></h6>
        <div class='post-meta'><?php the_author(); echo ', '.get_the_date('M j, Y');?></div>
        <img class="post-img" src="<?php _e( $image_url );?>" alt="Featured Image">
        <div class="sub-title"></div>
        <div class="post-content"><?php the_content();?> </div>
        <?php echo do_shortcode('[blog_terms]');?>
      </div>
    <?php endwhile;endif;?>
  </div>
  <?php echo do_shortcode('[wtp_social_share style="sticky"]');?>

<?php get_footer();?>
