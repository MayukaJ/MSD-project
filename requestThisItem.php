<?php

require_once "Database.php";
require_once "Request.php";
require_once "Recipient.php";
require_once "Item.php";


session_start();

$user = $_SESSION['user'];
$item = unserialize(base64_decode($_POST["selectedObject"]));


$user_id = $user->getUserId();
$item_id = $item->getItemId();
$itemTitle = $item->getTitle();

$db = new Database();
$db->select("request", "COUNT(request_id)", null, "user_id = '$user_id'");
$no_of_items = $db-> results[0][0];

$db2 = new Database();
$db2->select("request", "COUNT(request_id)", null, "user_id = '$user_id' AND item_id = '$item_id'");
$sameSelected = $db2->results[0][0];


if($no_of_items > Request::MAX_NO_OF_ITEMS_PER_RECIPIENT)
{
    echo "You have requested maximum number of items. You cannot request more at the moment.";
}
elseif ($sameSelected)
{
    echo "You have already requested this item.";
}
else
{
    $request = new Request($item, $user);
    $request->addToDB();
    echo "You have now requested the item: $itemTitle";
}
