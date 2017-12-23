<?php
include_once "Database.php";
include_once "Donor.php";
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
    $flag = password_verify($pass,$db->results[0][1]);
    if ($flag==1){
        $db->select('user' , '*' , null , 'user_id =' . $uname1 );
        $ch=$db->results[0][7];
        if ($ch=="R"){
            header('Location: '.'recipientHome.php');
            $newuser = new Donor($db->results[0][0],$db->results[0][4],$db->results[0][7]);
        }elseif ($ch=="D"){
            header('Location: '.'donorHome.php');
        }
    }else{
        header('Location: '.'login.html');
    }


}


