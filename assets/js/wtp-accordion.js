jQuery(document).ready(function(){

  var $header = jQuery('.sticky-transparent-header');

  // EVENT TRIGGERED WHEN THE ACCODION TAB IS CLICKED
  jQuery('.accordion-wrapper .panel-collapse').on('shown.bs.collapse', function() {

    if( $header.hasClass('affix') ) { headerOffset = 90; } else { headerOffset = 170; }

    var $panel = jQuery(this).closest('.panel');

    jQuery('html,body').animate({
      scrollTop: $panel.offset().top - headerOffset
    }, 500);

  });

});
