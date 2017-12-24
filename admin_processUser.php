<?php
require_once("Recipient.php");

$user = unserialize(base64_decode($_POST["selectedObject"]));

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