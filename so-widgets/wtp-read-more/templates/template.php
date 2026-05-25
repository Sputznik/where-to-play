<!-- READ MORE -->
<div class="read-more-less">
  <div class="column">
    <div class="content">
      <?php _e( $instance['content'] );?>
      <a class="read more-btn" href="#">Read more &gt;</a>
    </div>
    <div class="image-container">
      <img src="<?php _e( wp_get_attachment_url( $instance['image'] ) );?>" alt="<?php _e( $instance['caption'] );?>" title="<?php _e( $instance['caption'] );?>">
      <div class="caption">
        <?php _e( $instance['caption'] );?>
      </div>
    </div>
  </div>
  <div class="section">
    <?php echo siteorigin_panels_render( 'section', true, $instance['section'] );?>
  </div>
  <a class="read less-btn" href="#">Read less &gt;</a>
</div>
