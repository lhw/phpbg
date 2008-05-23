<?php
/***************************************************************************
 *						   system/class.auth.php
 *							-------------------
 *	 begin				: 04-04-2008
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

class auth
{
	/**
	*   Creating the session
	*   @param string $username The username to create the session for
	*   @param string $password The password for the defined username
	*   @access public
	*/
	public function _login($username, $password)
	{
		if($this->_validate($username,$password))
		{
			$db = new database();
			$db->sql = "SELECT id, accesslevel FROM §PREFIX§users WHERE username = ?";
			$db->_query(array($username));
			if($db->result[0][1] > 0)
			{
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $username;
				$_SESSION['userid'] = $db->result[0][0];
				$_SESSION['access'] = $db->result[0][1];
				header("Location: index.php");
			}
			else log::_append("You are banned from the server", log::FAILEDLOGINS);
		}
		else log::_append("Your login data is not valid", log::FAILEDLOGINS);
	}
	/**
	*   Destroys the sessions
	*   @access public
	*/
	public function _logout()
	{
		if($_SESSION['loggedin'] == true)
		{
			session_unset();
			session_destroy();
		}
		else log::_append("You are not logged in", log::WARNING);
		header("Location: index.php");
	}
	/**
	*   Validates the users login data
	*   @param string $username The user to check for
	*   @param string $password The password to verify
	*   @return boolean Presenting the success
	*   @access public
	*/
	public function _validate($username, $password)
	{
		$db = new database();
		$db->sql = "SELECT COUNT(username) FROM §PREFIX§users WHERE username = ? AND password = ?";
		$db->_query(array($username, sha1("$username:$password")));
		if($db->result[0][0] == 1) return true;
		else return false;
	}
	/**
	*   Method to register
	*   @param string $user The new username
	*   @param string $pass The bound password
	*   @param string $email The provided email
	*   @return boolean	  Success of register
	*   @access public
	*/
	public function _register($user, $pass, $email)
	{
		if(is_string($user) && is_string($pass) && is_string($email) && text::_email($email))
		{
			$db = new database();
			$db->sql = "INSERT INTO §PREFIX§users(username, password, email, lastlogin) VALUES(?, ?, ?, UNIX_TIMESTAMP())";
			$db->_query(array($user,sha1("$user:$pass"), $email));
			if($db->affected_rows != 1)
				log::_append("The user $user does already exist", log::ERROR);
			else 
				header("Location: index.php");
		}
		else log::_append("Form not correctly filled out", log::WARNING);
	}
	/**
	*   Change password 
	*   @param string $oldpw The old password for checking
	*   @param string $newpw The new password to be changed to
	*   @return boolean Succes of method
	*   @access public
	*/
	protected function _changepw($oldpw, $newpw)
	{
		$db = new database();
		$db->sql = "SELECT COUNT(*) FROM §PREFIX§users WHERE username = ? AND password = ?";
		$db->_query(array($_SESSION['username'], sha1($_SESSION['username'].":".$oldpwd)));
		if($db->affected_rows == 1)
		{
			$db->sql = "UPDATE §PREFIX§users SET password = ? WHERE username = ? AND password = ?";
			$db->_query(array(sha1($_SESSION['username'].":".$newpw), $_SESSION['username'], sha1($_SESSION['username'].":".$oldpw)));
			if($db->affected_rows != 1)
				log::_append("The password was not changed. Please contact an administrator", log::WARNING);
		}
		else log::_append("The user/password combination does not exist. Please check your input", log::WARNING);
	}
}
?>
