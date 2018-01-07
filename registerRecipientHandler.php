<?php
include_once 'Recipient.php';
require_once 'Database.php';
User::checkLogin('n');

$dbCheck = new Database();
$connection = $dbCheck->conn;

$user_id =mysqli_real_escape_string($connection,$_POST['user_id']);
$pwd = mysqli_real_escape_string($connection,$_POST['pwd']);
$repeat_pwd = mysqli_real_escape_string($connection,$_POST['repeat_pwd']);
$status = user::ALLOWED_STATUSES[2]; //w

$name = mysqli_real_escape_string($connection,$_POST['name']);
$address = mysqli_real_escape_string($connection,$_POST['address']);
$phone = mysqli_real_escape_string($connection,$_POST['phone']);
$email = mysqli_real_escape_string($connection,$_POST['email']);
$type = user::ALLOWED_TYPES[1];
$nic = mysqli_real_escape_string($connection,$_POST['nic']);

$Age = mysqli_real_escape_string($connection,$_POST['age']);
$occupation = mysqli_real_escape_string($connection,$_POST['occupation']);
$place_of_work = mysqli_real_escape_string($connection,$_POST['place_of_work']);
$salary = mysqli_real_escape_string($connection,$_POST['salary']);
$summary = mysqli_real_escape_string($connection,$_POST['summary']);

if(user::validateuser($user_id,$email,$pwd,$repeat_pwd,$phone,$nic))
{
    $proofdoc = Recipient::uploadRecipientFile($user_id,false);

    $new_user = new Recipient($user_id, $pwd, $status, 'now()' , $name, $address , $phone, $email, $nic, $Age, $occupation, $place_of_work, $salary, $proofdoc, $summary);
    $new_user->writeToReceiverAndUserDB();

    echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Request status</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/messegeBox.css\">
</head>
<body>
<form class='form'>
<h3>Register Success. Wait for confirmation </h3>
<a href=\"index.php\" class=\"btn\">Go Back</a>
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

