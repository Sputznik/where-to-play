<div class="container-fluid" style="background-color: #fff;">
  <div class="white-bg">
		<?php _e( do_shortcode( '[wtp_web_btns]' ) );?>
	</div>
</div>
<div class="sticky-transparent-header" data-spy="affix" data-offset-top="50">
  <nav class="navbar navbar-default header5">
    <div class="container-fluid"><!-- .container-->
      <!-- Brand and toggle get grouped for better mobile display -->
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
  				<span class="sr-only">Toggle navigation</span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
  			<?php do_action('sp_logo');?>
  		</div>
  		<?php do_action('sp_nav_menu');?>
    </div><!-- /.container-->
  </nav>
</div>
