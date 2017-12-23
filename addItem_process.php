<?php
/**
 * Created by PhpStorm.
 * User: Chinthana
 * Date: 19-Dec-17
 * Time: 3:46 PM
 */

require_once("Database.php");
require_once("Item.php");

$db = new Database();
$item = new item();

echo $_POST["category"];

if($item->makeFromForm($_POST["title"], $_POST["description"], "aba123", $_POST["category"]))
{
    echo "success";
}

?>