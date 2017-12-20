<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | Donater</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
<table id="table">
    <tr>
        <header>
            <h2>Welcome //name//</h2>
        </header>
    </tr>
    <tr>
        <div>
            <h4>Your current items</h4>

            <?php
            require_once("Database.php");
            require_once("Item.php");

            $db = new Database();
            $db->select('user', '*');
            $db->makeTable(['User ID', 'PWD', 'name', 'add', 'phone', 'email']);
            ?>
        </div>
    </tr>
    <br>
    <tr>
        <div>
            <a href="requestItem.html" class="btn">Add New Item</a>
        </div>
    </tr>
    <tr>
        <div>
            <h4>Requests</h4>

            <?php
            require_once("Database.php");
            require_once("Item.php");

            $db = new Database();
            $db->select('user', '*');
            $db->makeTable(['User ID', 'PWD', 'name', 'add', 'phone', 'email']);
            ?>
        </div>
    </tr>
</table>
</body>
</html>