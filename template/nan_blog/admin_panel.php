<style>
div.admin_panel {
	position:fixed; 
	left:0px; 
	top:60px; 
	border:#fff 2px solid; 
	width:100px; 
	height:500px; 
	background-color:#282828;
	margin-left:-10px;
	border-radius:10px;
}

div.admin_panel a {
	color:#CCC;
}

div.admin_panel a:hover {
	color:#FFF;
}
</style>

<div class="admin_panel">
	<div style="margin-left:15px; margin-top:20px; width:80px;">
	<center><a href="<? print $site->url; ?>/article/?action=add"><img width="36" height="36" src="<? print $site->url; ?>/template/nan_blog/images/add.png"><br />Новая статья</a>
    </div>
</div>
