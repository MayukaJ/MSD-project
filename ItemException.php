<?php
/**
 * Created by PhpStorm.
 * User: Aba
 * Date: 12/20/2017
 * Time: 5:07 AM
 */

class ItemException extends Exception
{
    public $message = "";
    public $stackTrace = "";
    public $details = array();
    public $functionName = "";

    public function __construct($functionName, $message = "", $details = array(), $stackTrace = "")
    {
        $this->functionName = $functionName;
        $this->message = $message;
        $this->details = $details;
        $this->stackTrace = $stackTrace;
    }
    public function giveWarning()
    {
        echo "<br>";
        echo $this->message;
        echo "<br>";
    }

    public function echoDetails()
    {
        echo "<br><br>";
        echo "Function:   ";
        echo $this->functionName;

        echo "<br><br>";
        echo "Error Message:   ";
        echo $this->message;


        if(count($this->details) != 0)
            echo "<br><br>" . "Details:   " . implode(' | ',$this->details);

        if($this->stackTrace != "")
            echo "<br><br>" . "Stack Trace:   " . $this->stackTrace;

        echo "<br><br>";
    }
}