<?php
//===================-[Database]
/*
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
*	sufx:
*		The tables suffix e.g. phpbg_*
*/
$database['host'] = "localhost";
$database['port'] = "3306";
$database['user'] = "phpbg";
$database['pass'] = "phpbg";
$database['data'] = "phpbg";
$database['sufx'] = "phpbg_";

//===================-[Site Information]
/*
*	title:
*		The title of the website, displayed in the headline
*		and the window title
*	subtitle:
*		A short description of your website
*/
$info['title'] = "phpBG";
$info['subtitle'] = "phpBG the open Browsergame engine";
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
?>
