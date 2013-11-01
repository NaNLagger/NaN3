<script language="javascript">
function insert()
{
var text = "<div class=\"release_description\">"+document.getElementById('description').value+"</div>";
var text2 = "<div class=\"release_text\">"+document.getElementById('text').value+"</div>";
document.getElementById('view').innerHTML = text+text2;
}

function savesel(doc)
        {
                if(document.selection) {                
                        doc.sel = document.selection.createRange().duplicate();
                }               
        }
function click_bb(aid,Tag) {
                var Open='<'+Tag+'>';
                var Close='</'+Tag+'>';
				if(Tag == 'br') Close='';
				if(Tag == 'img src=') Close='">';
				if(Tag == 'a href=') Close='"></a>';
				if(Tag == 'img src=' || Tag == 'a href=') Open='<'+Tag+'"';
                var doc = document.getElementById(aid);
                doc.focus();
                if (window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) {                                        
                        var s = doc.sel;
                        if(s){                                  
                                var l = s.text.length;
                                s.text = Open + s.text + Close;
                                s.moveEnd("character", -Close.length);
                                s.moveStart("character", -l);                                           
                                s.select();                
                        }
                }   else {                                              
                        var ss = doc.scrollTop;
                        sel1 = doc.value.substr(0, doc.selectionStart);
                        sel2 = doc.value.substr(doc.selectionEnd);
                        sel = doc.value.substr(doc.selectionStart, doc.selectionEnd - doc.selectionStart);                                              
                        doc.value = sel1 + Open + sel + Close + sel2;
                        doc.selectionStart = sel1.length + Open.length;
                        doc.selectionEnd = doc.selectionStart + sel.length;
                        doc.scrollTop = ss;                                             
                }
                return false;
        }
function upload()
{
	document.getElementById("upload").style.zIndex=-document.getElementById("upload").style.zIndex;
}

</script>

<div>
<? 
	if($flag=="edit")
	{
		$result1 = mysql_query("SELECT * FROM nan_content WHERE alias='$alias'");
		$update = mysql_fetch_array($result1);
		$date = $update['date'];
	}
	if($flag=="new")
	$date = date("y.m.d"); 

?>
<form name="form1" action="<? if($flag=="edit") print "?action=edit"; if($flag=="new") print "?action=add"; ?>" method="post">
<table width="100%" border="0">
  <tr>
    <td>Название: </td>
    <td><input name="title" type="text" size="30" maxlength="255" value="<? if($flag=="edit") print $update['title']; ?>"></td>
  </tr>
  <tr>
    <td>alias(!):</td>
    <td><input name="alias" type="text" size="30" maxlength="255" value="<? if($flag=="edit") print $update['alias']; ?> "  ></td>
  </tr>
  <tr>
    <td>Категория:</td>
    <td>
    	<select name="category" size="1">
        <?
		if($flag=="edit")
		{
        print "<option disabled>Выберите категорию</option>";
		$cat_id=$update['cat_id'];
		$result = mysql_query("SELECT * FROM nan_category WHERE id='$cat_id'");
		$myrow = mysql_fetch_array($result);
		print "<option selected=\"selected\" value=\"".$myrow['id']."\">".$myrow['title']."</option>\n";
	
			$result = mysql_query("SELECT * FROM nan_category WHERE id!='$cat_id'");
		    
			while($myrow = mysql_fetch_array($result))
			{
    			print "<option value=\"".$myrow['id']."\">".$myrow['title']."</option>\n";
			}
		}
		if($flag=="new")
		{
			print "<option selected=\"selected\" disabled>Выберите категорию</option>";
			$result = mysql_query("SELECT * FROM nan_category");
		    
			while($myrow = mysql_fetch_array($result))
			{
    			print "<option value=\"".$myrow['id']."\">".$myrow['title']."</option>\n";
			}
		}
		?>
    	</select>
    </td>
  </tr>
</table>
<p>Краткое описание:</p>
<a href="javascript:void(0);" onclick="click_bb('description', 'b');" onclick="insert();"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/b_icon.png"></a>
<a href="javascript:void(0);" onclick="click_bb('description', 'i');" onclick="insert();"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/i_icon.png"></a>
<a href="javascript:void(0);" onclick="click_bb('description', 'br');" onclick="insert();"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/br_icon.png"></a>
<a href="javascript:void(0);" onclick="click_bb('description', 'p');" onclick="insert();"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/p_icon.png"></a>
<a href="javascript:void(0);" onclick="click_bb('description', 'img src=');" onclick="insert();"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/img_icon.png"></a>
<a href="#"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/color_icon.png"></a>
<a href="javascript:void(0);" onclick="click_bb('description', 'a href=');" onclick="insert();"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/a_icon.png"></a>
<br>
<textarea id="description" name="description" cols="60" rows="10" onKeyDown="insert();"><? if($flag=="edit") print $update['description']; ?></textarea>
<p>Полный текст:</p>
<a href="#"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/b_icon.png"></a>
<a href="#"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/i_icon.png"></a>
<a href="#"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/br_icon.png"></a>
<a href="#"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/p_icon.png"></a>
<a href="#"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/img_icon.png"></a>
<a href="#"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/color_icon.png"></a>
<a href="#"><img width="25" height="25" src="http://localhost/v3/template/nan_blog/images/a_icon.png"></a>
<br>
<textarea id="text" name="text" cols="60" rows="10" onKeyDown="insert();"><? if($flag=="edit") print $update['text']; ?></textarea>
<input name="author" value="<? if($flag=="edit") print $update['author']; if($flag=="new") print $user->userdata['login']; ?>" size="10" maxlength="10" />
<input name="date" value="<? print $date; ?>" size="10" maxlength="10" />
<input name="id" type="hidden" value="<? if($flag=="edit") print $update['id']; ?>" size="10" maxlength="10" />
<div id="view">
</div>
<div id="upload" style="position:fixed; top:50%; left: 50%; margin-left:-300px; margin-top:-200px; z-index:-10;">
<iframe width="600" height="400" src="http://localhost/v3/plugins/plg_upload/upload.php"></iframe>
<a href="javascript:upload();">Закрыть</a>
</div>
<a href="javascript:upload();">Загрузка картинки</a><br />
<input name="sumbit" type="submit" value="Сохранить" />
</form>
</div>