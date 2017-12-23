<?php
/**
 * Author: Abarajithan
 * Date: 12/19/2017
 * Time: 3:03 AM
 */

require_once("DatabaseException.php");
require_once("User.php");

class Database
{
   // public const $PROJECT_NAME = "MSD-project";


    public $conn;
    public $res;
    public $numResults;
    public $fields;
    public $fieldNames = array();
    public $results = array();

    private $host = "localhost";
    private $username = "root";
    private $pwd = "";
    private $dbname = "donatelk";


    //TABLES

    //ITEM  	item_id title   description     photo_path  donor_id    requestor_id    category    status  date_submitted
    //REQUEST   request_id	    requester_id	item_id


    //USER      user_id	        pwd	    status	date_created	name	address	phone	email	type	nic
    //USER_REQUESTER  user_id   age     occupation              place of work   salary  proofdoc    summary
    //DONOR     user_id	rating


    /**
     * Database constructor. It creates the connection
     */
    function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->pwd, $this->dbname);
    }

    function connect()
    {
        if ($this->conn->connect_errno)
        {
            die ("Failed to connect to MYSQL: (" . $this->conn->connect_errno. ")". $this->conn->connect_error);
            return false;
        }
        return true;
    }

    /**
     * @throws DatabaseException
     */
    function select($table, $cols = '*', $join = null, $where = null, $group = null, $order = null, $limit = null)
    {
        $q = 'SELECT ' . $cols . ' FROM ' . $table;

        if ($join != null) {
            $q .= ' JOIN ' . $join;
        }
        if ($where != null) {
            $q .= ' WHERE ' . $where;
        }
        if ($group != null) {
            $q .= ' GROUP BY ' . $group;
        }
        if ($order != null) {
            $q .= ' ORDER BY ' . $order;
        }
        if ($limit != null) {
            $q .= ' LIMIT ' . $limit;
        }

        $this->res = $this->conn->query($q);

        if (!$this->res) {
            $e = new DatabaseException(__METHOD__, "Invalid SELECT Query", $q);
            $e->echoDetails();
            throw $e;
        } else {
            $this->makeArray();
        }
    }

    /**
     * @throws DatabaseException
     */
    function makeArray()
    {
        $this->numResults = mysqli_num_rows($this->res);
        $this->fields = $this->res->fetch_fields();               //Array of field objects.

        $this->res->data_seek(0);

        for ($rowNum = 0; $rowNum < $this->numResults; $rowNum++) {
            $row = mysqli_fetch_array($this->res, MYSQLI_NUM);
            $this->results[] = $row;
        }

        foreach ($this->fields as $field) {
            $this->fieldNames[] = $field->name;
        }
    }

    /**
     * Creates insert into sql
     * String values are automatically wrapped in extra quotes
     * Null values are replaced by null
     * Array will be made into a comma seperated string
     * To send a timestamp, send now()
     * @param $table
     * @param $values
     * @return bool|mysqli_result
     */
    function insertInto($table, $values)
    {

        $testQ = "SELECT count(*) FROM information_schema.columns WHERE table_name = '$table' AND table_schema = '$this->dbname'";
        $no_of_columns_in_table = (string)mysqli_query($this->conn, $testQ)->fetch_array(MYSQLI_NUM)[0];

        if ($no_of_columns_in_table != count($values))
        {
            throw new DatabaseException(
                __METHOD__, "No. of columns don't match the number of values", [$no_of_columns_in_table, count($values)], $testQ, ""
            );
        }

        $q = 'INSERT INTO ' . $table . ' VALUES (';

        foreach ($values as $value) {
            if (is_array($value)) {
                $value = implode(',', $value);
            }
            if (is_string($value) && $value != 'now()') {
                $value = "'" . $value . "'";
            }
            if (is_null($value)) {
                $value = 'null';
            }

            $q .= $value . ", ";
        }
        $q = substr($q, 0, -2);
        $q .= ")";

        if(!mysqli_query($this->conn, $q))
        {
            throw new DatabaseException(__METHOD__, "Invalid INSERT INTO query", $q);
        }
    }


    /**
     * @param $table
     * @param $condition
     * @param $columns
     * @param $values
     * @throws DatabaseException
     */
    function update($table, $condition, $columns, $values)
    {

        if (count($columns) != count($values))
            throw new DatabaseException(
                __METHOD__, "Number of columns array don't match the number of values", [count($columns), count($values)], '', ''

            );

        $q = 'UPDATE ' . $table . ' SET ';

        for ($i = 0; $i < count($columns); $i++) {
            $q .= $columns[$i] . " = '" . $values[$i] . "', ";
        }
        $q = substr($q, 0, -2);

        $q .= " WHERE " . $condition;

        $this->res = $this->conn->query($q);

        if(! $this->res)
            throw new DatabaseException(
                __METHOD__, "Invalid UPDATE query", $q, ""
            );

    }

    function delete($table, $condition)
    {
        $q = 'DELETE FROM ' . $table;
        $q .= " WHERE " . $condition;

        $this->res = $this->conn->query($q);

        if(! $this->res)
            throw new DatabaseException(
                __METHOD__, "Invalid DELETE query", $q, ""
            );
    }



    /**
     * makeTable creates a table using the column titles given as array and using the result obtained from select
     * query in THIS database object.
     * Returns false if column array length doesn't match results.
     * @param $columnTitles
     * @param array $skipCols
     * @param null $whoObject
     * @param array $objectArray
     * @param bool $isButton
     * @param string $buttonName
     * @param string $buttonTitle
     * @param string $actionpath
     * @return bool
     * @throws DatabaseException
     */
    function makeTable($columnTitles, $skipCols = [], $whoObject = null, $objectArray = [], bool $isButton = false, $buttonName = "submit", string $buttonTitle = "", string $actionpath = "")
    {
        $noColsGiven = count($columnTitles);
        $noColsInResult = count($this->fieldNames);
        $noColsToSkip = count($skipCols);

        if($isButton)
            $isValid = $noColsGiven != ($noColsInResult -$noColsToSkip + 1);
        else
            $isValid = $noColsGiven != ($noColsInResult -$noColsToSkip);

        if($isValid)   //If number of columns doest match results
        {
            throw new DatabaseException(
                __METHOD__, "Number of columns in table doesn't match data obtained from database",
                [$noColsGiven, $noColsInResult, $noColsToSkip],
                "", ""
            );
        }

        echo "<table><tr>";                     //Start the table
        foreach ($columnTitles as $column)           //Add Column Titles
        {
            echo "<th>" . $column . "</th>";
        }
        echo "</tr>";                           //End the title row

        for ($rowNum = 0; $rowNum< count($this->results); $rowNum++)        //Adding rows one by one
        {
            echo "<tr>";
            for($colNum = 0; $colNum < count($this->results[$rowNum]) ; $colNum++)
            {
                if(in_array($colNum, $skipCols)) continue;
                echo "<td>" . $this->results[$rowNum][$colNum] . "</td>";
            }
            if($isButton)
            {
                echo "<td><form action = \" " . $actionpath . " \" method = \"post\">";
                echo "<input type=\"submit\" name=\"" . $buttonName ."\" value=\"" . $buttonTitle . "\">";
                echo "<input type=\"hidden\" name=\"whoObject\" value=\"" . base64_encode(serialize($whoObject)) . "\"/>";
                echo "<input type=\"hidden\" name=\"selectedObject\" value=\"" . base64_encode(serialize($objectArray[$rowNum])) . "\"/>";
                echo "</td></form>";



            }

            echo "</tr>";
        }
        echo "</table>";
        return true;
    }

    public static function makeQueryForViewItems($category, $keywordString)
    {
        $keywordString = str_replace(' ', ',', $keywordString);
        $neededKeywordList = explode(',', $keywordString);

        $query = "status = 'advertised' AND category = '".$category."'";
        if(count($neededKeywordList))
        {
            $query .= " AND";
            $query .= " (";
            foreach ($neededKeywordList as $k)
            {
                $query .= "title LIKE '%" . $k . "%' OR ";
            }
            $query = substr($query, 0, -4);
            $query .= " )";
        }
        return $query;
    }

    /**
     * Uploads an image from global variable FILES and returns either false or the path
     * @param $finalDir
     * @param $name
     * @return bool|string
     * @throws DatabaseException
     */
    public static function uploadImage($finalDir, $name, $isImage = false)
    {
        if (!empty($_FILES) && isset($_FILES['fileToUpload']))
        {
            $file = $_FILES['fileToUpload'];

            $contents_of_file_array = "File Array Contains: ".urldecode(http_build_query($file,'',', '));

            //1. Validate file size. Maximum 2MB
            if($file['size'] > 2000000)
            {
                throw new DatabaseException(
                    __METHOD__, "Sorry. Your file is bigger than 2 MB", [$file['size'], $contents_of_file_array], '', ''
                );
            }

            //2. Validate File Type
            $fileType = explode("/", $file["type"])[0];
            if($isImage && ($fileType != "image"))
            {
                throw new DatabaseException(
                    __METHOD__, "Sorry. Your file is not an image.", [$fileType, $contents_of_file_array], '', ''
                );
            }

            switch ($file["error"])
            {
                case UPLOAD_ERR_OK:

                    $target = $finalDir;
                    $target = $target . basename($file['name']);

                    if (move_uploaded_file($file['tmp_name'], $target))
                    {
                        //echo $target;
                        echo "<br><br>";
                        $oldTarget = $target;
                        $target = $finalDir.$name.".".pathinfo($target)["extension"];
                        rename($oldTarget, $target);

                        return $target;
                    }
                    else
                    {
                        throw new DatabaseException(
                            __METHOD__, "Error Uploading. Cannot move the temp file.", [$file['tmp_name'], $target, $contents_of_file_array], '', ''
                        );
                    }
                    break;
                default:
                    throw new DatabaseException(
                        __METHOD__, "Error uploading. Error parameter is not OK", [$file["error"], $contents_of_file_array], '', ''
                    );
            }
        }
    }


    public function insertInto_user(string $user_id, string $pwd, string $status, string $date_created, string $name, string $address, string $phone, string $email, string $type, string $nic)
    {

        try {
            if (!in_array($type, user::ALLOWED_TYPES))
                throw new DatabaseException(__METHOD__, "The user type you entered must be a member of array ALLOWED_TYPES of user class",
                    [$type, implode(" , ", user::ALLOWED_TYPES)]);

            if (!in_array($status, user::ALLOWED_STATUSES))
                throw new DatabaseException(__METHOD__, "The user status you entered must be a member of array ALLOWED_STATUSES of user class",
                    [$status, implode(" , ", user::ALLOWED_STATUSES)]);

            $this->insertInto("user", [$user_id,$pwd,$status,$date_created,$name,$address,$phone,$email, $type, $nic]);
        } catch (DatabaseException $e)
        {
            $e->echoDetails();
        }

    }
}