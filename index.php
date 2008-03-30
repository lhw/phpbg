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
 
require("system/class.auth.php");
require("system/class.base.php");
require("system/class.dba.php");
require("system/class.template.php");

// short test if game is installed by checking for successful MySQL connection
// if false goto install/ via header() and exit

//test if user is authenticated
// if not show "outside" area with [HOME] [REGISTER] [LOGIN]
// if so go to content management system

?>
