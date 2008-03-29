<?php
/***************************************************************************
 *                           system/class.template.php
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

class template
{
    protected $templatedir;
    protected $templatefile;
    protected $replacement;
    /**
    *   Loads the template directory
    *   @param $loadfile    The template file to load if null index.tpl is loaded
    *   @param $rootdir     Sets the template root dir if not set /img/toc/template is set
    *   @access public
    */
    public function __construct($loadfile = null, $rootdir = null)
    {
        if(isset($rootdir) && isdir($rootdir)) $this->templatedir = $rootdir;
        else $this->templatedir = "design/default/templates/";
        
        if($loadfile == null) $this->templatefile = $this->templatedir."/index.tpl";
        else
        {
            if(file_exists($this->templatedir.$loadfile))
               $this->templatefile = $this->templatedir.$loadfile;
            else log::append("File does not exist",log::ERROR);
        }
    }
    /**
    *   Method to be echoed
    *   @return string  The site template
    *   @access public
    */
    public function _show()
    {
        if(isarray($this->replacement)) extract($this->replacement);
        obstart();
        include($this->templatefile);
        $content = obgetcontents();
        obendclean();
        return $content;
    }
    /**
    *   Sets the first parameter to the second value
    *   @param $env         The enviroment variable set in the HTML code
    *   @param $value       The value which the enviroment should be set to
    *   @access public
    */
    public function _assign($env, $value)
    {
        if($env && $value)
            $this->replacement[$env] = isobject($value) ? $value->show() : $value;
    }
}
?>
