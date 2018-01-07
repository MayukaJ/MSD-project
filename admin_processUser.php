<?php
require_once("Recipient.php");
User::checkLogin('a');

$user = unserialize(base64_decode($_POST["selectedObject"]));

echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Statuss</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/messegeBox.css\">
</head>
<body>
<form class='form'><h3>
 ";

if(isset($_POST['accept']))
{
    $user->changeStatusTo(Recipient::ALLOWED_STATUSES[0]);
    echo "User status changed";
}
elseif (isset($_POST['reject']))
{
    $user->deleteUser();
    echo "User Deleted";
}

echo "</h3>
<a href=\"admin_Home.php\" class=\"btn\">Go Back</a>
</form></body></html>
";