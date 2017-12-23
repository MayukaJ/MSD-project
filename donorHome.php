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

            require_once('Item.php');
            require_once('Database.php');

            $requested = false;
            $category = "";
            $db = new Database();

            if (array_key_exists("requested", $_GET)) {
                $requested = ($_GET["requested"] != "true");
                echo $category;
                $category = $_GET['category'];
                $keywordString = $_GET['keywordString'];

                $itemList = Item::returnAvailItems($category, $keywordString, $db);


                echo "<h4>Following items are available in :" . ucwords($category) . "</h4>";

                try {
                    $db->makeTable(
                        ['Item ID', 'Title', 'Description', 'Donor', 'Category', 'Date', 'Request'], [3, 5, 7], null,
                        $itemList, true, 'request', "Request", ""
                    );
                } catch (DatabaseException $e) {
                    $e->echoDetails();
                }

            }


            ?>
        </div>
    </tr>
    <br>
    <tr>
        <div>
            <a href="addItem.html" class="btn">Add New Item</a>
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