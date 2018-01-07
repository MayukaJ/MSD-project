<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request new Item</title>
    <link rel="stylesheet" type="text/css" href="css/requestItem.css">
</head>
<body>
<form class="topnav" action = "requestItem.php" method = "get" >
    <table>
        <tr><td>
    <h2>What do you want?</h2>
            </td><td>
    <select name = "category" id="selectedCategory">
        <option value="null">Select Category...</option>
        <option value="clothes">Clothes</option>
        <option value="books">Books/Educational</option>
        <option value="shoes">Shoes</option>
        <option value="sports">Sports Equipment</option>
        <option value="electronic">Electronic appliances</option>
        <option value="music">Musical/Aesthetic Equipment</option>
        <option value="furniture">Furniture items</option>
    </select>
    <input type="text" placeholder="Enter keywords" name="keywordString">
    <input type="submit" name="search" value="Search">
            </td>
            <td><input type="submit" name="logout" value="Log Out"></td>
        </tr>
    </table>


<?php

require_once ('Item.php');
require_once ('Database.php');
User::checkLogin('r');

$requested = false;
$category = "";
$db = new Database();

if(isset($_GET["category"]) && $_GET["category"]!= "null")
{
    $category = $_GET['category'];
    $keywordString = $_GET['keywordString'];

    $itemList = Item::returnAvailItems($category, $keywordString, $db);


    echo "<h4 align='center'>Following items are available in :\t" . ucwords($category ). "</h4>";

    echo "</form></div><br>";

    try
    {
        $db->makeTable(
        ['Item ID', 'Title', 'Description', 'Picture', 'Donor', 'Category', 'Date', 'Request'], [5, 7], null,
        $itemList, true, 'request', "Request", "requestThisItem.php"
    );
    } catch (DatabaseException $e) {
        $e->echoDetails();
    }

}
elseif (isset($_GET["logout"]))
{
    User::logout();
}
else
    echo "</form></div>";

echo "</body></html>";


?>