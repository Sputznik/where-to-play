jQuery(document).ready(function(){

  var $header = jQuery('.sticky-transparent-header'),
      $navigation = jQuery('#bs-example-navbar-collapse-1 ul.navbar-nav'),
      $activeItem = $navigation.children('li.dropdown.active');

  // EVENT TRIGGERED WHEN THE ACCODION TAB IS CLICKED
  jQuery('.accordion-wrapper .panel-collapse').on('shown.bs.collapse', function() {

    if( $header.hasClass('affix') ) { headerOffset = 90; } else { headerOffset = 170; }

    var $panel = jQuery(this).closest('.panel');

    jQuery('html,body').animate({
      scrollTop: $panel.offset().top - headerOffset
    }, 500);

  });

   jQuery(window).on('hashchange', function(){ autoCheckHash(); }); /* EXECUTES autoCheckHash() WHENEVER THE URL GETS CHANGED */

   // CHECK IF THERE IS A HASH IN THE URL
    function autoCheckHash(){
      if( window.location.hash != ''){
       deactivateDropdownItem();
       var $activedropdownItem = $activeItem.find('li a[href*="'+window.location.hash+'"]');
       if( $activedropdownItem.length > 0 ){
         jQuery('.accordion-wrapper .collapse').removeClass('in'); // HIDE ACCORDION PANELS IF ALREADY VISIBLE (they have a class of 'in')
         jQuery('.accordion-wrapper '+ window.location.hash + '.collapse').collapse('show'); // SHOW THE PANEL BASED ON THE HASH NOW:
       }
      }
      else{ deactivateDropdownItem(); }
    }

    // REMOVES ACTIVE CLASS FROM THE DROPDOWN MENU ITEMS
    function deactivateDropdownItem(){
      // EXECUTES ONLY IF THE DROPDOWN MENU IS ACTIVE
      if( $activeItem.length > 0 ){
        $activeItem.find('li a[href]').filter( function( i, item ){
          var $item = jQuery(this);
          if( window.location.href !== $item.attr('href') ){ $item.parent('li.menu-item').removeClass('active'); }
        });
      }
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

  /* WTP CATEGORIES */
  jQuery('.wtp-categories li.current-cat > a').on('click',function(e){
    e.preventDefault();
    var blog_url = jQuery(this).data('blog');
    window.location.href = blog_url;
  });

  autoCheckHash(); /* EXECUTED ON PAGE LOAD */

});
