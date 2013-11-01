<?
class Factory
{
	public function PrintContent($alias)
	{
		global $user;
		$result = mysql_query("SELECT * FROM nan_content WHERE alias='$alias'");
		$myrow = mysql_fetch_array($result);
		print "<div class=\"release\">";
		print "<h3>".$myrow['title']."</h3>";
		if($user->Prava()) print "<a href=\"?action=edit\">Редактировать статью</a> | ";
		if($user->Prava()) print "<a href=\"?action=delete\">Удалить статью</a>";
		print "<p class=\"release_author_date\">Автор: ".$myrow['author']." Дата: ".$myrow['date']."</p>";
		print "<div class=\"release_description\">".$myrow['description']."</div>";
		print "<div class=\"release_text\">".$myrow['text']."</div>";
		print "</div>";
	}
	public function PrintMiniContent($id)
	{
		global $site;
		$result = mysql_query("SELECT * FROM nan_content WHERE id='$id'");
		$myrow = mysql_fetch_array($result);
		print "<div class=\"preview\">";
		print "<table width=\"100%\">
					<tr>
						<td>
		<h4 style=\"display:inline;\"><a href=\"".$site->url."/article/alias-".$myrow['alias']."\" class=\"preview\">".$myrow['title']."</a></h4>
						</td>
						<td style=\"text-align:right;\">
		<p class=\"preview_author_date\">Автор: ".$myrow['author']." Дата: ".$myrow['date']."</p>
						</td>
					</tr>
				</table>";
		print "<div class=\"preview_description\">".$myrow['description']."</div>";
		print "<a href=\"".$site->url."/article/alias-".$myrow['alias']."\" class=\"readon\">Читать далее...</a>";
		print "</div>";
		
	}
	public function PrintListContent($start_id, $amound, $cat=false)
	{
		if($cat) 
		$result = mysql_query("SELECT id FROM nan_content WHERE category='$cat' ORDER BY id DESC LIMIT $start_id, $amound");
		else
		$result = mysql_query("SELECT id FROM nan_content ORDER BY id DESC LIMIT $start_id, $amound");
		while($myrow = mysql_fetch_array($result))
		{
			$this->PrintMiniContent($myrow['id']);
		}
	}
	public function UpdateContent($alias)
	{
		if (isset($_POST['title'])) {$title=$_POST['title'];}
		if (isset($_POST['description'])) {$description=$_POST['description'];}
		if (isset($_POST['text'])) {$text=$_POST['text'];}
		if (isset($_POST['author'])) {$author=$_POST['author'];}
		if (isset($_POST['date'])) {$date=$_POST['date'];}
		if (isset($_POST['alias'])) {$alias=$_POST['alias'];}
	}
	public function AddContent()
	{
		if (isset($_POST['sumbit']) && $_POST['sumbit']!=NULL)
		{
			if (isset($_POST['title'])) 
			{
				$title=$_POST['title']; $title = str_replace("'", "'", $title);
			} else {$title=NULL;}
			if (isset($_POST['description'])) 
			{
				$description=$_POST['description']; $description = str_replace("'", "'", $description);
			} else {$description=NULL;}
			if (isset($_POST['text'])) 
			{
				$text=$_POST['text']; $text = str_replace("'", "'", $text);
			} else {$text=NULL;}
			if (isset($_POST['author'])) {$author=$_POST['author'];} else {$author=NULL;}
			if (isset($_POST['date'])) {$date=$_POST['date'];} else {$date=NULL;}
			if (isset($_POST['category'])) {$category=$_POST['category'];} else {$category=NULL;}
			if (isset($_POST['alias'])) {$alias=$_POST['alias'];} else {$alias=NULL;}

			if ($title && $alias && $author && $category && $date && $description && $text)
			{
				$result = mysql_query ("INSERT INTO nan_content (title,alias,author,cat_id,date,description,text) VALUES ('$title','$alias','$author','$category','$date','$description','$text')"); 
				if ($result == true) {echo "Добавлено";}
				else {echo "Не добавлено";}
			}
			else 
			{ 
				print "Не заполнены поля:<br />";
				if(!$title) print "Название:<br />";
				if(!$alias) print "alias<br />";
				if(!$author) print "Автор<br />";
				if(!$category) print "Категория<br />";
				if(!$date) print "Дата<br />";
				if(!$description) print "Краткое описание<br />";
				if(!$text) print "Полный текст<br />";
			}
		}
		else
		{
			global $user;
			$flag="new";
	 		include_once("edit.php");
		}
	}
	public function EditContent($alias)
	{
		global $link;
		if (isset($_POST['sumbit']) && $_POST['sumbit']!=NULL)
		{
			if (isset($_POST['title'])) 
			{
				$title=$_POST['title']; $title = str_replace("'", "'", $title);
			} else {$title=NULL;}
			if (isset($_POST['description'])) 
			{
				$description=$_POST['description']; $description = str_replace("'", "&lsquo;", $description);
			} else {$description=NULL;}
			if (isset($_POST['text'])) 
			{
				$text=$_POST['text']; $text = str_replace("'", "'", $text);
			} else {$text=NULL;}
			if (isset($_POST['author'])) {$author=$_POST['author'];} else {$author=NULL;}
			if (isset($_POST['date'])) {$date=$_POST['date'];} else {$date=NULL;}
			if (isset($_POST['category'])) {$category=$_POST['category'];} else {$category=NULL;}
			if (isset($_POST['alias'])) {$alias=$_POST['alias'];} else {$alias=NULL;}
			if (isset($_POST['id'])) {$id=$_POST['id']; print $id;} else {$id=NULL;}

			if ($title && $alias && $author && $category && $date && $description && $text && $id)
			{
				$result = mysql_query ("UPDATE nan_content SET title='$title',description='$description',text='$text',author='$author',date='$date',cat_id='$category',alias='$alias' WHERE id='$id'"); 
				if ($result == true) {echo "Обновлено";}
				else {echo "Не обновлено"; print mysql_error($link);}
			}
			else 
			{ 
				print "Не заполнены поля:<br />";
				if(!$title) print "Название:<br />";
				if(!$alias) print "alias<br />";
				if(!$author) print "Автор<br />";
				if(!$category) print "Категория<br />";
				if(!$date) print "Дата<br />";
				if(!$description) print "Краткое описание<br />";
				if(!$text) print "Полный текст<br />";
			}
		}
		else
		{
			global $user;
			$flag="edit";
	 		include_once("edit.php");
		}
	}
	public function DeleteContent($alias)
	{
		$result = mysql_query ("DELETE FROM nan_content WHERE alias='$alias'"); 
		if ($result == true) {echo "Удалено";}
		else {echo "Не удалено";}
	}
};
?>