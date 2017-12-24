<?php
include_once 'Donor.php';

$user_id =$_POST['user_id'];
$pwd = $_POST['pwd'];
$repeat_pwd = $_POST['repeat_pwd'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$nic = $_POST['nic'];

$status = User::ALLOWED_STATUSES[0]; //ACTIVE

if(user::validateuser($user_id,$email,$pwd,$repeat_pwd))
{
    $user = new Donor($user_id, $pwd, $status, 'now()', $name, $address, $phone, $email, $nic, 0);
    $user->writeToDonorAndUserDB();
}



echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Request status</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/messegeBox.css\">
</head>
<body>
<form class='form'>
<h3>Register Success</h3>
<a href=\"index.html\" class=\"btn\">Go Back</a>
</form></body></html>
";