<?php

require_once ('User.php');

class Donor extends User
{
    protected $rating;

    public function __construct($user_id, $pwd, $status, $date_created, $name, $address, $phone, $email, $nic,$rating)
    {
        $this->rating = $rating;
        $this->type = self::ALLOWED_TYPES[2]; //'DONOR' Type
        $this->fillUserDetails($user_id, $pwd, $status, $date_created, $name, $address, $phone, $email, $this->type,$nic);
    }

    public static function readDonor($user_id)
    {
        $db = new Database();
        try
        {

            $db->select('user RIGHT', '*', 'donor ON user.user_id =donor.user_id',
                "user.user_id = '$user_id'");

            $row = $db->results[0];
            return new Donor(
                $row[0], $row[1], $row[2],$row[3], $row[4], $row[5], $row[6], $row[7], $row[9], $row[10]
            // user_id pwd status date_created name address phone email -- nic -- age occupation  place of work salary proofdoc summary
            );

        }
        catch (DatabaseException $e)
        {
            $e->echoDetails();
        }
        catch (Exception $e)
        {
            echo "Exception in method ". __METHOD__;
        }
    }

    public function writeToDonorAndUserDB()
    {
        $DB = new Database();
        $this->writetoUserDB();
        $DB->insertInto('donor',[$this->user_id,$this->rating]);
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