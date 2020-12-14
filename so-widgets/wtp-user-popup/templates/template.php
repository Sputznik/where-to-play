<?php $img_path = get_stylesheet_directory_uri().'/assets/images'; ?>

<!-- USER POPUP -->
<div class="articles-users">
  <?php
  foreach( $instance['wtp_users'] as $item ): $image = wp_get_attachment_url( $item['user_image'] );

    $social_links = array(
      'web'   => !empty( $item['user_website'] ) ? $item['user_website'] : '',
      'mail'  => !empty( $item['user_mail'] )    ? $item['user_mail'] : '',
      'li'    => !empty( $item['li_profile'] )   ? $item['li_profile'] : '',
      'tw'    => !empty( $item['tw_profile'] )   ? $item['tw_profile'] : ''
    ); ?>
    <div class="wtp-user-card">
      <a data-target="#wtp-user-modal" data-behaviour="wtp-user-popup" data-social='<?php _e( json_encode( $social_links ) );?>'>
        <div class="wtp-user-body">
          <div class="user-thumbnail-bg" style="background-image: url( '<?php _e( $image );?> ');"></div>
          <div class="user-meta">
            <h5 class="name"><?php _e( $item['user_name'] );?></h5>
            <span class="role"><?php _e( $item['user_role'] );?></span>
            <span class="location"><?php _e( $item['user_location'] );?></span>
          </div>
          <div class="bio" style="display:none;height:0;">
            <?php //echo siteorigin_panels_render( 'user-bio-'.$i, true, $item['user_bio'] );?>
            <?php echo $item['user_bio'];?>
          </div>
        </div>
      </a>
    </div>
  <?php endforeach;?>
</div>


<style media="screen">

/* social images */
#wtp-user-modal .social-media .mail{ background-image: url(<?php _e($img_path.'/email.png');?>); }
#wtp-user-modal .social-media .linkedin{ background-image: url(<?php _e($img_path.'/linkedin.png');?>); }
#wtp-user-modal .social-media .twitter{ background-image: url(<?php _e($img_path.'/twitter.png');?>); }

</style>
