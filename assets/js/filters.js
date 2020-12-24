jQuery.fn.double_filters = function(){
	return this.each(function(){

		var $el 					= jQuery( this ),
			$target 				= jQuery( $el.data('target') ),
			html 						= $target.html();


		/* ACTIVE MENU ITEM */
		$el.active_menu_item = function( ev ){
			ev.preventDefault();											/* PREVENT DEFAULT EVENT */
			var $menu_target = jQuery( ev.target );				/* GET MENU ITEM */
      var universal_filter 						= $menu_target.parent().siblings('.universal-filter'); /* GET THE CORRECT UNIVERSAL FILTER BASED ON THE SELECTED FILTER TYPE */
			var selected_universal_filter 	= universal_filter.find('[data-filter~=universal].active').length; /* CHECK WHETHER UNIVERSAL FILTER IS ACTIVE OR NOT */

			/* IF THE UNIVERSAL FILTER IS ACTIVE */
      if(selected_universal_filter){
				$menu_target.removeClass('active inactive');
				$menu_target.parent().siblings('li').find('.btn.btn-sm').removeClass('active inactive');
        $menu_target.toggleClass('active'); 			/* TOGGLE MENU ITEM */
      }

			/* IF NONE OF THE UNIVERSAL SELECTORS ARE ACTIVE */
      else{
        $menu_target.toggleClass('active'); 			/* TOGGLE MENU ITEM */
        $el.isEmpty_filters( $menu_target.data('filter') );
      }

      $el.filter_items();			/* FILTER ITEMS */

		};
		/* ACTIVE MENU ITEM */

    /* IF NO FILTERS ARE ACTIVE */
    $el.isEmpty_filters = function(type){

      /* FIND THE LENGTH OF ACTIVE FILTERS BASED ON THE FILTER TYPE */
      var active_filters = $el.find('[data-filter~='+type+'].active').length;

      /* SELECT ALL FILTERS IN THAT ROW AND ADD INACTIVE CLASS AND SELECT THE UNIVERSAL FILTER */
      if(!active_filters){
  			 var universal_filter = jQuery('.'+type+'-filter-list').find('[data-filter~=universal]');
  			 universal_filter.addClass('active');
  			 universal_filter.parent().siblings('li').find('.btn.btn-sm').addClass('active inactive');
      }

		};
		/* IF NO FILTERS ARE ACTIVE */

		/* UNIVERSAL SELECTOR */
		$el.universal_menu_item = function( ev ){
			ev.preventDefault();
			var $menu_target = jQuery( ev.target );
			$menu_target.addClass('active'); /* ADD ACTIVE CLASS TO THE UNIVERSAL SELECTOR IN THAT ROW */

			/* SELECT ALL FILTERS IN THAT ROW AND ADD INACTIVE CLASS */
			$menu_target.parent().siblings('li').find('.btn.btn-sm').addClass('active inactive');

			$el.filter_items();		/* FILTER ITEMS */

		};
		/* UNIVERSAL SELECTOR */

		/* GET ACTIVE FILTERS ID BASED ON THE SELECTED FILTER TYPE */
		$el.filter_selector_id = function( filter_type ){

			$active_filter = $el.find('[data-filter~=' + filter_type + '].active');

			var selector 	= [];

			$active_filter.each(function( index, selectedFilter ){

				var tax = jQuery(selectedFilter).data('tax'),
					id 		= jQuery(selectedFilter).data('id');

				if( tax != undefined && id != undefined ){ selector.push(id); }

			});

			return selector;
		}
		/* GET ACTIVE FILTERS ID BASED ON THE SELECTED FILTER TYPE */


		/* FILTER ITEMS */
		$el.filter_items = function(){

			var active_primary_filters = $el.find('[data-filter~=primary].active').length, /* ACTIVE PRIMARY FILTERS LENGTH */
					active_secondary_filters = $el.find('[data-filter~=secondary].active').length, /* ACTIVE SECONDARY FILTERS LENGTH */
					filters_length = active_primary_filters + active_secondary_filters; /* TOTAL LENGTH OF ALL SELECTED FILTERS */

			// console.log(active_primary_filters,active_secondary_filters);

			$target.html( html );						/* RESET HTML ELEMENTS */

			/* IF NO FILTERS ARE SELECTED, SELECT THE UNIVERSAL FILTERS */
			if( filters_length == 0 ){ $el.find('[data-filter~=universal]').addClass('active'); }

			/* WHEN BOTH PRIMARY AND SECONDARY SELECTORS ARE SELECTED */
			if( active_primary_filters || active_secondary_filters ){

				var resource_type_filters = $el.filter_selector_id('primary'); /* GET ALL THE ACTIVE PRIMARY FILTERS ID */
				var roles_filters = $el.filter_selector_id('secondary'); /* GET ALL THE ACTIVE SECONDARY FILTERS ID */

				var finalArr = []; /* STORES THE POST ID OF ALL THE POSTS BASED ON THE SELECTED FILTERS */

				/* ITERATE THROUGH ALL THE POSTS */
				$target.find("[data-item]").filter( function( i,item ){

					var $item = jQuery(this);

					for (var i = 0; i < resource_type_filters.length; i++) {

						 var catFilter = resource_type_filters[i];

						 for (var j = 0; j < roles_filters.length; j++) {

							 var roleFilter = roles_filters[j];

							 /* CHECKS WHETHER THE CURRENT POST BELONGS TO BOTH THE SELECTED FILTERS CATEGORY */
							 if( $item.is('[data-resource_types~=' + catFilter + ']' ) && $item.is('[data-roles~=' + roleFilter + ']' ) ) {
								 	finalArr.push('[id='+$item.attr('id')+']');
							 }

						 }

					}

				});

				// console.log(finalArr);

				$target.find("[data-item]:not("+finalArr.toString()+")").remove(); /* REMOVE THE IRRELEVANT POSTS */

				if($target.find('[data-item]').length === 0){ jQuery('#archive-results').find('.filter-error').show(); } /* SHOW ERROR MESSAGE */

			}

		};
		/* FILTER ITEMS */

		/* HANDLE CLICK EVENTS */
		$el.find('[data-filter~=primary]').click( function( ev ){
			$el.active_menu_item( ev );	/* ACTIVE MENU ITEM - PRIMARY */
			$el.updateUrlParameter(); /* Bottom filter */
		});
		$el.find('[data-filter~=secondary]').click( function( ev ){
			$el.active_menu_item( ev );	/* ACTIVE MENU ITEM - SECONDARY */
			$el.updateUrlParameter(); /* Top filter */
		});

		/* UNIVERSAL FILTER */
		$el.find('[data-filter~=universal]').click( function( ev ){
			$el.universal_menu_item( ev ); /* ACTIVE MENU ITEM - UNIVERSAL */
		});

		/* HANDLE CLICK EVENTS */

		// BY DEFAULT SELECT THE UNIVERSAL FILTERS
		$el.find('[data-filter~=universal]').click();

		/* MANIPULATES THE URL BASED ON THE SELECTED FILTER */
		$el.updateUrlParameter = function(){

			var updatedUrl = '?';
			var resource_type_filters = $el.filter_selector_id('primary').toString(); /* GET ALL THE ACTIVE PRIMARY FILTERS ID */
			var roles_filters = $el.filter_selector_id('secondary').toString(); /* GET ALL THE ACTIVE SECONDARY FILTERS ID */

			updatedUrl += roles_filters.length > 0 ? `role=${roles_filters}` : '';
			updatedUrl += resource_type_filters.length > 0 ? ( (resource_type_filters.length > 0 && roles_filters.length > 0 ) ? `&type=${resource_type_filters}` : `type=${resource_type_filters}` )  : '';

			window.history.pushState("", "", updatedUrl);

		};
		/* MANIPULATES THE URL BASED ON THE SELECTED FILTER */

	});
}

jQuery(document).ready(function() {

	jQuery('[data-behaviour~=double-filters]').double_filters();

	/* ITERATES THROUGH ALL THE PARAMETERS */
	function getParameterByName() {

    var url = window.location.href;

    /* INVOKE AUTOCLICK ONLY IF PARAMETERS EXIST */
    if( url.indexOf('role') !== -1 || url.indexOf('type') !== -1 ){
      var names = ['role','type'];
  		var params = [];

  		jQuery.each( names, function( i,name ){
   		 var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
   				 results = regex.exec(url);
   		 if (!results) return null;
   		 if (!results[2]) return '';
   		 params += decodeURIComponent(results[2].replace(/\+/g, ' ')) + ',';

      });

      params = params.slice(0, -1).split(',');
			autoClickFilter( params );

    }

 	}


 /* AUTOCLICKS FILTER BUTTONS ON PAGE LOAD */
 function autoClickFilter( params ){

   var  filters = jQuery('[data-behaviour~=double-filters]').find('.btn'); // SELECTS ALL THE FILTER BUTTONS

	 jQuery.each( params, function( i, v ){

			jQuery.each( filters , function( j, tax ){

				if( jQuery(tax).data('id') == v ){ jQuery(tax).click(); }

			});

	 });

 }

 /* EXECUTES ONLY ONCE */
 getParameterByName();

});
