<?php
  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];
?>
<div class="post-body">

  <div class="post-img" style="background-image: url(<?php _e( $image_url );?>);"><a href="<?php the_permalink();?>"></a></div>

  <div class="post-content">
    <h2 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <div class='post-meta'>
      <?php the_author(); echo ', '.get_the_date('M j, Y');?>
    </div>
    <?php echo do_shortcode('[blog_terms]');?>
    <div class="desc"><?php echo excerpt( 40 ); ?></div>
  </div>
</div>
