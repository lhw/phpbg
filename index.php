<?php
/***************************************************************************
 *								 index.php
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
session_start();
error_reporting(E_ALL);

include("system/class.auth.php"); 
include("system/class.base.php");
include("system/class.dba.php");  
#include("system/class.instance.php");  
include("system/class.interface.php");
include("system/class.mail.php");
include("system/class.template.php");

$index = iface::loadData(new template());

if(isset($_SESSION['log'])) {
	$error = new template("error.tpl");
	$error->assign("message", $_SESSION['log']);
	$index->assign("error", $error);
	unset($_SESSION['log']);
}

$auth = isset($_SESSION['auth']) ? unserialize($_SESSION['auth']) : new auth();
$_SESSION['trackback'] = (isset($_GET['a'])) ? $_GET['a'] : "news";

switch($_GET['a'])
{
	default:
	case "news":
		$news = new template("news.tpl");
		$news->assign("newslist", news::newspage());
		$index->assign("content", $news);
		break;
	case "login":
		if(isset($_POST['login']) && isset($_POST['pass']))
			$auth->login($_POST['login'], $_POST['pass']);
		else {
			$login = new template("login.tpl");
			$index->assign("content", $login);
		}
		break;
	case "logout":
		$auth->logout();
		break;
	case "register":
		if(isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['email']))
			$auth->register($_POST['login'], $_POST['pass'], $_POST['email']);
		else {
			$register = new template("register.tpl");
			$index->assign("content", $register);
		}
}
$index->view();
?>
