<?php

require_once("Recipient.php");
require_once("Database.php");
require_once("Donor.php");
require_once("Request.php");
require_once("Item.php");
User::checkLogin('d');

@session_start();
$user = $_SESSION['user'];

$request = unserialize(base64_decode($_POST["selectedObject"]));

$item = $request->item;
$requester = $request->user;

echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Donor | View Item Request</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/viewRequest.css\">
</head>
<body>
<td><form class='form' action = \"donor_processRequest.php\"  method = \"post\">";

echo "<h3>Request Details</h3>";

echo "Request ID\t:\t" . $request->getRequestId();
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

echo "<h3>Requester Details</h3>";

echo "Requester's ID\t:\t" . $requester->getUserId();
echo "<br>";
echo "Verified Summary\t:\t" . $requester->getSummary();
echo "<br>";
echo "<br>";


echo "<input type=\"submit\" name=\"accept\" value=\"Accept Request\" >";
echo "<input type=\"submit\" name=\"reject\" value=\"Reject Request\">";
echo "<input type=\"submit\" name=\"report\" value=\"Report Requester\">";
echo "<input type=\"submit\" name=\"send\" value=\"Mark Item as Sent\">";
echo "<input type=\"hidden\" name=\"selectedObject\" value=\"" . base64_encode(serialize($request)) . "\"/>";
echo "</td></form>";