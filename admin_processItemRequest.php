<?php
require_once("Recipient.php");
require_once("Database.php");
require_once("Donor.php");
require_once("Request.php");
require_once("Item.php");


if(isset($_POST["selectedObject"])) {

    $item = unserialize(base64_decode($_POST["selectedObject"]));


    if (isset($_POST['received']))
        $item->changeStatusTo(Item::ALLOWED_STATUSES[3]);
    elseif (isset($_POST['sent']))
        $item->changeStatusTo(Item::ALLOWED_STATUSES[4]);
}
