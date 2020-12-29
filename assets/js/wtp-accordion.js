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

  // CHECK IF THERE IS A HASH IN THE URL
   if ( window.location.hash != '' ){
     jQuery('.accordion-wrapper .collapse').removeClass('in'); // HIDE ACCORDION PANELS IF ALREADY VISIBLE (they have a class of 'in')
     jQuery('.accordion-wrapper '+ window.location.hash + '.collapse').collapse('show'); // SHOW THE PANEL BASED ON THE HASH NOW:
   }

   // WTP READ MORE OR LESS
   jQuery('.read-more-less .read').click(function(e) {
    e.preventDefault();
    jQuery('.read-more-less .section').slideToggle();
    if( jQuery(this).hasClass('more-btn') ){
      jQuery(this).hide();
      jQuery('.read-more-less .less-btn').show();
    }
    else{
      jQuery('.read-more-less .less-btn').hide();
      jQuery('.read-more-less .more-btn').show();
    }
  });

});
