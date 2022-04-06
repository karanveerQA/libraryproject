<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">


<link href="signupstyles.css" rel="stylesheet"/>
    
</head>
<body>
    <div class="image--container">
    <img src="user--image.png" height="500px" width="500px">
    </div>
            <form action="signup.php" method="post">
                <div class="flex--container">
                <div class="signup_username">

               <label for="signup_username">Username</label>
                <input type="text" name="signup_username"/>
            </div>


            <div class="signup_username">

                <label for="signup_userpassword">Password</label>
                 <input type="text" name="signup_userpassword"/>
             </div>
             <div class="signup_username">

<label for="signup_userrollno">Roll no</label>
 <input type="text" name="userrollno"/>
</div>
<div class="signup_username">

<label for="signup_usermobileno">Mobile No</label>
 <input type="text" name="usermobileno"/>
</div>
          
             <input  class="signup_submit" type="submit" name="signup_submit" value="sign up">
                </div>
            </form>



   
</body>
</html>





<?php
include 'functions.php'; 


if(isset($_POST['signup_submit']))
{
    echo 'btn clicked';
    addUserInDatabase();
}


function addUserInDatabase()
{
    global $connection;
   $username= $_POST['signup_username'];
   $password= $_POST['signup_userpassword'];
   $rollno= $_POST['userrollno'];
    $mobile_no=$_POST['usermobileno'];

    echo $username;
    $query="Insert into users(name,password,roll_no,mobile_no)values";
    $query=$query." ('$username','$password','$rollno','$mobile_no')";
    $result=mysqli_query($connection,$query);
    if(!$result)
    {
        die('error'.mysqli_error($connection));
    }
    else
    {
        echo 'user added';
        header('Location:signin.php');
    }
}




?>