<?php
  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];
?>
<a href="<?php the_permalink();?>" class="blog-post-btn">
  <div class="post-body">
    <div class="post-img" style="background-image: url(<?php _e( $image_url );?>);"></div>
    <div class="post-content">
      <h2 class="title"><?php the_title();?></h2>
      <div class='post-meta'><?php the_author(); echo ', '.get_the_date('M j, Y');?></div>
      <div class="desc"><?php echo excerpt( 40 ); ?></div>
      <?php echo do_shortcode('[blog_terms]');?>
    </div>
  </div>
</a>
