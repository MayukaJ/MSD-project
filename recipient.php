<?php
include 'User.php';

class Recipient extends User{

    public function __construct($user,$a,$o,$p)
    {
        $DB = new Database();
        $DB->insertInto('user_requester',[$user,$a,$o,$p]);
    }
}
?>

