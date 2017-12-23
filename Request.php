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
    protected $item;
    protected $recipient;

    public function __construct(Item $item, Recipient $recipient)
    {
        $this->item = $item;
        $this->recipient = $recipient;
    }

    public function acceptRequest()
    {

    }
    public function rejectRequest()
    {

    }
    public function addToDB()
    {
        try
        {
            $db = new Database();
            $db->insertInto('request',[$this->request_id, $this->recipient->__get(user_id), $this->item->__get(item_id)]);
        }
        catch (DatabaseException $e)
        {
            $e->echoDetails();
        }
    }



}