<!DOCTYPE html>
<?php
require_once("Database.php");
require_once("Item.php");
require_once("User.php");
require_once("Recipient.php");
require_once ("Request.php");
require_once ("Donor.php");

session_start();
User::checkLogin('d');

$user = $_SESSION['user'];
$user_id = $user->getUserId();
$name = $user->getName();

echo
"
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Donor Home</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/requestItem.css\">
</head>
<body>
<form class=\"topnav\" action = \"donorHome.php\" method = \"get\" >
    <table>
        <tr><td>
                <h2>Donor Home</h2>
            </td>
            <td>
                <input type=\"submit\" name=\"donate\" value=\"Donate New Item\">
            </td>
            <td>
                <select name = \"view\" id=\"view\">
                    <option value=\"null\">View Information</option>
                    <option value=\"waiting\">Requests waiting for approval</option>
                    <option value=\"confirmed\">Requests you have confirmed</option>
                    <option value=\"items\">Items you have donated</option>
                </select>
                <input type=\"submit\" name=\"viewSubmit\" value=\"View\">
            </td>
            
";

echo "<td><h4 align = right>Welcome:<br>" . $name . "</h4></td>";


echo
"
            </td>
            <td>
                <input type=\"submit\" name=\"logout\" value=\"Log Out\">
            </td>
        </tr>
    </table>
";

if(isset($_GET["viewSubmit"]))
{
    if($_GET["view"] == "waiting")
    {
        echo "<h4 align = center>Requests waiting for your approval</h4>";
        echo "</form></div><br>";

        $db = new Database();
        $requestsList = Request::returnDonorRequests($db, $user,false);

        $db->makeTable(["Request ID", "Item ID", "Title", "Status", "Requester ID", "Summary", "View Request"],
            [3,4,5,6,7,9,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25],
            null, $requestsList, true, "view",
            "View Request", "donor_viewRequest.php"
        );

    }
    elseif($_GET["view"] == 'confirmed')
    {
        echo "<h4 align = center>Requests you have confirmed</h4>";
        echo "</form></div><br>";

        $db = new Database();
        $requestsListConfirmed = Request::returnDonorRequests($db, $user,true);

        $db->makeTable(["Request ID", "Item ID", "Title", "Status", "Requester ID", "Summary", "View Request"],
            [3,4,5,6,7,9,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25],
            null, $requestsListConfirmed, true, "view",
            "View Request", "donor_viewRequest.php"
        );


    }
    elseif($_GET["view"] == 'items')
    {
        echo "<h4 align = center>Items you have donated</h4>";
        echo "</form></div><br>";

        $db = new Database();
        $itemList = Item::returnDonatedItems($db, $user);


        $db->makeTable(
            ['Item ID', 'Title', 'Description', 'Picture', 'Chosen Requester', 'Category', 'Status' ,'Date Submitted', 'Remove'], [4], null,
            $itemList, true, 'remove', "Remove", "donor_processRequest.php"
        );



    }

}
elseif (isset($_GET["donate"]))
{
    header("Location:addItem.php");
}
elseif (isset($_GET["logout"]))
{
    User::logout();
}
else
{
    echo "</form></div>";
}
echo "</body></html>";
