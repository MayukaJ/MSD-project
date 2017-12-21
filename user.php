<?php
include_once "Database.php";

class User{

    protected $user_id;
    protected $name;
    protected $pass;
    protected $phone;
    protected $email;
    protected $item;
    protected $status;
    protected $dateC;
    protected $type;
    protected $userType;
    //protected $photo;
    public const ALLOWED_TYPES = array("USER","REQUESTER","DONOR");
    public const ALLOWED_STATUSES = array("active","reported","awaiting");
    public const IMAGE_DIRECTORY ="user_images/";
    public const DOC_DIRECTORY ="user_docs/";
    public const MAX_VIEW = 10;




    public function fillUserDetails($id, $n, $pw, $p, $mail, $usertype, $status)
    {
        $this->userType = $usertype;
        $this->user_id=$id;
        $this->name=$n;
        $this->pass=password_hash($pw, PASSWORD_DEFAULT);
        $this->phone=$p;
        $this->email=$mail;
        $this->dateC=date("Y.m.d");
        $this->status = $status;
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
        $DB = new Database();
        $DB->insertInto('user',[$this->user_id,$this->pass,$this->status,'now()',$nme,$phn,$ml,$tp]);
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

}

?>