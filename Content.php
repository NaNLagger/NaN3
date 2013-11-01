<?

class Content
{
	public $PgOpen;
	public $alias;
	public $action;
	public $title;
	public $description;
	public $keywords;
	public $mini_img;
	public function __construct() {
		if(isset($_GET['PgOpen'])) { $this->PgOpen = $_GET['PgOpen']; } else { $this->PgOpen = NULL; }
		if(isset($_GET['alias'])) { $this->alias = $_GET['alias']; } else { $this->alias = NULL; }
		if(isset($_GET['action'])) { $this->action = $_GET['action'];} else { $this->action = NULL; }
		switch($this->PgOpen)
		{
			case "category": 
			{
				$result = mysql_query("SELECT * FROM nan_category WHERE alias='$this->alias'");
				$myrow = mysql_fetch_array($result);
				$this->title = $myrow['title'];
				$this->description = $myrow['description'];
				$this->mini_img = $myrow['mini_img'];
				$this->keywords = $myrow['keywords'];				
			} break;
			case "article": 
			{
				$result = mysql_query("SELECT * FROM nan_content WHERE alias='$this->alias'");
				$myrow = mysql_fetch_array($result);
				$this->title = $myrow['title'];
				$this->description = $myrow['description'];
				$this->mini_img = $myrow['mini_img'];
				$this->keywords = $myrow['keywords'];
				switch($this->action)
				{
					case "edit": {
						
					} break;
					default: {} break;
				}
			} break;
			case "login":
			{
				global $user;
				switch($this->action)
				{
					case "exit": 
					{
						$user->ExitAction();
					} break;
					default: 
					{
						$user->LogIn();
					} break;
				}
				
			} break;
			default:
			{	$pagegetcontent="index";
				$result = mysql_query("SELECT * FROM nan_pagesettings WHERE page='$pagegetcontent'");
				$myrow = mysql_fetch_array($result);
				$this->title = $myrow['title'];
				$this->description = $myrow['description'];
				$this->mini_img = $myrow['mini_img'];
				$this->keywords = $myrow['keywords'];
			} break;
		}
	}
	public function GetContent() {
		global $user;
		switch($this->PgOpen)
		{
			case "category": 
			{
				$content = new Factory;
				$content->PrintListContent(0,7);
			} break;
			case "article": 
			{
				$content = new Factory;
				switch($this->action)
				{
					case "edit": {
						if($user->Prava())
						$content->EditContent($this->alias);
						else print "Нет доступа";
					} break;
					case "add": {
						if($user->Prava())
						$content->AddContent();
						else print "Нет доступа";
					} break;
					case "delete": {
						if($user->Prava())
						$content->DeleteContent($this->alias);
						else print "Нет доступа";
					} break;
					default: {
						
						$content->PrintContent($this->alias);
					} break;
				}
			} break;
			case "modules":
			{
				$content = new Modules;
				$content->PrintModule($this->alias);
			} break;
			default:
			{
				$content = new Factory;
				$content->PrintListContent(0,7);
			} break;
		}
	}
	
};
	
