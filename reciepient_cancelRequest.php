<?php

require_once "Request.php";
require_once "Database.php";
require_once "Item.php";
User::checkLogin('r');

$request = unserialize(base64_decode($_POST["selectedObject"]));

$status = $request->item->getStatus();

$request_id = $request->getRequestId();

echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Status</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/messegeBox.css\">
</head>
<body>
<form class='form'><h3>
 ";

if($status == 'advertised')
{
    $db = new Database();
    $db->delete('request', "request_id = '$request_id'");
    echo "Request has been cancelled";
}
else
{
    echo "Request has been accepted by donor. Accepted requests cannot be cancelled";
}

echo "</h3>
<a href=\"recipientHome.php\" class=\"btn\">Go Back</a>
</form></body></html>
";