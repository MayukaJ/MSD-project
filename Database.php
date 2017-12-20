<?php
/**
 * Author: Abarajithan
 * Date: 12/19/2017
 * Time: 3:03 AM
 */


class Database
{
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

    function select($table, $cols = '*', $join = null, $where = null, $group = null, $order = null, $limit = null)
    {
        $q = 'SELECT '.$cols.' FROM '.$table;

        if($join != null)
        {
            $q .= ' JOIN '.$join;
        }
        if($where != null)
        {
            $q .= ' WHERE '.$where;
        }
        if($group != null)
        {
            $q .= ' GROUP BY '.$group;
        }
        if($order != null)
        {
            $q .= ' ORDER BY '.$order;
        }
        if($limit != null)
        {
            $q .= ' LIMIT '.$limit;
        }

        $this-> res = $this->conn->query($q);
        $this->makeArray();

    }

    function makeArray()
    {
        if(!$this->res) return;

        $this->numResults = mysqli_num_rows($this->res);
        $this->fields = $this->res->fetch_fields();               //Array of field objects.

        $this->res->data_seek(0);

        for($rowNum=0; $rowNum < $this->numResults; $rowNum++)
        {
            $row = mysqli_fetch_array($this->res,MYSQLI_NUM);
            $this->results[] = $row;
        }

        foreach ($this->fields as $field)
        {
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
        $testQ = "SELECT count(*) FROM information_schema.columns WHERE table_name = '" .$table. "'";
        $no_of_columns_in_table = mysqli_query($this->conn, $testQ)->fetch_array(MYSQLI_NUM)[0];
//        if($no_of_columns_in_table != count($values))
//        {
//            echo $no_of_columns_in_table;
//            echo "</br>";
//            echo count($values);
//            echo "No of columns dont match";
//            return false;
//        }

        $q = 'INSERT INTO '.$table.' VALUES (';

        foreach($values as $value)
        {
            if(is_array($value))
            {
                $value = implode(',', $value);
            }
            if(is_string($value) && $value != 'now()')
            {
                $value = "'". $value . "'";
            }
            if(is_null($value))
            {
                $value = 'null';
            }

            $q .= $value . ", ";
        }
        $q = substr($q, 0,-2);
        $q .= ")";

        return mysqli_query($this->conn, $q);

    }

    function update($table, $condition, $columns, $values)
    {
        if(count($columns) != count($values)) return false;

        $q = 'UPDATE '.$table.' SET ';

        for ($i=0; $i< count($columns); $i++)
        {
            $q .= $columns[$i] . " = '". $values[$i] . "', ";
        }
        $q = substr($q,0,-2);

        $q .= " WHERE " . $condition;
        $this-> res = $this->conn->query($q);

    }

    /**
     * makeTable creates a table using the column titles given as array and using the result obtained from select
     * query in THIS database object.
     * Returns false if column array length doesn't match results.
     * @param $columnTitles
     * @return bool
     */
    function makeTable($columnTitles)
    {
        if(count($columnTitles) != count($this->fieldNames))   //If number of columns doest match restults
        {
            return false;
        }

        echo "<table><tr>";                     //Start the table

        foreach ($columnTitles as $column)           //Add Column Titles
        {
            echo "<th>" . $column . "</th>";
        }

        echo "</tr>";                           //End the title row

        foreach ($this->results as $row)        //Adding rows one by one
        {
            echo "<tr>";
            foreach($row as $item)
            {
                echo "<td>" . $item . "</td>";
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
     */
    public static function uploadImage($finalDir, $name)
    {
        if (!empty($_FILES) && isset($_FILES['fileToUpload']))
        {
            $file = $_FILES['fileToUpload'];

            foreach($file as $key => $value) {
                echo "$key is at $value";
                echo "<br><br>";
            }

            //1. Validate file size. Maximum 2MB
            if($file['size'] > 2000000)
            {
                echo "File Bigger than 2 MB";
                return false;
            }
            //2. Validate File Type
            $fileType = explode("/", $file["type"])[0];
            if($fileType != "image")
            {
                echo "Not an Image but ".$fileType;
                return false;
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
                        $target = "item_images/".$name.".".pathinfo($target)["extension"];
                        rename($oldTarget, $target);

                        return $target;

                    } else {
                        echo "Error Uploading";
                        return false;
                    }
                    break;

            }

        }

    }
}