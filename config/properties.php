<?php
//===================-[Database]
/*
*	type:
*		Can be either PDOMySQL or MySQL.
*		Default is PDOMySQL which is also recommended
*	host:
*		If the MySQL-server runs on the same machine its localhost
*		Only change if you know its otherwise
*	port:
*		Default port is 3306
*		Only change if you know its otherwise
*	user:
*		The username which has access to the database
*	pass:
*		The password for the specified username
*	data:
*		The database holding the game related tables
*/
$database['type'] = "PDOMySQL";
$database['host'] = "localhost";
$database['port'] = "3306";
$database['user'] = "phpbg";
$database['pass'] = "phpbg";
$database['data'] = "phpbg";

//===================-[Mailservice]
/*
*	type:
*		Use smtp for SMTP mailing, php for PHP mailing or none to deactivate mails
*	addr:
*		The mailservers address. Like smtp.example.com (only for SMTP mode)
*	port:
*		The mailservers port. Default 25 (only for SMTP mode)
*	ussl:
*		If the mailserver needs ssl or ssl is avaiable write yes here (only for SMTP mode)
*	user:
*		The user which is allowed to send the mails (only for SMTP mode)
*	pass:
*		The password for the user (only for SMTP mode)
*/
$mailserv['type'] = "smtp";
$mailserv['addr'] = "smtp.example.com";
$mailserv['port'] = "25";
$mailserv['ussl'] = "yes";
$mailserv['user'] = "webmaster@example.com";
$mailserv['pass'] = "Example";

//===================-[Security]
/*
*	!!!NEVER CHANGE ANYTHING IN THIS SECTION WHEN THE GAME IS ALREADY IN USE!!!
*	meth:
*		The method to be used for password security.
*			- mcrypt    -> Requires php_mcrypt plugin. Is the most secure way
*			- hash      -> Simple hash method. Used by most systems
*			- salt      -> Combined hashing and salts more secure then hashes only
*	text:
*		The text to be encrypted by the mcrypt plugin.
*	Minimum 6 characters maximum 255.
*/
$security['meth'] = "mcrypt";
$security['text'] = "A nice little Text which allows safe encryption";
?>
