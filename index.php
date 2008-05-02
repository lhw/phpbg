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
include("system/class.instance.php");  
include("system/class.interface.php");
include("system/class.mail.php");
include("system/class.template.php");

$index = new template("index.tpl");
$nav = new template("navigation.tpl");
$res = new template("ressources.tpl");
$iface = new iface();

$index->_assign("headline","phpBG");
$index->_assign("title", "phpBG");
$index->_assign("subtitle", "The Open-Source Browsergameengine");
$index->_assign("lang", iface::_userlanguage());
$nav->_assign("items",$iface->_navigation());
$index->_assign("navigation", $nav);

switch($_GET['a'])
{
	default:
	case "news":
		for($i=0;$i<10;$i++)
		        $fakes[] = array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euis");
		$news = new template("news.tpl");
		$news->_assign("newslist", $fakes);
		$index->_assign("content", $news);
		echo $index->_show();
		break;
	case "login":
		$login = new template("login.tpl");
		$index->_assign("content", $login);
		echo $index->_show();
		break;
}
