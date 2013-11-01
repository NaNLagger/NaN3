<div id="menu_cont">
<ul>
<?
	$result = mysql_query("SELECT * FROM nan_menu WHERE menu='menu'");	
	while($myrow = mysql_fetch_array($result))
	{
		print "<li><a href=\"".$site->url."".$myrow['link']."\">".$myrow['name']."</a></li>";
	}
?> 	
</ul>
</div>