<?php
/* ************************************************************************** */
/* Controllo se definito il parametro con infos                               */
/* ************************************************************************** */
if (!defined('SZVIDEO_SHORTCODE_POPUP') or !isset($_GET['object'])) exit();

/* ************************************************************************** */
/* Parametri di traduzione ed altro per popup                                 */
/* ************************************************************************** */
$parametro = $_GET['object'];
$parametri = unserialize(gzuncompress(base64_decode($parametro)));
?>
<html>
<head>
<title><?php echo $parametri['title'] ?></title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url(); ?>/js/tinymce/tiny_mce_popup.js"></script>
<style type="text/css" src="<?php echo includes_url(); ?>/js/tinymce/themes/advanced/skins/wp_theme/dialog.css"></style>
<style type="text/css">
	#szvideo-dialog { }
	#szvideo-dialog tr, #szvideo-dialog td { vertical-align:top; }
	#szvideo-dialog div { padding:5px 0; height:20px;}
	#szvideo-dialog label { display:block; float:left; margin:0 8px 0 0; width:125px; }
	#szvideo-dialog select, #szvideo-dialog input { display:block; width:110px; padding:3px 5px;}
	#szvideo-dialog input#sz-video-url     { width:500px; }
	#szvideo-dialog input#sz-video-cover   { width:500px; }
	#szvideo-dialog input#sz-video-caption { width:500px; }
	#szvideo-dialog select  { width:110px; }
	#szvideo-dialog #cancel { display:block; line-height:24px; text-align:center; margin:10px 0 0 0; }
	#szvideo-dialog #insert { display:block; line-height:24px; text-align:center; margin:10px 0 0 0; }
	#szvideo-dialog .sz-cols { width:245px; }
	#szvideo-dialog .szvideo-button a { text-decoration:none; }
	#szvideo-dialog p { margin:0; padding:0 0 5px 0; font-weight:bold; text-align:center; border-width:0 0 1px 0; border-style:solid }
</style>
