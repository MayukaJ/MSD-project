<?php

include 'User.php';

class Donor extends User
{
    protected $rating;

    public function __construct($user,$Name,$pwd,$num,$mail,$status)
    {
        $this->rating = 0;
        $this->type = self::ALLOWED_TYPES[3]; //'DONOR' Type
        $this->fillUserDetails($user,$Name,$pwd,$num,$mail,$this->type, $status);
    }

    public function writeToDonorAndUserDB()
    {
        $DB = new Database();
        $this->writetoUserDB();
        $DB->insertInto('donor',[$this->user_id,'0']);
    }

    public function updateRating($rating)
    {
        $db = new Database();
        try
        {
            $db->update('donor', "user_id = '" . $this->user_id . "'", ['rating'], [$rating]);
        }
        catch (DatabaseException $e)
        {
            $e->echoDetails();
        }
    }

    //Report Request Function

}