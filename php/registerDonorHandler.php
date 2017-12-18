<?php
 if (isset($_POST['submit'])){
     $con = mysqli_connect('127.0.0.1','root','');
     $uname = mysqli_real_escape_string($conn,$_POST['username']); //uid = uid field name of the post
     $Name = mysqli_real_escape_string($conn,$_POST['name']);
     //$occ = mysqli_real_escape_string($conn,$_POST['occupation']);
     //$pos = mysqli_real_escape_string($conn,$_POST['pos']);
     //$addr = mysqli_real_escape_string($conn,$_POST['address']);
     //$num = mysqli_real_escape_string($conn,$_POST['contact']);
     $mail = mysqli_real_escape_string($conn,$_POST['email']);
     $pwd = mysqli_real_escape_string($conn,$_POST['psw']);
     $repwd = mysqli_real_escape_string($conn,$_POST['psw-repeat']);


     //check empty
     if (empty($uname)||empty($Name)||empty($addr)||empty($num)||empty($mail)||empty($pwd)||empty($repwd)){
         header("Location: ../registerrecipient.html?signup=empty");
         exit();
     }else{

         if($pwd!=$repwd){
             header("Location: ../registerrecipient.html?password=doesnt_match");
         }else{

             if (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                 header("Location: ../registerrecipient.html?signup=invalidemail");
                 exit();
             }else{
                 $sql = "SELECT * FROM user WHERE user_id='$uname'";
                 $resultuid = mysqli_query($con,$sql);
                 $recheck_uid = mysqli_num_rows($resultuid);

                 if ($recheck_uid > 0){
                     header("Location: ../registerrecipient.html?signup=userTaken");
                     exit();
                 }
                 else{
                     //hashing the password
                     $hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);

                     $sql = "INSERT INTO user (user_id,name,address,phone,email) VALUES ('$uname','$Name','$addr','$num','$mail');";
                     mysqli_query($con,$sql);
                     header("Location: ../registerrecipient.html?signup=success");
                     exit();
                 }
             }

         }
     }
 }

 ?>