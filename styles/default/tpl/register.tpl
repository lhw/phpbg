<h1><?=iface::_translation("NAV_REGISTER");?></h1>
	<form action="index.php?a=register&send=true" method="post">
		<label for="login"><?=iface::_translation("LOGINNAME");?></label>
		<input type="text" name="login" id="login" /><br />
		
		<label for="pass"><?=iface::_translation("PASSWORD");?></label>
		<input type="password" name="pass" id="pass" /><br />
		
		<label for="email"><?=iface::_translation("EMAIL");?></label>
		<input type="text" name="email" id="email" /><br />

		<button type="submit"><?=iface::_translation("SEND");?></button>
	</form>
