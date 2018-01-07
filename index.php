<?php
require_once 'User.php';
User::checkLogin('n');
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>DonateLK | Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<font face="verdana" color="white">
    <br><br>
        <h1 align="center">WELCOME TO DONATELK</h1>
        <h4 align="center">The Bridge of Philanthropy</h4>

</font>
<table>
    <tr>
        <td>
            <form class="form">
                <h2>Become a</h2>
                <a href="registerdonor.php" class="btn">Donor</a>
                <a href="registerrecipient.php" class="btn">Recipient</a>
            </form>
        </td>
        <td>
            <form class="form" action="loginHandler.php" method="post">
                <h2>Login</h2>
                <input type="text" name="un" placeholder="User Name" maxlength="10" required>

                <input type="password" name="pw" placeholder="Password" required>
                <input type="submit" name="submit" value="Sign In">
            </form>
        </td>
    </tr>
</table>
</form>
</body>
</html>