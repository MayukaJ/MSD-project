<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review new User | Admin</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<header><h3>Welcome //adminname//</h3></header>
<br><br>
<a href="admintrc.php" class="btn">Transaction details</a>
<a href="adminAcrev.php" class="btn">Review new users</a>
<a href="adminAcops.php" class="btn">Account operations</a>
<br><br>

<?php
require_once("Database.php");
require_once("Item.php");

$db = new Database();
$db->select('user', '*');
$db->makeTable(['User ID', 'PWD', 'name', 'add', 'phone', 'email']);
?>
</body>
</html>