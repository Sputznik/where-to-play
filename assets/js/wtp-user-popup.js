jQuery.fn.wtp_user_popup = function() {

	return this.each(function() {

		var $el           = jQuery(this),
        $image         = $el.find('.user-thumbnail-bg'),
				imageUrl			=	$image.attr('style'),
        name          = $el.find('.name').text(),
        role          = $el.find('.role').text(),
        location      = $el.find('.location').text(),
        bio           = $el.find('.bio').html(),
        social_links  = $el.data('social');

    // CREATES DYNAMIC USER MODAL
		$el.on( 'click', function() { $el.createModal(); });

    // WTP USER MODAL LAYOUT
    $el.createModal = function() {

      html = `
      <div class="modal fade wtp-popup" id="wtp-user-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <a id="close" data-toggle="modal" data-target="#wtp-user-modal" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
            </div>
            <div class="modal-body">
              <div class="wtp-user-body">
                <div class="user-thumbnail-bg" style="${imageUrl}"></div>
                <div class="user-meta">
                  <h5 class="name">${name}</h5>
                  <span class="role">${role}</span>
                  <span class="location">${location}</span>
                  <div class="separator"></div>
                  <div class="bio">${bio}</div>
									${social_links.web ?
										`<span class="website">
											<a href="${social_links.web}" target="_blank">${social_links.web.replace(/^(?:https?:\/\/)?(?:www\.)?/i, "").split('/')[0]}</a>
										</span>` : ''}
                  <!-- Social Links -->
                  <ul class="social-media list-unstyled">
										${social_links.mail ?
											`<li>
	                      <a href="mailto:${social_links.mail}" target="_blank">
													<span class="mail"></span>
												</a>
	                    </li>` : ''}
										${social_links.li ?
											`<li>
	                      <a href="${social_links.li}" target="_blank">
													<span class="linkedin"></span>
												</a>
	                    </li>` : ''}
										${social_links.tw ?
											`<li>
	                      <a href="${social_links.tw}" target="_blank">
													<span class="twitter"></span>
												</a>
	                    </li>` : ''}
                  </ul>
                </div>
              </div>
            </div><!-- Modal Body -->
          </div><!-- Modal Content -->
        </div><!-- Modal Dialog -->
      </div>
      `;

      jQuery("body").append(html);
			jQuery('#wtp-user-modal').modal('show');
    }

    // REMOVES MODAL FROM THE DOM
    jQuery(document).on('hidden.bs.modal', function () {
			jQuery('#wtp-user-modal').remove();
      jQuery('.modal-backdrop.in').remove();
		});


	}); //End each()

};

jQuery.fn.wtp_ambassador_popup = function() {

	return this.each(function() {

		var $el            = jQuery(this),
        $image         = $el.find('.user-thumbnail-bg'),
				imageUrl			 =	$image.attr('style'),
        name           = $el.find('.name').text(),
        $year_flag     = $el.find('.year-flag').html(),
				$key_projects  = $el.find('.key-projects'),
				total_projects = $key_projects.data('total-projects'),
				location       = $el.find('.location').text(),
        bio            = $el.find('.bio').html(),
        social_links   = $el.data('social');

    // CREATES DYNAMIC USER MODAL
		$el.on( 'click', function() { $el.createModal(); });

    // WTP USER MODAL LAYOUT
    $el.createModal = function() {

      html = `
      <div class="modal fade wtp-popup" id="wtp-ambassador-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <a id="close" data-toggle="modal" data-target="#wtp-ambassador-modal" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
            </div>
            <div class="modal-body">
              <div class="wtp-user-body">
                <div class="modal-col-left">
									<div class="user-thumbnail-bg" style="${imageUrl}"></div>
									<span class="year-flag">${$year_flag}</span>
								</div>
								<div class="user-meta">
                  <h5 class="name">${name}</h5>
                  <span class="location">${location}</span>
                  <div class="separator"></div>
                  <div class="bio">${bio}</div>
									${total_projects ? `
										<div class="key-projects">
											${$key_projects.html()}
										</div>`: ''}
									${social_links.web ?
										`<span class="website">
											<a href="${social_links.web}" target="_blank">${social_links.web.replace(/^(?:https?:\/\/)?(?:www\.)?/i, "").split('/')[0]}</a>
										</span>` : ''}
                  <!-- Social Links -->
                  <ul class="social-media list-unstyled">
										${social_links.mail ?
											`<li>
	                      <a href="mailto:${social_links.mail}" target="_blank">
													<span class="mail"></span>
												</a>
	                    </li>` : ''}
										${social_links.li ?
											`<li>
	                      <a href="${social_links.li}" target="_blank">
													<span class="linkedin"></span>
												</a>
	                    </li>` : ''}
										${social_links.tw ?
											`<li>
	                      <a href="${social_links.tw}" target="_blank">
													<span class="twitter"></span>
												</a>
	                    </li>` : ''}
                  </ul>
                </div>
              </div>
            </div><!-- Modal Body -->
          </div><!-- Modal Content -->
        </div><!-- Modal Dialog -->
      </div>
      `;

      jQuery("body").append(html);
			jQuery('#wtp-ambassador-modal').modal('show');
    }

    // REMOVES MODAL FROM THE DOM
    jQuery(document).on('hidden.bs.modal', function () {
			jQuery('#wtp-ambassador-modal').remove();
      jQuery('.modal-backdrop.in').remove();
		});


	}); //End each()

};

jQuery(document).ready(function () {

	jQuery('a[data-behaviour~=wtp-user-popup]').wtp_user_popup();
	jQuery('[data-behaviour~=wtp-ambassador-popup]').wtp_ambassador_popup();

	// DON'T SHOW MODAL IF SOCIAL LINK IS CLICKED
	jQuery('.wtp-ambassador-card .social-media a').on( 'click', function(e) {
		e.stopPropagation();
	});

});
