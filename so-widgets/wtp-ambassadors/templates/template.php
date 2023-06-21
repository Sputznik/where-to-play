<!-- AMBASSADOR MODAL -->
<div class="wtp-ambassadors">
  <?php
  foreach( $instance['wtp_ambassadors'] as $item ):

    $bio = $item['user_bio'];
    $bio_excerpt = !empty( $bio ) ? substr($bio, 0, 130).'...' : '';
    $image = wp_get_attachment_url( $item['user_image'] );
    $social_links = array(
      'web'   => !empty( $item['user_website'] ) ? $item['user_website'] : '',
      'mail'  => !empty( $item['user_mail'] )    ? $item['user_mail'] : '',
      'li'    => !empty( $item['li_profile'] )   ? $item['li_profile'] : '',
      'tw'    => !empty( $item['tw_profile'] )   ? $item['tw_profile'] : ''
    ); ?>
    <div class="wtp-ambassador-card" data-behaviour="wtp-ambassador-popup" data-social='<?php _e( json_encode( $social_links ) );?>'>
      <div class="card-col-left">
        <div class="user-thumbnail-bg" style="background-image: url( '<?php _e( $image );?> ');"></div>
      </div>
      <div class="card-col-right">
        <div class="user-meta">
          <span class="name"><?php _e( $item['user_name'] );?></span>
          <span class="location"><?php _e( $item['user_location'] );?></span>
          <ul class="social-media list-unstyled">
            <?php if($item['user_mail']):?>
              <li><a href="mailto:<?php _e( $item['user_mail'] );?>" target="_blank"><span class="mail"></span></a></li>
            <?php endif?>
            <?php if($item['li_profile']):?>
              <li><a href="<?php _e( $item['li_profile'] );?>" target="_blank"><span class="linkedin"></span></a></li>
            <?php endif?>
            <?php if($item['tw_profile']):?>
              <li><a href="<?php _e( $item['tw_profile'] );?>" target="_blank"><span class="twitter"></span></a></li>
            <?php endif?>
          </ul>
          <span class="year-flag">
            <svg xmlns="http://www.w3.org/2000/svg" width="171" height="23" viewBox="0 0 171 23" fill="none" aria-hidden="true">
              <path d="M0 0H170.5L162 11.5L170.5 23H0V0Z" fill="#E6F7FD"/>
            </svg>
            <span class="year-flag-text">AMBASSADOR <?php if($item['user_year']):?><strong><?php _e( $item['user_year'] );?></strong><?php endif;?></span>
          </span>
        </div>
        <div class="bio" style="display:none;height:0;"><?php echo $item['user_bio'];?></div>
        <div class="bio-excerpt">
          <span class="card-section-title">ABOUT</span>
          <?php echo $bio_excerpt;?>
          <div class="read-more">Read more</div>
        </div>
        <div class="key-projects" data-total-projects="<?php _e( count($item['key_projects']) );?>">
          <span>KEY PROJECTS</span>
          <ul>
            <?php foreach( $item['key_projects'] as $project ):?>
              <li><?php _e( $project['user_project'] );?></li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
    </div>
  <?php endforeach;?>
</div>
