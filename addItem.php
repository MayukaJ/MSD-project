<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add new Item</title>
    <link rel="stylesheet" type="text/css" href="css/addItem.css">
</head>
<body>
<form class="form">
    <h3>Add new Item</h3>
    <p type="Item Name:"><input placeholder="Enter Item name here.."></input></p>
    <select name="category" id="selectedCategory">
        <option value="null">Select Category...</option>
        <option value="clothes">Clothes</option>
        <option value="books">Books/Educational</option>
        <option value="shoes">Shoes</option>
        <option value="sports">Sports Equipment</option>
        <option value="electronic">Electronic appliances</option>
        <option value="music">Musical/Aesthetic Equipment</option>
        <option value="furniture">Furniture items</option>
    </select>
    <p type="Picture:"><input type="file" placeholder="What would you like to tell us.." multiple></input></p>
    <p type="Description:"><input placeholder="What would you like to tell us.."></input></p>
    <button>Add Item</button>
</form>
</body>
</html>