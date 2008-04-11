<?php
/***************************************************************************
 *                                 index.php
 *                            -------------------
 *     begin                : 03-29-2008
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
session_start();

require("system/class.auth.php");
require("system/class.base.php");
require("system/class.dba.php");
require("system/class.instance.php");
require("system/class.mail.php");
require("system/class.interface.php");
require("system/class.template.php");
	$index = new template();
	$iface = new iface();
	$index->_assign("headline", "phpBG");
	$index->_assign("title", "phpBG");
	$index->_assign("subtitle", "The Open-Source Browserengine");
	$index->_assign("lang", "en");
	$index = new template();
	$nav = new template("navigation.tpl");
	$res = new template("ressources.tpl");
	$news = new template("news.tpl");

	for($i=0;$i<10;$i++)
		$newslist[] = array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.");
	$usersess = array("LoggedIn" => true,
			  "username" => "VIA",
			  "access" => 1,
			  "lang" => "de",
			  "player" => array("era" => 13,
					    "res" => array("gold" => 1000,
							   "stone" => 1000,
							   "wood" => 1000,
							   "food" => 1000,
							   "iron" => 1000,
							   "oil" => 1000,
							   "energy" => 1000)
					    )
			  
			);
	$news->_assign("newslist", $newslist);
	$nav->_assign("items", $iface->_navigation($usersess));
	$res->_assign("ressource", $iface->_ressources($usersess));
	$index->_assign("lang", "en");
	$index->_assign("title", "phpBG");
	$index->_assign("headline", "phpBG");
	$index->_assign("subtitle", "The Open-Source Browserengine");
	$index->_assign("navigation", $nav);
	$index->_assign("options", $res);
	$index->_assign("content", $news);
	echo $index->_show();
?>
