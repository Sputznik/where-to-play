$.fn.double_filters = function(){
	return this.each(function(){

		var $el 					= $( this ),
			$target 				= $( $el.data('target') ),
			html 						= $target.html();



		/* ACTIVE MENU ITEM */
		$el.active_menu_item = function( ev ){
			ev.preventDefault();											/* PREVENT DEFAULT EVENT */
			var $menu_target = $( ev.target );				/* GET MENU ITEM */

      var universal_filter 						= $menu_target.parent().siblings('.universal-filter');
			var selected_universal_filter 	= universal_filter.find('[data-filter~=universal].active').length;

      if(selected_universal_filter){
				$menu_target.removeClass('active inactive');
				$menu_target.parent().siblings('li').find('.btn.btn-sm').removeClass('active inactive');
        $menu_target.toggleClass('active'); 			/* TOGGLE MENU ITEM */
      }

      else{
        $menu_target.toggleClass('active'); 			/* TOGGLE MENU ITEM */
        $el.isEmpty_filters( $menu_target.data('filter') );
      }

      $el.filter_items();			/* FILTER ITEMS */



		};
		/* ACTIVE MENU ITEM */

    /* IF NO FILTERS ARE ACTIVE */
    $el.isEmpty_filters = function(type){

      /* FIND THE LENGTH OF ACTIVE FILTERS */
      var active_filters = $el.find('[data-filter~='+type+'].active').length;

      /* SELECT ALL FILTERS IN THAT ROW AND REMOVE BG COLOR */
      if(!active_filters){
  			 var universal_filter = $('.'+type+'-filter-list').find('[data-filter~=universal]');
  			 universal_filter.addClass('active');
  			 universal_filter.parent().siblings('li').find('.btn.btn-sm').addClass('active inactive');
      }

		};

		/* UNIVERSAL SELECTOR */
		$el.universal_menu_item = function( ev ){
			ev.preventDefault();
			var $menu_target = $( ev.target );
			$menu_target.addClass('active');

			/* ACTIVATE ALL FILTERS IN THAT ROW AND REMOVE BG COLOR */
			$menu_target.parent().siblings('li').find('.btn.btn-sm').addClass('active inactive');

			$el.filter_items();

		};
		/* UNIVERSAL SELECTOR */

		/* FILTER SELECTOR TEXT */
		$el.filter_selector = function( filter_type ){

			$active_filter = $el.find('[data-filter~=' + filter_type + '].active');

			var selector 	= [];

			$active_filter.each(function( index, selectedFilter ){

				var tax = $(selectedFilter).data('tax'),
					id 		= $(selectedFilter).data('id');

				if( tax != undefined && id != undefined ){
					// selector.push("[data-item][data-" + tax + "~=" + id + "]");
          selector.push("[data-" + tax + "~=" + id + "]");
				}

			});

			return selector;
		}
		/* FILTER SELECTOR TEXT */

		// SELECTED CATEGORIES ID
		$el.filter_selector_id = function( filter_type ){

			$active_filter = $el.find('[data-filter~=' + filter_type + '].active');

			var selector 	= [];

			$active_filter.each(function( index, selectedFilter ){

				var tax = $(selectedFilter).data('tax'),
					id 		= $(selectedFilter).data('id');

				if( tax != undefined && id != undefined ){
					selector.push(id);
				}

			});

			return selector;
		}
		// SELECTED CATEGORIES ID

		/* FILTER ITEMS */
		$el.filter_items = function(){

			var $primary_filter 		= [],
					$secondary_filter 	= [],
					$multi_filters 			= '';
			var active_primary_filters = $el.find('[data-filter~=primary].active').length,
					active_secondary_filters = $el.find('[data-filter~=secondary].active').length,
					filters_length = active_primary_filters + active_secondary_filters ;

			// console.log(active_primary_filters,active_secondary_filters);

			/* BUILD PRIMARY FILTER */
			if( active_primary_filters ){ $primary_filter = $el.filter_selector('primary'); }

			/* BUILD SECONDARY FILTER */
			if( active_secondary_filters ){ $secondary_filter = $el.filter_selector('secondary'); }

			$target.html( html );						/* reset html elements */

			if( filters_length == 0 ){ $el.find('[data-filter~=universal]').addClass('active'); }

			if( active_primary_filters || active_secondary_filters ){

				// /* MERGE PRIMARY AND SECONDARY FILTERS FOR FASTER FILTERING */
				// $multi_filters = $primary_filter.concat($secondary_filter).toString();


				$multi_filters = $primary_filter.concat($secondary_filter);


				// console.log($multi_filters, $multi_filters.join('') );

				/* REMOVE THE IRRELEVANT POSTS */
				// $target.find("[data-item]:not("+$multi_filters+")").remove();

        /* WHEN BOTH PRIMARY AND SELECTORS ARE SELECTED */
        // if( $el.find('[data-filter~=universal].active').length === 0 ){

					var resource_type_filters = $el.filter_selector_id('primary');
					var roles_filters = $el.filter_selector_id('secondary');

					// console.log(resource_type_filters);

					var finalArr = [];


					$target.find("[data-item]").filter( function( i,item ){

						var $item = $(this);

						for (var i = 0; i < resource_type_filters.length; i++) {

							 var catFilter = resource_type_filters[i];

							 for (var j = 0; j < roles_filters.length; j++) {

								 var roleFilter = roles_filters[j];

								 if( $item.is('[data-resource_types*=' + catFilter + ']' ) && $item.is('[data-roles*=' + roleFilter + ']' ) ) {
									 	finalArr.push('[id='+$item.attr('id')+']');
								 }

							 }

						}

					});

					/* REMOVE THE IRRELEVANT POSTS */
					$target.find("[data-item]:not("+finalArr.toString()+")").remove();


					// $target.find("[data-item]:not("+$multi_filters+")").remove();

					// $target.find("[data-item]:not("+$multi_filters+")").remove();

        // }


				// SHOW ERROR MESSAGE
				if($target.find('[data-item]').length === 0){
					$('#archive-results').find('.filter-error').show();
				}

			}

		};
		/* FILTER ITEMS */

		/* HANDLE CLICK EVENTS */
		$el.find('[data-filter~=primary]').click( function( ev ){
			$el.active_menu_item( ev );											/* ACTIVE MENU ITEM - PRIMARY */
		});
		$el.find('[data-filter~=secondary]').click( function( ev ){
			$el.active_menu_item( ev );											/* ACTIVE MENU ITEM - SECONDARY */
		});

		/* UNIVERSAL FILTER */
		$el.find('[data-filter~=universal]').click( function( ev ){
			$el.universal_menu_item( ev );											/* ACTIVE MENU ITEM - UNIVERSAL */
		});

		/* HANDLE CLICK EVENTS */

		// BY DEFAULT SELECT THE UNIVERSAL FILTERS
		$el.find('[data-filter~=universal]').click();


	});
}

$("document").ready(function() {

	$('[data-behaviour~=double-filters]').double_filters();

});
