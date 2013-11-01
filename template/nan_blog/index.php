<?
	$user = new Authorization();
	$page = new Content();
	$position = new Positions;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? print $site->name." - ".$page->title;  ?></title>
<link href="<? echo $site->url; ?>/template/<? echo $template->name;?>/css/template.css" rel="stylesheet" type="text/css" />
<script src="<? echo $site->url; ?>/template/<? echo $template->name;?>/js/jquery.min.js"></script>
<script src="<? echo $site->url; ?>/template/<? echo $template->name;?>/js/slides.js"></script>
</head>

<body>

<div id="gkTopBar">
	<div style="max-width:1000px; margin:0 auto;">
    <? $position->view("abs_top"); ?>
    </div>
</div>

<? if($user->Prava()) include_once("admin_panel.php"); ?>

<table class="toptable" width="1000px;">
<tr>
    <td class="center">
    <div style="margin:15px; margin-left:25px; margin-top:30px; "><img src="<? echo $site->url; ?>/template/<? echo $template->name;?>/images/logo.png" width="198" height="25" alt="logo" /></div>
	<? $position->view("top_menu"); ?>
    </td>
</tr>
</table>
<table class="maintable" width="1000px;">
  <tr>
    <td style="vertical-align:top; padding:10px; padding-left:25px; width:600px;">
    	<? $position->view("slide"); ?>
		<? $page->GetContent(); ?>
    </td>
    <td class="maintd"><? $position->view("right"); ?></td>
  </tr>
</table>
<div class="footer">
<a href="<? echo $site->url; ?>" id="NanLogo" title="NaNoLagger">NaNoLagger</a>
<div style="float:right; display:block;">NaNoLagger &copy; 2011-2013 Все права защищены</div>
</div>
</body>
</html>