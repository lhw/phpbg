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

include("system/class.auth.php"); 
include("system/class.base.php");
include("system/class.dba.php");  
#include("system/class.instance.php");  
include("system/class.interface.php");
include("system/class.mail.php");
include("system/class.template.php");

$index = new template("index.tpl");
$nav = new template("navigation.tpl");
$res = new template("ressources.tpl");
$iface = new iface();
$auth = new auth();
$newsreader = new news();

$nav->_assign("items",$iface->_navigation());
$index->_assign("headline","phpBG");
$index->_assign("title", "phpBG");
$index->_assign("subtitle", "The Open-Source Browsergameengine");
$index->_assign("lang", iface::_userlanguage());
$index->_assign("options", $res);
$index->_assign("navigation", $nav);

if(isset($_SESSION['log'])) {
	$error = new template("error.tpl");
	$error->_assign("message", $_SESSION['log']);
	$index->_assign("error", $error);
	unset($_SESSION['log']);
}

$_SESSION['trackback'] = (isset($_GET['a'])) ? $_GET['a'] : "news";

switch($_GET['a'])
{
	default:
	case "news":
		$news = new template("news.tpl");
		$news->_assign("newslist", $newsreader->_newspage());
		$index->_assign("content", $news);
		echo $index->_show();
		break;
	case "login":
		if($_GET['send'] == true) {
			$auth->_login($_POST['login'], $_POST['pass']);
		}
		else {
			$login = new template("login.tpl");
			$index->_assign("content", $login);
			echo $index->_show();
		}
		break;
	case "logout":
		$auth->_logout();
		break;
	case "register":
		if($_GET['send'] == true) {
			$auth->_register($_POST['login'], $_POST['pass'], $_POST['email']);
		}
		else {
			$register = new template("register.tpl");
			$index->_assign("content", $register);
			echo $index->_show();
		}
}
