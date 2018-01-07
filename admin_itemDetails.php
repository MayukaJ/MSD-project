<?php

require_once("Recipient.php");
require_once("Database.php");
require_once("Donor.php");
require_once("Request.php");
require_once("Item.php");
User::checkLogin('a');

@session_start();
$user = $_SESSION['user'];

$itemRequest = unserialize(base64_decode($_POST["selectedObject"]));
$item = $itemRequest[0];
$request_id = $itemRequest[1];


echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Admin | View Item Details</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/viewRequest.css\">
</head>
<body>
<td><form class='form' action = \"admin_processItemRequest.php\"  method = \"post\">";

echo "<h3>Item Details</h3>";

echo "Request ID\t:\t" . $request_id;
echo "<br>";
echo "Item ID\t:\t" . $item->getItemId();
echo "<br>";
echo "Item Title\t:\t" . $item->getTitle();
echo "<br>";
echo "Item Description\t:\t" . $item->getDescription();
echo "<br>";
echo "Item Category\t:\t" . $item->getCategory();
echo "<br>";
echo "Item Status\t:\t" . $item->getStatus();
echo "<br>";
echo "Date Item Submitted\t:\t" . $item->getDateSubmitted();
echo "<br>";
echo "Requester's ID\t:\t" . $item->getRequesterId();
echo "<br>";
echo "<br>";

$disabled = " disabled";
if($item->getStatus() == Item::ALLOWED_STATUSES[2] || $item->getStatus() == Item::ALLOWED_STATUSES[3])
    $disabled = '';


echo "<tr><input type=\"submit\" name=\"received\" value=\"Mark Received by Admin\" $disabled></tr><tr>";
echo "<input type=\"submit\" name=\"sent\" value=\"Mark Sent by Admin\" $disabled>";
echo "<input type=\"hidden\" name=\"selectedObject\" value=\"" . base64_encode(serialize($item)) . "\"/>";
echo "</tr></form>";