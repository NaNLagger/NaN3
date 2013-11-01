<div class="mod">
<p class="mod_title">Авторизация</p>
<div class="mod_text">
<?
	global $user;
	if($user->Check())
	$user->Privetstvie();
	else
	$user->FormLogin();
?>
</div>
</div>