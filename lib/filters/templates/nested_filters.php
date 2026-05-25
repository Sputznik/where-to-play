<div class='nested-filters filters'>
	<?php if(  (isset( $atts['primary_filter'] ) && $atts['primary_filter']) || isset( $atts['secondary_filter'] ) && $atts['secondary_filter'] ):?>
	<nav data-behaviour='double-filters' data-target='#archive-results'>
		<div class="roles" style="padding-top: 15px;">
			<span class="filter-by">Role</span>
			<?php $this->print_terms_list( $atts['secondary_filter'], 'secondary-filter', 'secondary', $atts['label_all'] );?>
		</div>
		<div class="resource-types">
			<span class="filter-by">Resource Type</span>
	    <?php $this->print_terms_list( $atts['primary_filter'], 'primary-filter', 'primary', $atts['label_all'] );?>
	  </div>
	</nav>
	<?php endif;?>
	<div id='archive-results'>
		<div class="filter-error">
			<h2 class='text-center'>No resources found</h2>
		</div>
	<?php
		$filters = array( $atts['primary_filter'], $atts['secondary_filter'] );
		echo do_shortcode('[filter_custom_posts filters="'.implode( ',', $filters ).'" post_type="'.$atts['post_type'].'" showposts="'.$atts['showposts'].'"]');
	?>
	</div>
</div>
