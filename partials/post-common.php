<?php

  $title = get_the_title();
  $title_length = strlen( $title );
  $excerpt_length = 0;
  if( $title_length < 120 ){
    $excerpt_length = 120 - $title_length;

    if( $excerpt_length < 15 ){
      $excerpt_length = 15;
    }
    if( $excerpt_length > 30 ){
      $excerpt_length = 30;
    }
  }
?>
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
    <div class="desc">
      <?php echo excerpt( $excerpt_length ); ?>
    </div>
  </div>
  <a class="btn btn-redirect" href="<?php _e( $redirect_url );?>" target="_blank">
    <?php _e( $redirect_text );?>
  </a>
</div>
