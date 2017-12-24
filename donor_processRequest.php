<?php
require_once("Recipient.php");
require_once("Database.php");
require_once("Donor.php");
require_once("Request.php");
require_once("Item.php");

$request = unserialize(base64_decode($_POST["selectedObject"]));
$item = $request->item;
$requester = $request->user;

if(isset($_POST['accept']))
{
    $item->changeStatusTo(Item::ALLOWED_STATUSES[1]);
}
elseif (isset($_POST['reject']))
{
    $request->rejectRequest();
}
elseif (isset($_POST['report']))
{
    $requester->report();
}
elseif (isset($_POST['send']))
{
    $item->changeStatusTo(Item::ALLOWED_STATUSES[2]);
}