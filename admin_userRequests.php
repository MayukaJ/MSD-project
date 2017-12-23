<?php

require_once ("Recipient.php");

$db = new Database();
$userList = Recipient::returnListOfWaiting($db);

echo "<h4>Following are the waiting users</h4>";

try
{
    $db->makeTable
    (
    // 0user_id pwd 1status 2date_created 3name 4address 5phone 6email 7-- 8nic 9-- 10age 11occupation  12place of work 13salary 14proofdoc 15summary

    ["user_id", "name", "date_created", "phone", "email", "age", "salary" ], [1,2,5,7,8,9,10,11,13,14,15], null,
        $userList, true, 'details', "FullDetails", "admin_viewUserDetails.php"
    );
} catch (DatabaseException $e) {
    $e->echoDetails();
}