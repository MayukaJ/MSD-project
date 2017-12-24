<?php
require_once "User.php";

class Recipient extends User
{

    protected $age;
    protected $occupation;
    protected $place_of_work;
    protected $salary;
    protected $proofdoc;
    protected $summary;

    public function __construct($user_id, $pwd, $status, $date_created, $name, $address, $phone, $email, $nic, $age, $occupation, $place_of_work, $salary, $proofdoc, $summery)

    {

        $this->age=$age;
        $this->occupation=$occupation;
        $this->place_of_work=$place_of_work;
        $this->proofdoc=$proofdoc;
        $this->date_created = $date_created;
        $this->type = self::ALLOWED_TYPES[1]; //'R' Type
        $this->salary = $salary;
        $this->nic = $nic;
        $this->summary = $summery;
        $this->date_created = $date_created;
        $this->address = $address;

        $this->fillUserDetails($user_id, $pwd, $status, $date_created, $name, $address, $phone, $email, $this->type, $nic);

    }

    public function writeToReceiverAndUserDB()
    {
        try {
            $DB = new Database();
            $this->writetoUserDB();
            $DB->insertInto('user_requester', [$this->user_id, $this->age, $this->occupation, $this->place_of_work, $this->salary, $this->proofdoc, $this->summary]);
            //                                      user_id	            age	        occupation	place of work	    salary	        proofdoc	        summary
        }
        catch (DatabaseException $e)
        {
            $e->echoDetails();
        }
    }

    public static function uploadRecipientFile($user_id, $isImage)
    {
        try
        {
            return Database::uploadImage(self::DOC_DIRECTORY, $user_id, $isImage);
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

    public function report()
    {
        $this->status = self::ALLOWED_STATUSES[1];
        $db = new Database();
        $db->update('user',"user_id = '$this->user_id'", ['status'],['reported']);
    }
    public function requestItem(Item $item)
    {
        $noOfItemsRequested = 0;
        $db = new Database();
        $db->select('request', 'COUNT(request_id)',null,"user_id = '$this->user_id'");

        $noOfItemsRequested = count($db->results);

        if($noOfItemsRequested > 5)
        {
            echo "You have requested maximum number of items";
            return false;
        }
        else
        {
            $db->insertInto('request', [$this->makeRequestID(), $this->user_id, $item->getItemId()]);
            return true;
        }

    }
    public function returnListOfReported()
    {
        //NEED TO USE INNER JOIN. Will do
        //
        ///
        ///
        ///
        ///
        ///
        try
        {
            $db1 = new Database();
            $db1->select('user', '*', null,
                 "status = 'reported' AND type = 'REQUESTER'", null, null, self::MAX_NO_VIEW);
            $userList = array();

            $db1 = new Database();
            $db1->select('receiver', '*', null,
                "status = 'reported' AND type = 'REQUESTER'", null, null, self::MAX_NO_VIEW);


            foreach ($db1->results as $row) {
                array_push($userList, new Item(
                    $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]
                ));
            }
            return $userList;
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


    public static function readRecipient($user_id)
    {
        $db = new Database();
        try
        {

            $db->select('user RIGHT', '*', 'user_requester ON user.user_id =user_requester.user_id',
                "user.user_id = '$user_id'");

            $row = $db->results[0];
            return new Recipient(
                    $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7],
                    $row[9], $row[11], $row[12], $row[13], $row[14], $row[15], $row[16]

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

    public function returnList(Database $db, $status)
    {
        try
        {
            $db->select('user RIGHT', '*', 'user_requester ON user.user_id =user_requester.user_id',
                "user.status = '$status'",
                null, null, self::MAX_NO_VIEW);

            $userList = array();

            foreach ($db->results as $row) {
                array_push($userList, new Recipient(
                    $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7],
                    $row[9], $row[11], $row[12], $row[13], $row[14], $row[15], $row[16]

                    // user_id pwd status date_created name address phone email -- nic -- age occupation  place of work salary proofdoc summary
                ));
            }
            return $userList;
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

    public function makeRequestID()
    {
        try
        {
            $db = new Database();
            $db->select("request", 'MAX(request_id)');

            if ($db->numResults == 0 || $db->results[0][0] == null)
            {
                return 1;
            }
            else
            {
                return (int)$db->results[0][0] + 1;
            }
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

    public function changeStatusTo($status)
    {
        $db = new Database();
        try
        {
            $db->update('user', "user_id = '$this->user_id'",['status'], [$status]);
        }
        catch (DatabaseException $e)
        {
            $e->echoDetails();
        }
    }

    public function getAge()
    {
        return $this->age;
    }


    public function getOccupation()
    {
        return $this->occupation;
    }


    public function getPlaceOfwork()
    {
        return $this->place_of_work;
    }


    public function getProofdoc()
    {
        return $this->proofdoc;
    }


    public function getItem()
    {
        return $this->item;
    }


    public function getSalary()
    {
        return $this->salary;
    }

    public function getSummary()
    {
        return $this->summary;
    }






}

