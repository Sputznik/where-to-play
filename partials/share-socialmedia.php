<?php
  global $post;

  add_shortcode('wtp_social_share', function( $atts ){

    $atts = shortcode_atts( array(
      'style' 	=> '',
    ), $atts, 'wtp_social_share' );

    $class = '';
    $permalink = get_the_permalink();
    $icon_path = get_stylesheet_directory_uri().'/assets/images';

    $icons = array(
      'li'  => array(
        'icon'  => $icon_path.'/li-share.png',
        'url'   =>  "http://www.linkedin.com/shareArticle?mini=true&url=$permalink&title=".rawurlencode( get_the_title() )
      ),
      'tw'  => array(
        'icon'  => $icon_path.'/tw-share.png',
        'url'   => "https://twitter.com/intent/tweet?text=".$post->post_excerpt."&url=$permalink&via="
      ),
      'fb'  => array(
        'icon'  => $icon_path.'/fb-share.png',
        'url'   => "https://www.facebook.com/sharer.php?u=$permalink"
      )
    );

    if( $atts['style'] == 'sticky' ){
      $class = 'sticky-buttons';
      $icons['li']['icon'] = 'fa fa-linkedin fa-2x';
      $icons['tw']['icon'] = 'fa fa-twitter fa-2x';
      $icons['fb']['icon'] = 'fa fa-facebook fa-2x';
    }

    ob_start();
    ?>
    <div class="article-share <?php _e( $class );?>">
      <ul class="list-unstyled social-share" >
      <?php foreach( $icons as $key => $icon ): $class = $key." social-fa-icon"; ?>
        <li>
          <a class='<?php _e( $class ); ?>' target='_blank' href='<?php _e( $icon['url'] );?>'>
            <?php if( $atts['style'] == 'sticky' ):?>
              <i class='<?php _e( $icon['icon'] );?>'></i>
            <?php else:?>
              <img src='<?php _e( $icon['icon'] );?>'/>
            <?php endif;?>
          </a>
        </li>
      <?php endforeach;?>
      </ul>
    </div>

    <?php
      $social_share_template = ob_get_clean();
      return $social_share_template;

  });

?>
