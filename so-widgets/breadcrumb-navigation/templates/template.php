<!-- BREADCRUMB NAVIGATION -->
<div class="container-fluid breadcrumb-wrapper">
  <ul class="breadcrumb">
    <?php foreach( $instance['breadcrumb_items'] as $item ):?>
      <li>
        <a href="<?php _e( $item['item_url'] );?>">
          <?php _e( $item['item_title'] );?>
        </a>
      </li>
    <?php endforeach;?>
  </ul>
</div>
<!-- BREADCRUMB NAVIGATION -->
