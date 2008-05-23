<?php
/***************************************************************************
 *						   system/class.base.php
 *							-------------------
 *	 begin				: 03-29-2008
 *	 copyright			: (c) 2008 The phpBG Team
 *	 email				: phpbg@gmail.com
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 3 of the License, or
 *   (at your option) any later version.
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *   GNU General Public License for more details.
 *
 ***************************************************************************/

class timer
{
	protected $executiontime;
	/**
	*   Starts the counter
	*   @access public
	*/
	public function _start()
	{
		$mtime = explode(" ", microtime());
		$this->executiontime = $mtime[1].$mtime[0];
	}
	/**
	*   Stops the counter
	*   @access public
	*/
	public function _stop()
	{
		$mtime = explode(" ", microtime());
		$this->executiontime = round($mtime[1].$mtime[0] - $this->executiontime, 4);
	}
	/**
	*   Returns the elapsed time
	*   @return float   The elapsed time in seconds rounded to 4 digits
	*   @access public
	*/
	public function _elapsedtime()
	{
		return $this->executiontime;
	}
}
class log
{
	const FAILEDLOGIN = 0;
	const ERROR = 2;
	const WARNING = 1;
	/**
	*   Appends the logmessage to the log and terminates script execution on ERROR
	*   @param  string  $logmessage The logmessage to append
	*   @param  int $level  The seriousness of the error
	*   @access public
	*/
	public static function _append($logmessage, $level = WARNING)
	{
		$db = new database();
		$user = (isset($_SESSION['userid'])) ? $_SESSION['userid'] : "anonynmous";
		$db->sql = "INSERT INTO §PREFIX§log VALUES (0, ?, ?, ?, ?, ?)";
		$db->_query(array(time(), $level, $user, $_SERVER['REMOTE_ADDR'], $logmessage));
		switch($level)
		{
			default:
			case WARNING:
			case FAILEDLOGIN:
				$_SESSION['log'] .= $logmessage."<br />";
				header("Location: index.php?a=".$_SESSION['trackback']);
				break;
			case ERROR:
				die($logmessage);
				break;
		}
	}
	/**
	*   Purges the log
	*   @access public
	*/
	public static function _purge()
	{
		$db = new database();
		$db->sql = "TRUNCATE TABLE §PREFIX§log";
		$db->query();
	}
}
class text
{
	/**
	*   Provides clean text
	*   @param  string  $string The string to be formatted
	*   @return string  The formated string
	*   @access public
	*   @static
	*/
	public static function _plain($string)
	{
		return preg_replace("/[^A-Za-z0-9 _.@]/","",$string);
	}
	/**
	*   Standard E-Mail expression
	*   @param  string  $string
	*   @return bool	True on match, False on non match
	*   @access public
	*   @static
	*/
	public static function _email($string)
	{
		if(preg_match("/[a-z0-9._-]+@([a-z0-9-]{2,255}\.)+[a-z]{2,5}/i",$string)) return true;
		else return false;
	}
}
class encryption
{
	/**
	*   Returns the encrypted string using the mcrypt
	*   @param string $text The text as base for the encryption
	*   @param string $key The key used for encryption. In this case the password
	*   @return string The encrypted string
	*   @acess public
	*/
	public function _mencrypt($text, $key)
	{
		srand((double)microtime*1000000);
		$td = mcrypt_module_open(MCRYPT_TRIPLEDES, '', MCRYPT_MODE_CFB, '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_RANDOM);
	$ks = mcrypt_enc_get_key_size($td);
		if(strlen($key) <= $ks)
		{
			mcrypt_generic_init($td, $key, $iv);
			$enc = mcrypt_generic($td, $text);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			return $enc;
		}
		else log::_append("The supplied key is too long", log::WARNING);
	}
	/**
	*   Returns the decrypted string for checking
	*   @param string $text The encrypted string
	*   @param string $key The given password
	*   @return string The decrypted string
	*   @access public
	*/
	public function _mdecrypt($text, $key)
	{
		$td = mcrypt_module_open(MCRYPT_TRIPLEDES, '', MCRYPT_MODE_CFB, '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_RANDOM);
	$ks = mcrypt_enc_get_key_size($td);
		if(strlen($key) <= $ks)
		{
			mcrypt_generic_init($td, $key, $iv);
			$dec = mdecrypt_generic($td, $text);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			return $dec;
		}
		else log::_append("The supplied key is too long", log::WARNING);
	}
}
class news {
	public function _read($article) {
		$db = new database();
		$db->sql = "SELECT * FROM §PREFIX§news WHERE id = ?";
		$db->_query(array((int)$article));
		return $db->result[0];
	}
	public function _newspage() {
		$db = new database();
		$db->sql = "SELECT * FROM §PREFIX§news ORDER BY id DESC LIMIT 5";
		$db->_query();
		return $db->result;
	}
	public function _browser($order, $direction, $start, $limit) {
		$db = new database();
		$db->sql = "SELECT * FROM §PREFIX§news ORDER BY ? ? LIMIT ?, ?";
		$db->query(array((string)$order, (string)$direction, (int)$start, (int)$limit));
		return $db->result;
	}
}
?>
