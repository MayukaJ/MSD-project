<?php
include_once "Database.php";

$db = new Database();
$user = $_POST["un"];
$pass = $_POST["pw"];

$uname1 = "'".$user."'";
$db->select('user' , '*' , null , 'user_id =' . $uname1 );
if (count($db->results)==0){
    echo "no user in the given user name";
    return false;
}
else{
    $db->select('user' , '*' , null , 'user_id =' . $uname1 );
    echo $db->results[0][1];

}


