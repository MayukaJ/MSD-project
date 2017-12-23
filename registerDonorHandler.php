<?php
include_once 'Donor.php';

$uname =$_POST['username'];
$Name = $_POST['name'];
$mail = $_POST['email'];
$pwd = $_POST['psw'];
$num = $_POST['num'];
$repwd = $_POST['psw-repeat'];

$address = $_POST['address'];
$nic = $_POST['nic'];

if(user::validateuser($uname,$mail,$pwd,$repwd))
{
    $new_user = new Donor($uname,$Name,$pwd,$num,$mail,'ACTIVE', $address, $nic);
    $new_user->writetoUserDB();
    $new_user->writeToDonorAndUserDB();

}



