<?php
  // UNIQUE ID FOR THE ACCORDION
  $accordion_id = getUniqueID( $instance );
?>

<!-- ACCORDION -->
<div class="accordion-wrapper">
  <div class="panel-group" id="accordion-<?php echo $accordion_id;?>" role="tablist" aria-multiselectable="true">
    <?php foreach( $instance['wtp_accordion_items'] as $i => $item ): $image = wp_get_attachment_url( $item['accordion_image'] ); ?>
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading-<?php echo $i;?>">
          <a role="button" data-toggle="collapse" data-parent="#accordion-<?php echo $accordion_id;?>" href="#collapse-<?php echo $i;?>" aria-expanded="false" aria-controls="collapse-<?php echo $i;?>">
            <div class="wtf-accordion-item">
              <div class="wtf-accordion-img">
                <img src="<?php _e( $image );?>" alt="Accordion Image">
              </div>
              <div class="wtf-accordion-content">
                <h2><?php _e( $item['accordion_title'] ); ?></h2>
                <p><?php _e( $item['accordion_content'] );?></p>
              </div>
            </div>
          </a>
        </div>
        <div id="collapse-<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php echo $i;?>">
          <div class="panel-body">
            <?php echo siteorigin_panels_render( 'wtf-accordian-section-'.$i, true, $item['accordion_section'] );?>
          </div>
        </div> <!-- Accodion Section ends -->
      </div> <!-- Panel ends -->
    <?php endforeach;?>
  </div> <!--Accordion ends-->
</div> <!-- Accordion Wrapper ends-->
