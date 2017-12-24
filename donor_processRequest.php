<?php
require_once("Recipient.php");
require_once("Database.php");
require_once("Donor.php");
require_once("Request.php");
require_once("Item.php");


if(isset($_POST['remove']))
{
    $item = unserialize(base64_decode($_POST["selectedObject"]));
    $item->removeItem();
}
else{
    $request = unserialize(base64_decode($_POST["selectedObject"]));
    $item = $request->item;
    $requester = $request->user;

    if(isset($_POST['accept']))
    {
        $item->changeStatusTo(Item::ALLOWED_STATUSES[1], $requester->getUserId());
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


    elseif (isset($_POST['receive']))
    {
        $item->changeStatusTo(Item::ALLOWED_STATUSES[3]);
    }
    elseif (isset($_POST['sent']))
    {
        $item->changeStatusTo(Item::ALLOWED_STATUSES[4]);
    }
}