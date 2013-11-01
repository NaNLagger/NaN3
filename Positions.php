<?
class Positions
{
	public function check($str,$page)
	{
		$tok=strtok($str,"\n");		
		while($tok)
		{
			$tok=trim($tok);
			if($tok == $page) return true;
			$tok=strtok("\n");
		}
		return false;
	}
	public function view($position)
	{
		global $site;
		global $page;
		$result = mysql_query("SELECT * FROM nan_modules WHERE position='$position' ORDER BY priority");
		if($result) 
		{
		while($myrow = mysql_fetch_array($result))
		{	
			if(!$this->check($myrow['excep'],$page->PgOpen))
			{
			$module="modules/".$myrow['name']."/".$myrow['name'].".php";
			include_once($module);
			}
		}
		}
	}
};


?>