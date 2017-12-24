<!DOCTYPE html>
<?php
require_once("Database.php");
require_once("Item.php");
require_once("User.php");
require_once("Recipient.php");
require_once ("Request.php");

session_start();

$user = $_SESSION['user'];
$user_id = $user->getUserId();
$name = $user->getName();

echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Home | Recipient</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/home.css\">
</head>
<body>
<table id=\"table\">
    <tr>
        <header>
            <h2>Welcome ";
echo $name;

echo "</h2>
        </header>
    </tr>
    <tr>
        <div>
            <h4>Your currently requested items</h4>
";



        $db = new Database();
        $requestsList = Request::returnRecipientRequests($db, $user);

        $requestsList[0]->item->getItemId();

        $db->makeTable(["Request ID", "Item ID", "Title", "Description", "Picture", "Donor ID", "Category", "Status", "Date Submitted", "Cancel Request"],
            [6], null, $requestsList, true, "cancel", "Cancel Request", "reciepient_cancelRequest.php"
            );

?>
        </div>
    </tr>
    <tr>
        <br>
        <br>
        <div>
            <a href="requestItem.php" class="btn">Request New Item</a>
        </div>
    </tr>
</table>
</body>
</html>