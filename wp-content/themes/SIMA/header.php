<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?wp_head()?>
<script>
$(document).ready(function () {
	  $('#dd_nav > li > a').hover(function(){
	    if ($(this).attr('class') != 'active'){
	      $('#dd_nav li ul').slideUp();
	      $(this).next().slideToggle();
	      $('#dd_nav li a').removeClass('active');
	      $(this).addClass('active');
	    }
	  });
	});
</script>
</head>