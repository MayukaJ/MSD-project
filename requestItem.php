<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request new Item</title>
    <link rel="stylesheet" type="text/css" href="css/addItem.css">
</head>
<body>
<form class="form2" action = "requestItem.php" method = "get" >
    <h3>What do you want?</h3>
    <select name = "category" id="selectedCategory">
        <option value="null">Select Category...</option>
        <option value="clothes">Clothes</option>
        <option value="books">Books/Educational</option>
        <option value="shoes">Shoes</option>
        <option value="sports">Sports Equipment</option>
        <option value="electronic">Electronic appliances</option>
        <option value="music">Musical/Aesthetic Equipment</option>
        <option value="furniture">Furniture items</option>
    </select>
    <input type="text" placeholder="Enter keywords" name="keywordString">
    <input type="hidden" name="requested" value="true">
    <input type="submit" name="search" value="Search">

</form>

</div>
</body>
</html>

<?php

require_once ('Item.php');
require_once ('Database.php');

$requested = false;
$category = "";
$db = new Database();

if(array_key_exists("requested",$_GET))
{
    $requested = ($_GET["requested"] != "true");
    echo $category;
    $category = $_GET['category'];
    $keywordString = $_GET['keywordString'];

    $itemList = Item::returnAvailItems($category, $keywordString, $db);


    echo "<h4>Following items are available in :" . ucwords($category ). "</h4>";

    try
    {
        $db->makeTable(
        ['Item ID', 'Title', 'Description', 'Picture', 'Donor', 'Category', 'Date', 'Request'], [5, 7], null,
        $itemList, true, 'request', "Request", "requestThisItem.php"
    );
    } catch (DatabaseException $e) {
        $e->echoDetails();
    }

}


?>