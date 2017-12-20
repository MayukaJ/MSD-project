<?php
/**
 * User: Abarajithan
 * Date: 12/19/2017
 * Time: 5:42 AM
 */

require_once("Database.php");
require_once ("ItemException.php");

class Item
{
    const ALLOWED_CATEGORIES = array("clothes", "books", "shoes", "sportsequipment", "electronicappliances", "musicialequipment", "furniture");
    const MAX_NO_VIEW = 10;
    const IMAGE_DIRECTORY = "item_images/";

    protected $item_id;
    protected $title;
    protected $description;
    protected $donor_id;
    protected $photo;
    protected $photoPath;
    protected $requester_id = null;
    protected $category;
    protected $status;
    protected $date_submitted;

    public function __construct()
    {
        $numArgs = func_num_args();

        if($numArgs == 10)
        {
            $this->setAll(func_get_arg(0),
                func_get_arg(1),
                func_get_arg(2),
                func_get_arg(3),
                func_get_arg(4),
                func_get_arg(5),
                func_get_arg(6),
                func_get_arg(7),
                func_get_arg(8) );
        }
    }

    public function setAll($item_id,$title,$description,$photoPath,$donor_id,
                           $requester_id,$category,$status,$date_submitted)
    {
        $this->item_id = $item_id;
        $this->title = $title;
        $this->description = $description;
        $this->donor_id = $donor_id;
        $this->photoPath = $photoPath;
        $this->requester_id=$requester_id;
        $this->category = $category;
        $this->status = $status;
        $this->date_submitted = $date_submitted;
    }

    public function makeFromForm($title, $description, $donor_id, $category)
    {
        try
        {
            $this->validateItem($title, $description, $donor_id, $category);

            $this->item_id = self::makeItemID();
            $this->status = 'advertised';

            // Upload Image & Get the path
            $this->photoPath = $this->uploadItemImage();

            return $this->writeToDB();
        }
        catch (ItemException $e)
        {
            $e->echoDetails();
            echo "Cannot create item";
        }
        catch (DatabaseException $e)
        {
            echo "Error Writing to database";
            $e->echoDetails();
        }

    }

    /**
     * @param $title
     * @param $description
     * @param $donor_id
     * @param $category
     * @throws ItemException
     */
    public function validateItem($title, $description, $donor_id, $category)
    {
        // 1. CLEAN UP the Title
        $this->title = ucwords(preg_replace("/[^a-zA-Z]/", "", $title));
        $this->description = $description;

        if (strlen($this->title) > 20) {
            throw new ItemException(
                __METHOD__, "Title too long: Title should be less than 20 characters in length."
            );
        }

        if (strlen($this->description) > 255) {
            throw new ItemException(
                __METHOD__, "Description too long: Description should be less than 255 characters in length."
            );
        }

        // 2. CLEAN UP the category and check if it is valid. If not return false

        $this->category = strtolower(preg_replace("/[^a-zA-Z]/", "", $category));

        if (!in_array($category, self::ALLOWED_CATEGORIES)) {
            throw new ItemException(
                __METHOD__, "Invalid Category.", [$category, self::ALLOWED_CATEGORIES]
            );
        }
        // 4. Validate donorID
        $this->donor_id = trim(strtolower($donor_id));

        try {
            $db = new Database();
            $db->select("donor", 'COUNT(user_id)', null, "user_id = '" . $this->donor_id . "'");
            if ($db->results[0][0] != 1) {
                throw new ItemException(
                    __METHOD__, "Donor doesn't exist", [$donor_id]
                );
            }
        }
        catch (DatabaseException $e)
        {
            $e->echoDetails();
        }
    }

    /**
     * @return bool|mysqli_result
     * @throws DatabaseException
     */
    public function writeToDB()
    {
        $db = new Database();
        return $db->insertInto('item', [$this->item_id, $this->title, $this->description,
            $this->photoPath, $this->donor_id, $this->requester_id, $this->category, $this->status, 'now()']);
    }

    /**This function searches the database for AVAILABLE items with equal CATEGORTY and Title LIKE Keyword string. R
     * Returns array of 10 or less objects
     * @param $category
     * @param $keywordString
     * @param Database $db
     * @return array
     */
    public static function returnAvailItems($category, $keywordString, Database $db)
    {
        try
        {
            $db->select('item', '*', null,
                Database::makeQueryForViewItems($category, $keywordString),
                null, null, self::MAX_NO_VIEW);

            $itemsList = array();

            foreach ($db->results as $row) {
                array_push($itemsList, new Item(
                    $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]
                ));
            }
            return $itemsList;
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
     * @return int
     */
    static function makeItemID()
    {
        try
        {
            $db = new Database();
            $db->select("item", 'MAX(item_id)');

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

    public function uploadItemImage()
    {
        try
        {
            return Database::uploadImage(self::IMAGE_DIRECTORY, $this->item_id);
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
}