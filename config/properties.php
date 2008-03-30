<?php
//===================-[Database]
/*
*   type:
*       Can be either PDOMySQL or MySQL.
*       Default is PDOMySQL which is also recommended
*   host:
*       If the MySQL-server runs on the same machine its localhost
*       Only change if you know its otherwise
*   port:
*       Default port is 3306
*       Only change if you know its otherwise
*   user:
*       The username which has access to the database
*   pass:
*       The password for the specified username
*   data:
*       The database holding the game related tables
*/
$database['type'] = "PDOMySQL";
$database['host'] = "localhost";
$database['port'] = "3306";
$database['user'] = "phpbg";
$database['pass'] = "phpbg";
$database['data'] = "phpbg";
//===================-[Mailservice]
/*
*   usem:
*       Activate the SMTP mailservice via yes else use no
*   addr:
*       The mailservers address. Like smtp.example.com
*   port:
*       The mailservers port. Default 25
*   ussl:
*       If the mailserver needs ssl or ssl is avaiable write yes here
*   user:
*       The user which is allowed to send the mails
*   pass:
*       The password for the user
*/
$mailserv['usem'] = "yes";
$mailserv['addr'] = "smtp.example.com";
$mailserv['port'] = "25";
$mailserv['ussl'] = "yes";
$mailserv['user'] = "webmaster@example.com";
$mailserv['pass'] = "Example";
?>