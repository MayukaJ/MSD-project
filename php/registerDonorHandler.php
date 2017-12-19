<?php

$con = mysqli_connect('127.0.0.1', 'root', '');

if (!$con) {
    echo "Connection Failed";
}

if (!mysqli_select_db($con, "donatelk")) {
    echo "No Database";
}

$uname = $_POST['username']; //uid = uid field name of the post
$Name = $_POST['name'];
$mail = $_POST['email'];
$pwd = $_POST['psw'];
$repwd = $_POST['psw-repeat'];

if ($pwd != $repwd) {
    echo "passwords doesnt match"; //header("Location: ../registerdonar.html?password=doesnt_match");
} else {
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "mail error";//header("Location: ../registerrecipient.html?signup=invalidemail");
        exit();
    } else {
        $sql = "SELECT * FROM user WHERE user_id='$uname'";
        $resultuid = mysqli_query($con, $sql);
        $recheck_uid = mysqli_num_rows($resultuid);

        if ($recheck_uid > 0) {
            echo "error"; // header("Location: ../registerrecipient.html?signup=userTaken");
            exit();
        } else {
            //hashing the password
            $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
            $add = "radasdasdasdasd";
            $sql = "INSERT INTO user (user_id,first_name,email) VALUES ('$uname','$Name',$mail);";

            $sqlo = "INSERT INTO user (user_id, pwd, name, address, phone, email) VALUES ('$uname','$hashedpwd','$Name','$add','077452','$mail')";
            if (!mysqli_query($con, $sqlo)) {
                echo "error";
            } else {
                echo "Success!";
            }
            //header("Location: ../registerrecipient.html?signup=success");
            exit();
        }
    }
}
?>
