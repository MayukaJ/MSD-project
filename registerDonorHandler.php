<?php
include_once 'donor.php';

$uname =$_POST['username'];
$Name = $_POST['name'];
$mail = $_POST['email'];
$pwd = $_POST['psw'];
$repwd = $_POST['psw-repeat'];

if(user::validateuser($uname,$mail,$pwd,$repwd)){
    $new_user = new Donor($uname);
    $new_user->addUser($uname,$Name,$pwd,$num,$mail);
    $new_user->changeType('donar',$uname,User::ALLOWED_TYPES[2]); // update the type in user table
}
?>