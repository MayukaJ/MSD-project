<?php

require_once ("Recipient.php");

try
{
    $db = new Database();

    $status = Recipient::ALLOWED_STATUSES[2];
    $userList = Recipient::returnList($db, $status);
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



} catch (DatabaseException $e) {
    $e->echoDetails();
}