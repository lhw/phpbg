<?php
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
    private $error = "log/error.log";
    private $warning = "log/warning.log";
    /**
    *   Appends the logmessage to the log and terminates script execution on ERROR
    *   @param  string  $logmessage The logmessage to append
    *   @param  int $level  The seriousness of the error
    *   @access public
    */
    public static function _append($logmessage, $level = WARNING)
    {
        if($logmessage == null || !file_exists($logfile) || !$errorlog = fopen($this->error, "a") || !$warnlog = fopen($this->warning, "a"))
        {
            throw new Exception("Logmessage is empty or logfile is not writeable");
        }
        else
        {
            switch($level)
            {
                default:
                case WARNING:
                    fwrite($warnlog, date("d.m.Y H:i:s")."|".$SERVER["REMOTE_ADDR"]."|".$level."|".$logmessage);
                    echo $logmessage;
                    break;
                case ERROR:
                    fwrite($errorlog, date("d.m.Y H:i:s")."|".$SERVER["REMOTE_ADDR"]."|".$level."|".$logmessage);
                    die($logmessage);
                    break;
            }
            fclose($errorlog);
            fclose($warnlog);
        }
    }
    /**
    *   Purges the log
    *   @access public
    */
    public static function _purge()
    {
        if(file_exists($this->error) && file_exists($this->warning))
        {
            unlink($this->error);
            unlink($this->warning);
        }
        else throw new Exception("Logfile does not exist");
    }
}
?>