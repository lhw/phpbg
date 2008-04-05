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
 
require("system/class.instance.php");
require("system/class.base.php");
require("system/class.dba.php");
require("system/class.template.php");
require("system/class.mail.php");

function get_navigation() {
	$navi = array();
	$xml = new XMLReader();
	$xml->open("data/xml/navigation.xml");

	while($xml->read()) {
		if($xml->name == "item" && $xml->nodeType == XMLReader::ELEMENT) {
			$name = $xml->getAttribute("name");
			$url = "";
			$show = true;
		}
		if($xml->name == "url" && $xml->nodeType == XMLReader::ELEMENT) {
			$xml->read();
			if($xml->nodeType == XMLReader::TEXT)
				$url = $xml->value;
		}
		if($xml->name == "item" && $xml->nodeType == XMLReader::END_ELEMENT && $show == true)
			$navi[] = array("link" => $url, "name" => $name);
	}

	return $navi;
}

$xml = new XMLReader();
$index = new template();
$nav = new template("navigation.tpl");
$res = new template("ressources.tpl");
$news = new template("news.tpl");
$error = new template("error.tpl");

$links = get_navigation();

$reslist = array();
$xml->open("data/xml/ressources.xml");
while($xml->read()) {
	if($xml->name == "ressource" && $xml->nodeType == 1)
		$reslist[$xml->getAttribute("name")] = 1000;
}
$xml->close();

$newslist = array(array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi."),
                  array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi."),
                  array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi."),
                  array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi."),
                  array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi."),
                  array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi."),
                  array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi."),
                  array("title" => "Lorem ipsum dolor sit amet, consectetuer ", "text" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi."));

$news->_assign("newslist", $newslist);
$nav->_assign("menu", "Navigation");
$nav->_assign("items", $links);
$res->_assign("res", $reslist);
$error->_assign("message", "Blablub");

$index->_assign("lang", "en");
$index->_assign("title", "phpBG");
$index->_assign("headline", "phpBG");
$index->_assign("subtitle", "The Open-Source Browserengine");
$index->_assign("navigation", $nav);
//$index->_assign("error", $error);
$index->_assign("options", $res);
$index->_assign("content", $news);

echo $index->_show();

?>
