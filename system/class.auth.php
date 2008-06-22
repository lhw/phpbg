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
	*	Status variables for better OOP
	*	@access private
	*/
	private $status = false;
	private $user = null;
	private $access = 0;
	private $id = 0;
	/**
	*   Creating the session
	*   @param string $username The username to create the session for
	*   @param string $password The password for the defined username
	*   @access public
	*/
	public function login($username, $password)
	{
		if($this->validate($username,$password))
		{
			$db = new database();
			$db->setsql("SELECT id, accesslevel FROM user WHERE username = ?");
			$db->query(array($username));
			if($db->getrowcount() == 1)
			{
				session_start();
				$this->status = true;
				$this->user = $username;
				$this->access = $db->result[0][1];
				$this->id = $db->result[0][0];
			}
			else log::append("You are banned from the server", log::WARNING);
		}
		else log::append("Your login data is not valid", log::WARNING);
	}
	/**
	*   Destroys the sessions
	*   @access public
	*/
	public function logout()
	{
		if($this->status == true)
		{
			session_unset();
			session_destroy();
		}
		else log::append("You are not logged in", log::WARNING);
		header("Location: index.php");
	}
	/**
	*   Validates the users login data
	*   @param string $username The user to check for
	*   @param string $password The password to verify
	*   @return boolean Presenting the success
	*   @access public
	*/
	public function validate($username, $password)
	{
		include("config/properties.php");
		$db = new database();
		$db->setsql("SELECT password FROM user WHERE username = ?");
		$db->query(array($username));
		if(sha1("$username:$password") == $db->result[0][0] ) return true;
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
	public function register($user, $pass, $email) {
		if(text::m_plain($user) && text::m_email($email)) {
			$db = new database();
			$db->setsql("INSERT INTO users(username, password, email) VALUES(?, ?, ?)");
			$db->query(array($user,sha1($user,$pass), $email));
			if($db->getrowcount() != 1) {
				log::append(sprintf("The user %s does already exists",$user), log::ERROR);
				return false;
			}
			return true;
		}
		else log::append("Form not correctly filled out", log::WARNING);
	}
	/**
	*   Change password 
	*   @param string $oldpw The old password for checking
	*   @param string $newpw The new password to be changed to
	*   @return boolean Succes of method
	*   @access public
	*/
	protected function changepw($oldpw, $newpw)
	{
		$db = new database();
		$db->setsql("SELECT password FROM users WHERE username = ? AND password = ?");
		$db->query(array($this->user, sha1($this->user.":".$oldpw)));
		if($db->getrowcount() == 1)
		{
			$db->setsql("UPDATE users SET password = ? WHERE username = ? AND password = ?");
			$db->query(array(sha1($this->user.":".$newpw),$this->user, $db->result[0][0]));
			if($db->getrowcount() != 1)
				log::append("The password could not be changed. Please contact an administrator", log::WARNING);
		}
		else log::append("The user/password combination does not exist. Please check your input", log::WARNING);
	}
	/**
	*	Returns the login status
	*	@return	bool	The status
	*	@access public
	*/
	public function getstatus() {
		return $this->status;
	}
	/**
	*	Returns the name of the current user
	*	@return	string	Username
	*	@access public
	*/
	public function getuser() {
		return $this->username;
	}
	/**
	*	Returns the accesslevel
	*	@return	int	Accesslevel
	*	@access public
	*/
	public function getaccess() {
		return $this->access;
	}
	/**
	*	Returns the UserId
	*	@return	int	The userid
	*	@access public
	*/
	public function getid() {
		return $this->id;
	}
}
?>
