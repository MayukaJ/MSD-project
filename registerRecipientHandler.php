<?php
include_once 'recipient.php';

$uname =$_POST['username'];
$Name = $_POST['name'];
$Age = $_POST['age'];
$Occ = $_POST['occupation'];
$POW = $_POST['pow'];
$mail = $_POST['email'];
$num = $_POST['contactno'];
$pwd = $_POST['psw'];
$repwd = $_POST['psw-repeat'];
$proof = $_POST['proofdoc'];

if(user::validateuser($uname,$mail,$pwd,$repwd)){
    $new_user = new Recipient($uname,$Name,$pwd,$num,$mail,$Age,$Occ,$POW,$proof);
    //$new_user->changeType('donar',$uname,User::ALLOWED_TYPES[1]); // update the type in user table
}
?>