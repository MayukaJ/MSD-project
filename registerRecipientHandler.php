<?php
include_once 'Recipient.php';
require_once 'Database.php';

$user_id =$_POST['user_id'];
$pwd = $_POST['pwd'];
$repeat_pwd = $_POST['repeat_pwd'];
$status = user::ALLOWED_STATUSES[2]; //w

$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$type = user::ALLOWED_TYPES[1];
$nic = $_POST['nic'];

$Age = $_POST['age'];
$occupation = $_POST['occupation'];
$place_of_work = $_POST['place_of_work'];
$salary = $_POST['salary'];
$summary = $_POST['summary'];

if(user::validateuser($user_id,$email,$pwd,$repeat_pwd))
{
    $proofdoc = Recipient::uploadRecipientFile($user_id,false);

    $new_user = new Recipient($user_id, $pwd, $status, 'now()' , $name, $address , $phone, $email, $nic, $Age, $occupation, $place_of_work, $salary, $proofdoc, $summary);
    $new_user->writeToReceiverAndUserDB();

}