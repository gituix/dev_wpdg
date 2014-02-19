<?php get_header(); ?>
<body>
<div>
 <?php wp_login_form( $args ); ?> 
</div>
<div>
 <?php 
 global $current_user;
 		get_currentuserinfo();
 		echo $current_user->user_login. "<br>";
 		echo $current_user->user_password ?> 
 		
 </div>
 <? 
 $myrows = $wpdb->get_results( "SELECT * 
								FROM  `wp_sio_schede` 
								WHERE  `Numero_A` LIKE  '$current_user->user_login'
								LIMIT 0 , 30");
 
 
 
 ?>
 <?php
	if ( is_user_logged_in() ) {
	    print_r($myrows);
	} else {
	    echo 'non sei loggato';
	}
	get_calendar();
	?>
 <div>
 </div>
<div>
<?php //get_sidebar(); ?>
	<?php get_footer(); ?>
</div>
</body>