<?php

include 'User.php';

class Donor extends User{

    public function __construct($user)
    {
        $DB = new Database();
        $DB->insertInto('donor',[$user,'0']);
    }





}