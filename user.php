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

    public static function validateuser($uname,$mail,$pwd,$repwd){
        $db = new Database();
        if($pwd!=$repwd){
            echo "passwords doesnt match";
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
                    return true;
                }
            }
        }
    }

    public function deleteUser()
    {
        $db = new Database();
        $db->delete('user', "user_id = '$this->user_id'");
        $db->delete('donor', "user_id = '$this->user_id'");
        $db->delete('user_requester', "user_id = '$this->user_id'");
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