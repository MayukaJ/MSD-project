<?php
include_once 'Donor.php';
User::checkLogin('n');

$dbCheck = new Database();
$connection = $dbCheck->conn;

$user_id =mysqli_real_escape_string($connection,$_POST['user_id']);
$pwd = mysqli_real_escape_string($connection,$_POST['pwd']);
$repeat_pwd = mysqli_real_escape_string($connection,$_POST['repeat_pwd']);
$name = mysqli_real_escape_string($connection,$_POST['name']);
$address = mysqli_real_escape_string($connection,$_POST['address']);
$phone = mysqli_real_escape_string($connection,$_POST['phone']);
$email = mysqli_real_escape_string($connection,$_POST['email']);
$nic = mysqli_real_escape_string($connection,$_POST['nic']);


$status = User::ALLOWED_STATUSES[0]; //ACTIVE

if(user::validateuser($user_id,$email,$pwd,$repeat_pwd,$phone,$nic))
{
    $user = new Donor($user_id, $pwd, $status, 'now()', $name, $address, $phone, $email, $nic, 0);
    $user->writeToDonorAndUserDB();
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
        <a href=\"donorHome.php\" class=\"btn\">Go Back</a>
        </form></body></html>
        ";
}else{
            echo "
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <title>Error !</title>
            <link rel=\"stylesheet\" type=\"text/css\" href=\"css/messegeBox.css\">
        </head>
        <body>
        <form class='form'>
        <h3>Problem with the Registration from , please fill again with valid details .!</h3>
        <a href=\"registerdonor.php\" class=\"btn\">Go Back</a>
        </form></body></html>
        ";
}



