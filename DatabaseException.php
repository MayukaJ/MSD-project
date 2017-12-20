<?php
/**
 * Created by PhpStorm.
 * User: Aba
 * Date: 12/20/2017
 * Time: 1:19 AM
 */

class DatabaseException extends Exception
{
    public $message = "";
    public $query = "";
    public $stackTrace = "";
    public $details = array();
    public $functionName = "";

    public function __construct($functionName, string $message = "", $details = [], $query = "", $stackTrace = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        if(func_num_args() == 1)
        {
            $e = @func_get_arg(1);
            if(is_a($e,"Exception"))
            {
                $this->message = "Exception (code " . $e->getCode(). ") thrown in select function.";
                $this->stackTrace = $e->getTraceAsString();
            }
        }

        $this->functionName = $functionName;
        $this->details = $details;
        $this->message=$message;
        $this->query=$query;
        $this->stackTrace=$stackTrace;
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

        if($this->query != "")
            echo "<br><br>" . "Query:   " . $this->query;

        if($this->stackTrace != "")
            echo "<br><br>" . "Stack Trace:   " . $this->stackTrace;

        if(count($this->details) != 0)
            echo "<br><br>" . "Details:   " . implode(' | ',$this->details);

        echo "<br><br>";
    }

    /** If the given exception is a databaseException, it throws it back. If not, it wraps it as a database Exception
     * and throw it.
     * @param Exception $e
     * @throws DatabaseException
     * @throws Exception
     */
    public static function reThrow(Exception $e)
    {
        if(is_a($e, 'DatabaseException'))
            throw $e;
        else
            throw new DatabaseException($e);
    }
}