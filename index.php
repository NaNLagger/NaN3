<?
	include_once("plugins/plg_authorization/plg_authorization.php");
	include_once("Content.php");
	include_once("settings.php");
	$site = new Site();
	$link=$site->connect();
	include_once("com_Factory/Factory.php");
	include_once("Modules.php");
	include_once("Positions.php");
	
	include_once("template/nan_blog/nan_blog.php");
	$template = new nan_blog();
	include_once("template/nan_blog/index.php");
?>