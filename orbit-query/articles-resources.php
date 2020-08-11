
<!-- FILTERS TEMPLATE -->
<?php get_template_part( "partials/post", "filters" );?>
<!-- FILTERS TEMPLATE -->

<ul id="<?php _e( $atts['id'] );?>" data-target="<?php _e('li.orbit-article');?>" data-url="<?php _e( $atts['url'] );?>" class="list-unstyled articles-resources">
  <?php while( $this->query->have_posts() ) : $this->query->the_post();?>
    <li class="orbit-article">
      <?php get_template_part( "partials/post", "common" );?>
    </li>
  <?php endwhile;?>
</ul>
