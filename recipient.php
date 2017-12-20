<?php
include 'User.php';

class Recipient extends User{

    public function __construct($user,$a,$o,$p,$prf)
    {
        $DB = new Database();
        $DB->insertInto('user_requester',[$user,$a,$o,$p,$prf]);
    }
}
?>

