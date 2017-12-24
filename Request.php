<?php
/**
 * Created by PhpStorm.
 * User: Aba
 * Date: 12/20/2017
 * Time: 3:23 PM
 */

class Request
{
    protected $request_id;
    public $item;
    public $user;

    public const MAX_NO_OF_ITEMS_PER_RECIPIENT = 5;

    public function __construct(Item $item, Recipient $recipient)
    {
        $this->item = $item;
        $this->user = $recipient;
    }


    public function rejectRequest()
    {
        $db = new Database();
        if($this->item->getStatus() == Item::ALLOWED_STATUSES[0])
        {
            $db->delete('request', "request_id = '$this->request_id'");
            echo "Request Rejected";
        }
    }
    public function addToDB()
    {
        try
        {
            if(is_null($this->request_id))
            {
                $this->request_id = self::makeRequestID();
            }
            $db = new Database();
            $db->insertInto('request',[$this->request_id, $this->user->getUserId(), $this->item->getItemId()]);
        }
        catch (DatabaseException $e)
        {
            $e->echoDetails();
        }
    }

    static function makeRequestID()
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

    /**This function searches the database for AVAILABLE items with equal CATEGORTY and Title LIKE Keyword string. R
     * Returns array of 10 or less objects
     * @param $category
     * @param $keywordString
     * @param Database $db
     * @return array
     */
    public static function returnRecipientRequests(Database $db, $user)
    {
        $user_id = $user->getUserId();
        try
        {
            $query = "SELECT request.request_id, item.*
FROM request 
LEFT JOIN item on request.item_id = item.item_id 
WHERE request.user_id = '$user_id'";


            $db->runQuery($query);
            $requestsList = array();

            foreach ($db->results as $row)
            {
                $item = new Item($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
                $request = new Request($item, $user);
                $request->setRequestId($row[0]);

                array_push($requestsList, $request);
            }
            return $requestsList;
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

    /**This function searches the database for AVAILABLE items with equal CATEGORTY and Title LIKE Keyword string. R
     * Returns array of 10 or less objects
     * @param $category
     * @param $keywordString
     * @param Database $db
     * @return array
     */
    public static function returnDonorRequests(Database $db, $user, $isConfirmed)
    {
        $user_id = $user->getUserId();
        try
        {
            $query =
                "SELECT request.request_id, item.*, user.*, user_requester.*
            FROM item 
            RIGHT JOIN request ON request.request_id = item.item_id
            LEFT JOIN user ON user.user_id = request.user_id
            LEFT JOIN user_requester ON user_requester.user_id = user.user_id
            WHERE item.donor_id = '$user_id'  AND item.requester_id ";

            if($isConfirmed)
                $query .= "!= ''";
            else
                $query .= " = ''";


            $db->runQuery($query);
            $requestsList = array();

            foreach ($db->results as $row)
            {
                $item = new Item($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
                $receiver = new Recipient($row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],
                    $row[17],      $row[19],         $row[21],$row[22],$row[23],$row[24],$row[25],$row[26]
                );
                $request = new Request($item, $receiver);
                $request->setRequestId($row[0]);

                array_push($requestsList, $request);
            }
            return $requestsList;
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

    /**This function searches the database for AVAILABLE items with equal CATEGORTY and Title LIKE Keyword string. R
     * Returns array of 10 or less objects
     * @param $category
     * @param $keywordString
     * @param Database $db
     * @return array
     */
    public static function returnConfirmedRequests(Database $db)
    {
        try
        {
            $statusSent = Item::ALLOWED_STATUSES[2];
            $statusRecieved = Item::ALLOWED_STATUSES[3];

            $query =
                "SELECT request.request_id, item.*, user.*, user_requester.*
            FROM item 
            RIGHT JOIN request ON request.request_id = item.item_id
            LEFT JOIN user ON user.user_id = request.user_id
            LEFT JOIN user_requester ON user_requester.user_id = user.user_id
            WHERE item.status = '$statusSent'  OR item.status = '$statusRecieved'";

            echo $query;

            $db->runQuery($query);
            $requestsList = array();

            foreach ($db->results as $row)
            {
                $item = new Item($row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]);
                $receiver = new Recipient($row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],
                    $row[17],      $row[19],         $row[21],$row[22],$row[23],$row[24],$row[25],$row[26]
                );
                $request = new Request($item, $receiver);
                $request->setRequestId($row[0]);

                array_push($requestsList, $request);
            }
            return $requestsList;
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

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

    /**
     * @param mixed $request_id
     */
    public function setRequestId($request_id): void
    {
        $this->request_id = $request_id;
    }

}