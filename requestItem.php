<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request new Item</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<header>
<h3>What do you want?</h3>
</header>
<select id="selectedCategory">
    <option value="null">Select Category...</option>
    <option value="cat1">cat1</option>
    <option value="cat2">Opel</option>
    <option value="cat2">Audi</option>
</select>
<input type="submit" value="Search" name="search">
<h4>Following items are available in //category//</h4>

<?php
require_once("Database.php");
require_once("Item.php");

$db = new Database();
$db->select('user', '*');
$db->makeTable(['User ID', 'PWD', 'name', 'add', 'phone', 'email']);
?>
</body>
</html>