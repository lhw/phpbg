<h1><?=iface::_translation("NAV_LOGIN");?></h1>
	<form action="index.php?a=login&send=true" method="post">
		<label for="login"><?=iface::_translation("LOGINNAME");?></label>
		<input type="text" name="login" id="login" /><br />
		
		<label for="pass"><?=iface::_translation("PASSWORD");?></label>
		<input type="password" name="pass" id="pass" /><br />
		
		<button type="submit"><?=iface::_translation("SEND");?></button>
	</form>
