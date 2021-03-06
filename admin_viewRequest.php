<?php

require_once("Recipient.php");
require_once("Database.php");
require_once("Donor.php");
require_once("Request.php");
require_once("Item.php");

session_start();
User::checkLogin('a');
$request = unserialize(base64_decode($_POST["selectedObject"]));

$item = $request->item;
$requester = $request->user;

echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Admin | View Item Request</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/viewRequest.css\">
</head>
<body>
<form class='form'>
 ";

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

echo "<td><form action = \"donor_processRequest.php" . " \" method = \"post\">";
echo "<input type=\"submit\" name=\"received\" value=\"Mark as Received\">";
echo "<input type=\"submit\" name=\"sent\" value=\"Mark as Sent\">";
echo "<input type=\"hidden\" name=\"selectedObject\" value=\"" . base64_encode(serialize($request)) . "\"/>";
echo "</td></form>";