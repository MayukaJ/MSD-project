<?php
require_once "Database.php";
require_once "Donor.php";
require_once "Recipient.php";

$db = new Database();
$user_id = $_POST["un"];
$pwd = $_POST["pw"];


$db->select('user' , 'pwd, type' , null , "user_id = '$user_id'" );

if ($db->numResults == 0)
{
    echo "User doesn't exist";
    //header('Location: '.'admin_processUser.php');
}

elseif (!password_verify($pwd, $db->results[0][0]))
{
    echo "Username and Password don't match";
}
else
{
    $type = $db->results[0][1];
    session_start();

    if ($type==User::ALLOWED_TYPES[1])              //Receiptient
    {
        $user = Recipient::readRecipient($user_id);

        $_SESSION['user'] = $user;
        $_SESSION['type'] = $type;

        header('Location: '.'recipientHome.php');
    }
    elseif ($type==User::ALLOWED_TYPES[2])             //Donor
    {
        $user = Donor::readDonor($user_id);

        $_SESSION['user'] = $user;
        $_SESSION['type'] = $type;

        header('Location: '.'donorHome.php');
    }
}






//$db->select('user' , 'pwd' , null , "user_id = '$user_id'" );
//$flag = password_verify($pwd,$db->results[0][0]);
//if ($flag==1)
//{
//    $db->select('user' , '*' , null , 'user_id =' . $uname1 );
//    $ch=$db->results[0][7];
//    if ($ch=="R")
//    {
//        header('Location: '.'recipientHome.php');
//        $newuser = new Donor($db->results[0][0],$db->results[0][4],$db->results[0][7]);
//    }elseif ($ch=="D"){
//        header('Location: '.'donorHome.php');
//    }
//}else{
//    header('Location: '.'login.html');
//}

