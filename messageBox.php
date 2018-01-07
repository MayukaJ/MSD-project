<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/messegeBox.css">
</head>
<body>
<form class='form'>


        <?php
        session_start();
        if(isset($_SESSION["messageBoxInfo"]))

            $messageBoxInfo = unserialize(base64_decode($_SESSION["messageBoxInfo"]));
            $message = $messageBoxInfo[0];
            $buttonTitle = $messageBoxInfo[1];
            $link = $messageBoxInfo[2];

            echo "<h4>";
            echo $message;
            echo "</h4><a href=\"$link\" class=\"btn\">$buttonTitle</a>";
            session_abort();
        ?>


</form></body></html>



