<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add new Item</title>
    <link rel="stylesheet" type="text/css" href="css/addItem.css">
</head>
<body>
<form action="addItem_process.php" class="form" method="post"  enctype="multipart/form-data">
    <h3>Add new Item</h3>
    <p type="Item Name:"><input name="title" type="text" placeholder="Enter Item name here.."></input></p>
    <select name="category" type="text">
        <option value="null">Select Category...</option>
        <option value="clothes">Clothes</option>
        <option value="books">Books/Educational</option>
        <option value="shoes">Shoes</option>
        <option value="sports">Sports Equipment</option>
        <option value="electronic">Electronic appliances</option>
        <option value="music">Musical/Aesthetic Equipment</option>
        <option value="furniture">Furniture items</option>
    </select>
    <p type="Picture:"><input type="file" name="fileToUpload" id="fileToUpload" placeholder="What would you like to tell us.." multiple></input></p>
    <p type="Description:"><input name="description" type="text" placeholder="What would you like to tell us.."></input></p>
    <input type="submit" value="Add Item">
</form>
</body>
</html>