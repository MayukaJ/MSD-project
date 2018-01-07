<!DOCTYPE html>
<?php
require_once("Database.php");
require_once("Item.php");
require_once("User.php");
require_once("Recipient.php");
require_once("Request.php");

session_start();
User::checkLogin('r');

$user = $_SESSION['user'];
$user_id = $user->getUserId();
$name = $user->getName();

if(isset($_GET["request"]))
{
    header("Location:requestItem.php");
}
elseif (isset($_GET["logout"]))
{
    User::logout();
}

echo "<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Recipient Home</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/requestItem.css\">
</head>

<body>
<form class=\"topnav\" action = \"recipientHome.php\" method = \"get\" >
    <table>
        <tr><td>
                <h2>Recipient Home</h2>
            </td>";

echo "<td align='center'><input type=\"submit\" name=\"request\" value=\"Request an Item\"></td>";

echo "<td><h4 align = right>Welcome:<br>" . $name . "</h4></td>";


echo "<td><input type=\"submit\" name=\"logout\" value=\"Log Out\"></td></tr>
    </table>";


echo "<h4 align = center>Your Currently Requested Items</h4>";
echo "</form></div><br>";


$db = new Database();
$requestsList = Request::returnRecipientRequests($db, $user);

//$requestsList[0]->item->getItemId();

$db->makeTable(["Request ID", "Item ID", "Title", "Description", "Picture", "Donor ID", "Category", "Status", "Date Submitted", "Cancel Request"],
    [6], null, $requestsList, true, "cancel", "Cancel Request", "reciepient_cancelRequest.php"
);

echo "</form></div></body></html>";
