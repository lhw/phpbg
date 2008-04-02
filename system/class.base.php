<?php
/***************************************************************************
 *                           system/class.base.php
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

class timer
{
    protected $executiontime;
    /**
    *   Starts the counter
    *   @access public
    */
    public function _start()
    {
        $mtime = explode(" ", microtime());
        $this->executiontime = $mtime[1].$mtime[0];
    }
    /**
    *   Stops the counter
    *   @access public
    */
    public function _stop()
    {
        $mtime = explode(" ", microtime());
        $this->executiontime = round($mtime[1].$mtime[0] - $this->executiontime, 4);
    }
    /**
    *   Returns the elapsed time
    *   @return float   The elapsed time in seconds rounded to 4 digits
    *   @access public
    */
    public function _elapsedtime()
    {
        return $this->executiontime;
    }
}
class log
{
    const ERROR = 0;
    const WARNING = 1;
    /**
    *   Appends the logmessage to the log and terminates script execution on ERROR
    *   @param  string  $logmessage The logmessage to append
    *   @param  int $level  The seriousness of the error
    *   @access public
    */
    public static function _append($logmessage, $level = WARNING)
    {
        $db = new database();
        $db->sql = "INSERT INTO log VALUES (0, ?, ?, ?, ?)"; # Id, date, level, nick, ip, message
        $db->query(array(time(), $level, $nick, $SERVER['REMOTE_ADDR'], $logmessage));
        switch($level)
        {
            default:
            case WARNING:
                echo $logmessage;
                break;
            case ERROR:
                die($logmessage);
                break;
        }
    }
    /**
    *   Purges the log
    *   @access public
    */
    public static function _purge()
    {
    	$db = new database();
	$db->sql "TRUNCATE TABLE log";
	$db->query();
    }
}
?>
