<?php

require_once("Recipient.php");

$user = unserialize(base64_decode($_POST["selectedObject"]));
$proofdoc = $user->getProofdoc();
$user_id = $user->getUserId();

echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Admin | View User Details</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/viewRequest.css\">
</head>
<body>
<form class='form'>
 ";

echo "<h3>User Details</h3>";
echo "User ID\t:\t" . $user->getUserId();
echo "<br>";
echo "Status\t:\t" . $user->getStatus();
echo "<br>";
echo "Date Created\t:\t" . $user->getDateCreated();
echo "<br>";
echo "Name\t:\t" . $user->getName();
echo "<br>";
echo "Address\t:\t" . $user->getAddress();
echo "<br>";
echo "Phone\t:\t" . $user->getPhone();
echo "<br>";
echo "Email\t:\t" . $user->getEmail();
echo "<br>";
echo "Type\t:\t" . $user->getType();
echo "<br>";
echo "NIC\t:\t" . $user->getNic();
echo "<br>";
echo "Age\t:\t" . $user->getAge();
echo "<br>";
echo "Occupation\t:\t" . $user->getOccupation();
echo "<br>";
echo "Place of Work\t:\t" . $user->getPlaceOfWork();
echo "<br>";
echo "Salary\t:\t" . $user->getSalary();
echo "<br>";
echo "Proof Documents\t:\t" . $user->getProofdoc();
echo "<br>";
echo "Summary\t:\t" . $user->getSummary();

echo "<br><br>";

echo "<td><form action = \"downloadFile.php" . " \" method = \"post\">";
echo "<input type=\"submit\" name=\"download\" value=\"Download file\">";
echo "<input type=\"hidden\" name=\"path\" value=\"$proofdoc\">";
echo "<input type=\"hidden\" name=\"fileName\" value=\"".basename($proofdoc)."\">";
echo "</td></form>";

echo "<br><br>";

if ($user->getStatus() != 'a')
{
    echo "<td><form action = \"admin_processUser.php" . " \" method = \"post\">";
    echo "<input type=\"submit\" name=\"accept\" value=\"Make User Active\">";
    echo "<input type=\"submit\" name=\"reject\" value=\"Reject and Delete User\">";
    echo "<input type=\"hidden\" name=\"selectedObject\" value=\"" . base64_encode(serialize($user)) . "\"/>";
    echo "</td></form>";
}
echo "</form>";