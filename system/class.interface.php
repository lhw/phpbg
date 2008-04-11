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
class iface
{
    /*
    *   Displays all avaiable Menuentries
    *   @param  array   $usersess   The Session of the current user
    *   @return array   The Menuentries as [name, link]
    *   @access public
    */
    public function _navigation(array $usersess)
    {
	$xml = new SimpleXMLElement("data/xml/navigation.xml", NULL, true);
        if($usersess['access'] == null) $usersess['access'] = 0;
        if($usersess['lang'] == null) $usersess['lang'] = "en";
	foreach($xml->item as $item)
	{
            $level = explode(" ",(string)$item->level);
	    if(in_array($usersess['access'], $level))
	    {
	    	$attr = $item->attributes();
	    	$content[] = array("name" => $this->_translation("NAV_".$attr['name'],$usersess['lang']),
                                   "url" => (string)$item->url);
	    }
	}
	return $content;
    }
    /*
    *   Displays the currently avaiable ressources
    *   @param array    $usersess   The Session of the current user
    *   @return array   The ressourcelist [ressourcename, count]
    *   @access public
    */
    public function _ressources(array $usersess)
    {
        $xml = new SimpleXMLElement("data/xml/ressources.xml", NULL, true);
        if($usersess['lang'] == null) $usersess['lang'] = "en";
        foreach($xml->ressource as $item)
        {
            $era = explode(" ", (string)$item->era);
            if(in_array($usersess['era'], $era))
            {
                $attr = $item->attributes();
                $content[] = array("name" => $this->_translation("RESSOURCE_".(string)$attr['name'],$usersess['lang']),
                                   "count" => ($usersess['res'][(string)$attr['name']] == null) ? 0 : $usersess['res'][(string)$attr['name']]);
            }
        }
        return $content;
    }
    /**
    *   Shows the translation for the input
    *   @param $text    mixed   Either the correspondening name or the id
    *   @param $lang    string  The two chars long language identifier (e.g. en or de)
    *   @return string The translated text
    *   @access public
    */
    public function _translation($text, $lang = "en")
    {
        $xml = new SimpleXMLElement("data/xml/translations.xml", NULL, true);
        if(is_object($text)) $text = strval($text);
        if(is_string($text))
        {
            $text = strtoupper($text);
            foreach($xml->trans as $item)
            {
                $attr = $item->attributes();
                if($attr['name'] == $text) $output[] = (string)$item->$lang;
            }
        }
        elseif(is_int($text))
        {
            foreach($xml->trans as $item)
            {
                $attr = $item->attributes();
                if($attr['id'] == $text) $output[] = (string)$item->$lang;
            }
        }
        else die(gettype($text));#log::_append("The input is not of valid format", log::WARNING);
        
        if(count($output) > 1) log::_append("There is more then one translation with this name/id", log::WARNING);
        elseif(count($output) < 1) log::_append("No translation exists with this name/id", log::WARNING);
        else return $output[0];
    }
}
?>