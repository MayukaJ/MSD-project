<?php
/**
 * Created by PhpStorm.
 * User: Chinthana
 * Date: 19-Dec-17
 * Time: 3:46 PM
 */

require_once("Database.php");
require_once("Item.php");
require_once("Donor.php");

session_start();
$donor = $_SESSION['user'];
$donor_id = $donor->getUserId();

$db = new Database();
$item = new item();

echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Item status</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/messegeBox.css\">
</head>
<body>
<form class='form'>
<h3>
";


echo $_POST["category"];

if($_POST["category"] != null && $item->makeFromForm($_POST["title"], $_POST["description"], "$donor_id", $_POST["category"]))
{
    echo "Item successfully added";
}
echo "</h3>
<a href=\"donorHome.php\" class=\"btn\">Go Back</a>
</form>
</body></html>
";
