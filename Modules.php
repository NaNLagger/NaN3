<?
class Modules
{
	
	public function PrintModule($alias)
	{
		$result = mysql_query("SELECT * FROM nan_modules WHERE name='$alias'");
		$myrow = mysql_fetch_array($result);
		$module="modules/".$myrow['name']."/settings.php";
		if(file_exists($module)) include_once($module); else print "<p style=\"color:red;\">Файл настройки не найден</p>";
	}
}