<?php

include_once ('Recipient.php');

$user = Recipient::readRecipient('aba007');

echo $user->getEmail();




?>


<html>
<head>
    <title> "Add item" </title>
</head>
<body>

<form action = "process2.php" method = "post" enctype="multipart/form-data">
    Enter Title <input name = "title" type = "text">
    <br>
    Enter Description <input name = "description" type = "text">
    <br>
    Enter Category <input name = "category" type = "text">
    <br>
    Enter Keywords (comma seperated) <input name = "keywords" type = "text">
    <br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type = "submit"value="Upload Image">
</form>

<br>
<br>
<br>

<form action = "process4.php" method = "post">
    Keywords String <input name = "keywordsString" type = "text">
    <br>
    Category <input name = "category" type = "text">
    <br>
    <input type = "submit">
</form>

<br>
<br>
<br>



</body>
</html>