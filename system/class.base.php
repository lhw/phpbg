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
        $this->executiontime = microtime(true);
    }
    /**
    *   Stops the counter
    *   @access public
    */
    public function _stop()
    {
        $this->executiontime = round(microtime(true) - $this->executiontime, 4);
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
    private $logfile = "log/error.log";
    /**
    *   Appends the logmessage to the log and terminates script execution on ERROR
    *   @param  string  $logmessage The logmessage to append
    *   @param  int $level  The seriousness of the error
    *   @access public
    */
    public static function _append($logmessage, $level = WARNING)
    {
        if($logmessage == null || !file_exists($logfile) || !$errorlog = fopen($logfile, "a"))
        {
            throw new Exception("Logmessage is empty or logfile is not writeable");
        }
        else
        {
            switch($level)
            {
                default:
                case WARNING:
                    echo $logmessage;
                    break;
                case ERROR:
                    file_put_contents($logfile, date("d.m.Y H:i:s")."|".$SERVER["REMOTE_ADDR"]."|".$level."|".$logmessage);
                    die($logmessage);
                    break;
            }
        }
    }
    /**
    *   Terminates the log
    *   @access public
    */
    public static function _purge()
    {
        if(file_exists($logfile)) unlink($logfile);
        else throw new Exception("Logfile does not exist");
    }
}
?>