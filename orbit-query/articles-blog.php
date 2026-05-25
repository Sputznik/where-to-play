<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.orbit-article');?>" data-url="<?php _e( $atts['url'] );?>" class="list-unstyled articles-blog">
  <?php while( $this->query->have_posts() ) : $this->query->the_post();?>
    <li class="orbit-article">
      <?php get_template_part( "partials/blog", "post" );?>
    </li>
  <?php endwhile;?>
</ul>
