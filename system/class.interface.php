<?php
/***************************************************************************
 *                                 index.php
 *                            -------------------
 *     begin                : 04-11-2008
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
class iface {
	/**
	*	Displays all avaiable Menuentries
	*	@param  array   $usersess   The Session of the current user
	*	@return array   The Menuentries as [name, link]
	*	@access public
	*/
	public function _navigation() {
		$access = (isset($_SESSION['access'])) ? $_SESSION['access'] : 0;
		$xml = new SimpleXMLElement("data/xml/navigation.xml", NULL, true);
		foreach($xml->item as $item) {
			$level = explode(" ",(string)$item->level);
			if(in_array($access, $level)) {
				$attr = $item->attributes();
				$content[] = array("name" => $this->_translation("NAV_".$attr['name']),
									"url" => (string)$item->url);
			}
		}
		return $content;
	}
	/**
	*	Displays the currently avaiable ressources
	*	@param array    $usersess   The Session of the current user
	*	@return array   The ressourcelist [ressourcename, count]
	*	@access public
	*/
	public function _ressources(array $usersess) {
		$xml = new SimpleXMLElement("data/xml/ressources.xml", NULL, true);
		foreach($xml->ressource as $item) {
			$era = explode(" ", (string)$item->era);
			if(in_array($usersess['player']['era'], $era) && $usersess['access'] > 0) {
				$attr = $item->attributes();
				$content[] = array("name" => $this->_translation("RESSOURCE_".(string)$attr['name']),
									"count" => ($usersess['player']['res'][(string)$attr['name']] == null) ? 0 : $usersess['player']['res'][(string)$attr['name']]);
			}
		}
		return $content;
	}
	/**
	*	Shows the translation for the input. Automatically greps the language from the browser
	*	@param $text    mixed   Either the correspondening name or the id
	*	@return string The translated text
	*	@access public
	*/
	public static function _translation($text) {
		$xml = new SimpleXMLElement("data/xml/translations.xml", NULL, true);
		$lang = iface::_userlanguage();
		if(is_object($text)) $text = strval($text);
		if(is_string($text)) {
			$text = strtoupper($text);
			foreach($xml->trans as $item) {
				$attr = $item->attributes();
				if($attr['name'] == $text) $output[] = (string)$item->$lang;
			}
		}
		elseif(is_int($text)) {
			foreach($xml->trans as $item) {
				$attr = $item->attributes();
				if($attr['id'] == $text) $output[] = (string) $item->$lang;
			}
		}
		else log::_append("The input is not of valid format", log::WARNING);
		if(count($output) > 1) log::_append("There is more then one translation with this name/id", log::WARNING);
		elseif(count($output) < 1) log::_append("No translation exists with this name/id", log::WARNING);
		else return $output[0];
	}
	/**
	*	Greps the user langugage from the browser
	*	@return string The userlanguage as ISO 2 chars
	*	@access public 
	*/
	public static function _userlanguage() {
		$xml = new SimpleXMLElement("data/xml/translations.xml", NULL, true);
		$languages = isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? $_SERVER["HTTP_ACCEPT_LANGUAGE"] : "en_EN";
		$language = explode(",",$languages);
		for($i = 0; $i <= count($xml->avaiable->language); $i++) {
    	        $avaiable[] = (string)$xml->avaiable->language[$i];
        }
		if(in_array(substr($language[0], 0, 2), $avaiable)) 
			return substr($language[0], 0, 2);
		else return "en";
	}
}
?>
