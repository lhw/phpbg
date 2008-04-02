<?php
/***************************************************************************
 *                           system/class.auth.php
 *                            -------------------
 *     begin                : 04-02-2008
 *     copyright            : (c) 2008 The phpBG Team
 *     email                : phpbg@gmail.com
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
    protected $username;
    protected $password;

    /**
    *   Setup userdata
    *   @param $user     The username
    *   @param $pass     The password
    *   @access public
    */
    public function __construct($username = null, $password = null)
    {
        $this->username = $user;
        $this->password = $pass;
    }

    /**
    *   Method to login
    *   @return boolean      Success of login
    *   @access public
    */
    public function _login()
    {
		//...
    }

	/**
	*   Method to register
	*   @return boolean      Success of register
	*   @param $email        The email address of the new user
	*   @access public
	*/
	public function _register($email = null, )
	{
        //...
	}

	/**
	*   Method to send a forgotten password
	*   @return boolean     Success of method
	*   @access public
	*/
	public function _password()
	{
        //...
	}
}
?>
