$.fn.double_filters = function(){
	return this.each(function(){

		var $el 					= $( this ),
			$target 				= $( $el.data('target') ),
			html 						= $target.html();



		/* ACTIVE MENU ITEM */
		$el.active_menu_item = function( ev ){
			ev.preventDefault();											/* PREVENT DEFAULT EVENT */
			var $menu_target = $( ev.target );				/* GET MENU ITEM */

			/* RESET ALL THE FILTERS IF UNIVERSAL SELECTOR IS ACTIVE */
				var universal_filter = $menu_target.parent().siblings('.universal-filter').find('[data-filter~=universal].active').length;

				if(universal_filter){
					$menu_target.removeClass('active inactive');
					$menu_target.parent().siblings('li').find('.btn.btn-sm').removeClass('active inactive');
				}

			/* RESET ALL THE FILTERS IF UNIVERSAL SELECTOR IS ACTIVE */

			$menu_target.toggleClass('active'); 			/* TOGGLE MENU ITEM */
			$el.filter_items();												/* FILTER ITEMS */

		};
		/* ACTIVE MENU ITEM */

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
					selector.push("[data-item][data-" + tax + "~=" + id + "]");
				}

			});

			return selector;
		}
		/* FILTER SELECTOR TEXT */

		/* FILTER ITEMS */
		$el.filter_items = function(){

			var $primary_filter 		= [],
					$secondary_filter 	= [],
					$multi_filters 			= '';
			var active_primary_filters = $el.find('[data-filter~=primary].active').length,
					active_secondary_filters = $el.find('[data-filter~=secondary].active').length;

			// console.log(active_primary_filters,active_secondary_filters);

			/* BUILD PRIMARY FILTER */
			if( active_primary_filters ){ $primary_filter = $el.filter_selector('primary'); }

			/* BUILD SECONDARY FILTER */
			if( active_secondary_filters ){ $secondary_filter = $el.filter_selector('secondary'); }

			$target.html( html );						/* reset html elements */

			if( active_primary_filters || active_secondary_filters ){

				/* MERGE PRIMARY AND SECONDARY FILTERS FOR FASTER FILTERING */
				$multi_filters = $primary_filter.concat($secondary_filter).toString();

				/* REMOVE THE IRRELEVANT POSTS */
				$target.find("[data-item]:not("+$multi_filters+")").remove();

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

	});
}

$("document").ready(function() {

	$('[data-behaviour~=double-filters]').double_filters();

});
