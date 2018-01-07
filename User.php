<?php
include_once "Database.php";

class User{

    protected $user_id;
    protected $pwd;
    protected $status;
    protected $date_created;
    protected $name;
    protected $address;
    protected $phone;
    protected $email;
    protected $type;
    protected $nic;

    protected $item;


    public const ALLOWED_TYPES = array("U","R","D", "A");
    public const ALLOWED_STATUSES = array("a","r","w"); //ACTIVE, REPORTED, WAITING
    public const IMAGE_DIRECTORY ="user_images/";
    public const DOC_DIRECTORY ="user_proofdocs/";
    public const MAX_NO_VIEW = 10;

    public function fillUserDetails($user_id, $pwd, $status, $date_created, $name, $address, $phone, $email, $type, $nic)

    {
        $this->type = $type;
        $this->user_id=$user_id;
        $this->name=$name;
        $this->pwd=password_hash($pwd, PASSWORD_DEFAULT);
        $this->phone=$phone;
        $this->email=$email;
        $this->date_created=$date_created;
        $this->status = $status;
        $this->address = $address;
        $this->nic = $nic;
    }

    public function writeAdditional(){
        //overriden
    }

    //change
    public function changeType($table,$uname,$type){
        $DB = new Database();
        $uname1 = "'".$uname."'";

        $DB->update($table,'user_id ='.$uname1,['type'],[$type]);

    }

    public function writetoUserDB()
    {
        try {
            $DB = new Database();
            $DB->insertInto('user', [$this->user_id, $this->pwd, $this->status, 'now()', $this->name, $this->address, $this->phone, $this->email, $this->type, $this->nic]);
            //                              user_id	         pwd	    status	  date_created	name	address	            phone	    email	    type	        nic
        } catch (DatabaseException $e) {
            $e->echoDetails();
        }

    }

    public static function validateuser($uname,$mail,$pwd,$repwd,$phoneNum,$NIC){
        $db = new Database();
        if($pwd!=$repwd){
            //echo "passwords doesnt match";
            return false;
        }else {
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                echo "mail error";
                return false;
            }else{
                $uname1 = "'".$uname."'";
                $db->select('user' , '*' , null , 'user_id =' . $uname1 );
                if (count($db->results)!=0){
                    echo "user already taken";
                    return false;
                }
                else{
                    if ((strlen($phoneNum)!=10) or !is_numeric($phoneNum)){
                        echo "wrong type of phone number";
                        return false;
                    }else{
                        if ((strlen($NIC)!=10) or !(substr($NIC, -1)=='V' or substr($NIC, -1)=='v') or !(is_numeric(substr($NIC, 0,-1)))){
                            echo "wrong type of NIC";
                        return false;
                        }else{
                            return true;
                        }
                    }

                }
            }
        }
    }

    public static function readUser($user_id)
    {
        $db = new Database();
        try
        {

            $db->select('user', '*', null,
                "user.user_id = '$user_id'");

            $row = $db->results[0];
            $user = new User();

            $user->fillUserDetails($row[0], $row[1], $row[2],$row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
            return $user;

        }
        catch (DatabaseException $e)
        {
            $e->echoDetails();
        }
        catch (Exception $e)
        {
            echo "Exception in method ". __METHOD__;
        }

    }

    public function deleteUser()
    {
        $db = new Database();
        $db->delete('user', "user_id = '$this->user_id'");
        $db->delete('donor', "user_id = '$this->user_id'");
        $db->delete('user_requester', "user_id = '$this->user_id'");
    }

    public static function logout()
    {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        session_unset();
        Database::messageBox("You have logged out", "Go to home", "index.php");
    }

    public static function checkLogin($pageType) //Pagetype = r,d,a,n
    {
        include_once 'Recipient.php';
        include_once 'Donor.php';
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        $type = "n";

        if(isset($_SESSION["user"]))
        {
            $user = $_SESSION["user"];
            try
            {
                $type = strtolower($user->type);
            }
            catch (Exception $e)
            {}
        }

        if ($type == $pageType)
            return;
        elseif($type == 'a')
            header("Location:admin_Home.php");
        elseif($type == 'd')
            header("Location:donorHome.php");
        elseif($type == 'r')
            header("Location:recipientHome.php");
        elseif($type == 'n')
            header("Location:index.php");


    }


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getNic()
    {
        return $this->nic;
    }

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->item;
    }



}