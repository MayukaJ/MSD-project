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
    $flag = password_verify($pass,$db->results[0][1]);
    if ($flag==1){
        $db->select('user' , '*' , null , 'user_id =' . $uname1 );
        $ch=$db->results[0][7];
        if ($ch=="R"){
            header('Location: '.'recipientHome.php');
        }elseif ($ch=="D"){
            header('Location: '.'donorHome.php');
        }
        echo "login successfull";
    }else{
        header('Location: '.'login.html');
    }


}


