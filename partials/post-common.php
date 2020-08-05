<?php
  global $post;
  $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );
  $redirect_text = get_post_meta( get_the_ID(), 'btn_text', true );
  $redirect_url = get_post_meta( get_the_ID(), 'btn_url', true );
?>
<div class="resource-wrapper">
  <div class="orbit-thumbnail-bg" style="background-image: url( '<?php _e( $thumbnail[0] );?> ');"></div>
  <div class="resource-meta">
    <h5 class="title"><?php the_title();?></h5>
    <div class="desc"><?php _e( do_shortcode( '[orbit_excerpt]' ) );?></div>
  </div>
  <a class="btn btn-redirect" href="<?php _e( $redirect_text );?>" target="_blank">
    <?php _e( $redirect_text );?>
  </a>
</div>
