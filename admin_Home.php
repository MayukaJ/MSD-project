<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Home</title>
    <link rel="stylesheet" type="text/css" href="css/requestItem.css">
</head>
<body>
<form class="topnav" action = "admin_Home.php" method = "get" >
    <table>
        <tr><td>
                <h2>Admin Home</h2>
            </td><td>
                <select name = "view" id="view">
                    <option value="null">View Information</option>
                    <option value="waiting">Waiting Users</option>
                    <option value="reported">Reported Users</option>
                    <option value="items">Sent Items</option>
                </select>
                <input type="hidden" name="requested" value="true">
                <input type="submit" name="submit" value="View">
            </td>
        <td>
            <input type="submit" name="logout" value="Log Out">
        </td>
        </tr>
    </table>




<?php

require_once ("Recipient.php");
require_once ("Request.php");
require_once ("Item.php");
User::checkLogin('a');

if(isset($_GET["submit"]))
{

    if ($_GET["view"] == "waiting") {
        try {
            echo "<h4 align = center>Following are the waiting users</h4>";
            echo "</form></div><br>";

            $db = new Database();
            $status = Recipient::ALLOWED_STATUSES[2];
            $userList = Recipient::returnList($db, $status);

            $db->makeTable
            (
            // 0user_id 1pwd 2status 3date_created 4name 5address 6phone 7email 8-- 9nic 10-- 11age 12occupation  13place of work 14salary 15proofdoc 16summary

                ["User ID", "Date Created", "Name", "Phone No", "Email", "Age", "Salary", "Details"],
                [1, 2, 5, 8, 9, 10, 12, 13, 15, 16], null,
                $userList, true, 'details', "FullDetails", "admin_viewUserDetails.php"
            );
        } catch (DatabaseException $e) {
            $e->echoDetails();
        }



    } else if ($_GET["view"] == "reported") {
        try {
            echo "<h4 align = center>Following are the reported users</h4>";
            echo "</form></div><br>";

            $db = new Database();

            $status = Recipient::ALLOWED_STATUSES[1];
            $userList = Recipient::returnList($db, $status);

            $db->makeTable
            (
            // 0user_id 1pwd 2status 3date_created 4name 5address 6phone 7email 8-- 9nic 10-- 11age 12occupation  13place of work 14salary 15proofdoc 16summary

                ["User ID", "Date Created", "Name", "Phone No", "Email", "Age", "Salary", "Details"],
                [1, 2, 5, 8, 9, 10, 12, 13, 15, 16], null,
                $userList, true, 'details', "FullDetails", "admin_viewUserDetails.php"
            );
        } catch (DatabaseException $e) {
            $e->echoDetails();
        }
    } else if ($_GET["view"] == "items") {
        try {
            echo "<h4 align = center>Confirmed Items</h4>";
            echo "</form></div><br>";

            $db = new Database();
            $itemRequestList = Item::returnDonatedItems($db);

            $db->makeTable(
                ['Item ID', 'Title', 'Description', 'Picture', 'Chosen Requester', 'Category', 'Status' ,'Date Submitted', 'Request ID', 'Details'], [4], null,
                $itemRequestList, true, 'itemdetails', "Details", "admin_itemDetails.php"
            );


        } catch (DatabaseException $e) {
            $e->echoDetails();
        }
    }
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

