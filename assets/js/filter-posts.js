jQuery.fn.filter_posts = function() {

	return this.each(function() {

		var $el = jQuery(this);

		$el.on( 'click', function(e) {
      e.preventDefault();
      $el.parent().toggleClass('active-filter');
		});

	}); //End each()

};

jQuery(document).ready(function () {
  jQuery('a[data-behaviour~=filter]').filter_posts();
});
