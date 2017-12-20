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
    //protected $photo;
    const ALLOWED_TYPES = array("USER","REQUESTER","DONOR");
    const IMAGE_DIRECTORY ="user_images/";


    public function addUser($id,$n,$pw,$p,$mail,$usertype)
    {
        $this->user_id=$id;
        $this->name=$n;
        $this->pass=password_hash($pw, PASSWORD_DEFAULT);
        $this->phone=$p;
        $this->email=$mail;
        $this->dateC=date("Y.m.d");
        $this->type= User::ALLOWED_TYPES[0];
        $this->status="0";
        //$this->photo=$pic;
        $this->writetoDB('user',$this->user_id,$this->pass,$this->status,$this->dateC,$this->name,$this->phone,$this->email,$usertype);
        //$this->writeAdditional();
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

    public function writetoDB($table,$id,$pw,$st,$dt,$nme,$phn,$ml,$tp){
        $DB = new Database();
        $DB->insertInto($table,[$id,$pw,$st,$dt,$nme,$phn,$ml,$tp]);
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