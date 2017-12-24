<?php

require_once ("Recipient.php");
require_once ("Request.php");
require_once ("Item.php");


try
{
    $db = new Database();

    $status = Recipient::ALLOWED_STATUSES[2];
    $userList = Recipient::returnList($db, $status);

    echo "
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Home | Admin</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/home.css\">
</head>
<body>
<header>
            <h2>Welcome ";
echo $name;

echo "</h2>
        </header>";


    echo "<h4>Sent Items to be Received</h4>";

    $db = new Database();
    $requestsListConfirmed = Request::returnConfirmedRequests($db);

    $db->makeTable(["Request ID", "Item ID", "Title", "Status", "Requester ID", "Summary", "View Request"],
        [3,4,5,6,7,9,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25],
        null, $requestsListConfirmed, true, "view",
        "View Request", "donor_viewRequest.php"
    );


    echo "<h4>Following are the waiting users</h4>";

    $db->makeTable
    (
    // 0user_id 1pwd 2status 3date_created 4name 5address 6phone 7email 8-- 9nic 10-- 11age 12occupation  13place of work 14salary 15proofdoc 16summary

    ["user_id", "date_created", "name", "phone", "email", "age", "salary" ], [1,2,5,7,8,9,12,13,15,16,17], null,
        $userList, true, 'details', "FullDetails", "admin_viewUserDetails.php"
    );

    $db = new Database();

    $status = Recipient::ALLOWED_STATUSES[1];
    $userList = Recipient::returnList($db, $status);
    echo "<h4>Following are the reported users</h4>";

    $db->makeTable
    (
    // 0user_id 1pwd 2status 3date_created 4name 5address 6phone 7email 8-- 9nic 10-- 11age 12occupation  13place of work 14salary 15proofdoc 16summary

        ["user_id", "date_created", "name", "phone", "email", "age", "salary" ], [1,2,5,7,8,9,12,13,15,16,17], null,
        $userList, true, 'details', "FullDetails", "admin_viewUserDetails.php"
    );
echo "</body>";


} catch (DatabaseException $e) {
    $e->echoDetails();
}