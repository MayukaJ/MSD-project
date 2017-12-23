<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home | Recipient</title>
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
            <h4>Your currently requested items</h4>

        <?php
        require_once("Database.php");
        require_once("Item.php");

        $db = new Database();
        $db->select('user', '*');
        $db->makeTable(['User ID', 'PWD', 'name', 'add', 'phone', 'email']);
        ?>
        </div>
    </tr>
    <tr>
        <br>
        <br>
        <div>
            <a href="requestItem.html" class="btn">Request New Item</a>
        </div>
    </tr>
</table>
</body>
</html>