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
    echo "
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Username does not exist</title>
                    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/messegeBox.css\">
                     
                </head>
                <body>
                <form class='form'>";
    echo "<form class='form'><h4>Username does not exist</h4><br><a href=\"index.php\" class=\"btn\">Go Back</a>
            </form></body></html>";
}

elseif (!password_verify($pwd, $db->results[0][0]))
{
    echo "
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Password Mismatch</title>
                    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/messegeBox.css\">
                     
                </head>
                <body>
                <form class='form'>";
    echo "<form class='form'><h4>Your username and password don't match.</h4><br><a href=\"index.php\" class=\"btn\">Go Back</a>
            </form></body></html>";
}
else
{
    $type = $db->results[0][1];
    session_start();

    if ($type==User::ALLOWED_TYPES[1])              //Receiptient
    {
        $db = new Database();
        $db->select('user' , 'status' , null , "user_id = '$user_id'" );

        if($db->results[0][0] == "a") {
            $user = Recipient::readRecipient($user_id);

            $_SESSION['user'] = $user;
            $_SESSION['type'] = $type;

            header('Location: ' . 'recipientHome.php');
        }
        else
        {
            echo "
                <html lang=\"en\">
                <head>
                    <meta charset=\"UTF-8\">
                    <title>Account Not Active</title>
                    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/messegeBox.css\">
                     
                </head>
                <body>
                <form class='form'>";
            echo "<form class='form'><h4>Your account is not active. Please contact an administrator.</h4><br><a href=\"index.php\" class=\"btn\">Go Back</a>
            </form></body></html>";
        }
    }
    elseif ($type==User::ALLOWED_TYPES[2])             //Donor
    {
        $user = Donor::readDonor($user_id);

        $_SESSION['user'] = $user;
        $_SESSION['type'] = $type;

        header('Location: '.'donorHome.php');
    }
    elseif ($type==User::ALLOWED_TYPES[3])             //Admin
    {
        $user = User::readUser($user_id);
        $_SESSION['user'] = $user;
        $_SESSION['type'] = $type;

        header('Location: '.'admin_Home.php');
    }
}
