<!DOCTYPE html>
<?php
require_once("Database.php");
require_once("Item.php");
require_once("User.php");
require_once("Recipient.php");
require_once ("Request.php");
require_once ("Donor.php");

session_start();

$user = $_SESSION['user'];
$user_id = $user->getUserId();
$name = $user->getName();

echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Home | Donor</title>
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
        
";

echo "<center><br><br>
        <a href=\"addItem.php\" class=\"btn\">Donate New Item</a>
<br><br><br><div></center>
            <h4>Requests awaiting approval for your items</h4>
";


$db = new Database();
$requestsList = Request::returnDonorRequests($db, $user,false);

$db->makeTable(["Request ID", "Item ID", "Title", "Status", "Requester ID", "Summary", "View Request"],
    [3,4,5,6,7,9,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25],
    null, $requestsList, true, "view",
    "View Request", "donor_viewRequest.php"
);


echo "<h4>Requests you have confirmed</h4>";

$db = new Database();
$requestsListConfirmed = Request::returnDonorRequests($db, $user,true);

$db->makeTable(["Request ID", "Item ID", "Title", "Status", "Requester ID", "Summary", "View Request"],
    [3,4,5,6,7,9,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25],
    null, $requestsListConfirmed, true, "view",
    "View Request", "donor_viewRequest.php"
);


echo "<h4>Items you have donated</h4>";

$db = new Database();
$itemList = Item::returnDonatedItems($db, $user);


$db->makeTable(
    ['Item ID', 'Title', 'Description', 'Picture', 'Chosen Requester', 'Category', 'Status' ,'Date Submitted', 'Remove'], [4], null,
    $itemList, true, 'remove', "Remove", "donor_processRequest.php"
);

?>
</div>
</tr>
</table>
</body>
</html>