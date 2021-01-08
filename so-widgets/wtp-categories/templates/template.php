<!-- GET ALL THE TERMS -->
<?php $categories = get_categories( array( 'orderby' => 'name','order'   => 'ASC' ) );?>

<!-- WTP CATEGORIES -->
<div class="wtp-categories">
  <h3 class="title"><?php _e( $instance['title'] );?></h3>
  <ul>
    <?php foreach( $categories as $category ): ?>
      <?php if( is_category() && ( $category->term_id === get_query_var('cat') ) && !empty( $instance['blog_url'] ) ): ?>
        <li class="cat-item current-cat">
         <a href="<?php echo get_category_link( $category->term_id );?>" data-blog="<?php _e( $instance['blog_url'] );?>"><?php echo $category->name;?></a>
        </li>
      <?php else:?>
        <li class="cat-item">
         <a href="<?php echo get_category_link( $category->term_id );?>"><?php echo $category->name;?></a>
        </li>
    <?php endif; endforeach;?>
  </ul>
</div>
