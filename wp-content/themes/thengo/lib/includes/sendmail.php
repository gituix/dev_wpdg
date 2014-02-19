<?php
require_once( '../../../../../wp-load.php' );
$sitename = get_bloginfo('name');
$siteurl =  get_bloginfo('siteurl');

$adminemail = isset($_POST['wid_adminemail']) ? trim($_POST['wid_adminemail']) : '' ;
$name = isset($_POST['wid_contactname']) ? trim($_POST['wid_contactname']) : '' ;
$email = isset($_POST['wid_contactemail']) ? trim($_POST['wid_contactemail']) : '' ;
$message = isset($_POST['wid_contactmessage']) ? trim($_POST['wid_contactmessage']) : '' ;

//$body = 'This is body ' . $adminemail . ' = ' . $name . ' = ' . $email . ' = ' . $message;
//wp_mail('mastasoftware@gmail.com', 'Hello hoaw are you?', $body, 'Form:mastasoftware@gmail.com');
//exit sub
$iserror = false;
if($adminemail === '' || $email === '' || $message === '' || $name === ''){
	$iserror = true;
}
if(!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email)){
	$iserror = true;
}
if(!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $adminemail)){
	$iserror = true;
}

if($iserror == false){
	$subject = $sitename."'s message from ".$name;
	$body .= "website: ".$sitename." - ".$siteurl." \n\n";
	$body .= "Name: ".$name." \n\n";
	$body .= "Email: ".$email." \n\n";
	$body .= "Messages: ".$message;
	$headers = "From: ".$sitename." <".$email.">\r\nReply-To: ".$email."\r\n";
	wp_mail($adminemail, $subject, $body, $headers);
}

?>