<?php

require_once "Request.php";
require_once "Database.php";
require_once "Item.php";

$request = unserialize(base64_decode($_POST["selectedObject"]));

$status = $request->item->getStatus();

$request_id = $request->getRequestId();


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