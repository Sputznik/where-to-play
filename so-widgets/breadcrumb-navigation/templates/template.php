<?php
  $design = $instance['design_section'];
  $bg_color = !empty( $design['bg_color'] ) ? $design['bg_color'] : '#1f2939';
  $item_color = !empty( $design['item_color'] ) ? $design['item_color'] : '#ced1d7';
?>
<!-- BREADCRUMB NAVIGATION -->
<div class="breadcrumb-wrapper">
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
<style media="screen">
  .breadcrumb-wrapper ul.breadcrumb{ background-color: <?php _e( $bg_color );?>; }
  .breadcrumb-wrapper ul.breadcrumb li a,
  .breadcrumb-wrapper ul.breadcrumb li+li:before{
    color: <?php _e( $item_color );?>;
  }
</style>
