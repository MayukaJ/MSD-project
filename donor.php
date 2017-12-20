<?php

include 'User.php';

class Donor extends User{

    public function __construct($user,$Name,$pwd,$num,$mail)
    {
        $DB = new Database();
        $DB->insertInto('donor',[$user,'0']);
        $this->addUser($user,$Name,$pwd,$num,$mail,'D');
    }





}