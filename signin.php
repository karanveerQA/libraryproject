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


<link href="signinstyles.css" rel="stylesheet"/>
    
</head>
<body>
    <div class="image--container">
    <img src="user--image.png" height="500px" width="500px">
    </div>
            <form action="signin.php" method="post"> 
                <div class="flex--container">
                <div class="signup_username">

               <label for="signup_username">Username</label>
                <input type="text" name="signin_username"/>
            </div>


            <div class="signup_userpassword">

                <label for="signup_userpassword">Password</label>
                 <input type="text" name="signin_userpassword"/>
             </div>
             <input  class="signup_submit" type="submit" name="signin" value="sign in">
            </div>
            </form>


   
</body>
</html>


<?php

include 'database_connection.php';

if(isset($_POST['signin']))
{
    signInTheUser();
}
function signInTheUser()
{
    global $connection;
    $username=$_POST['signin_username'];
    $userpassword=$_POST['signin_userpassword'];

    $query="select * from users where name='$username' and password='$userpassword'";

    $result=mysqli_query($connection,$query);
    if(!$result)
    {
        die('error'.mysqli_error($connection));
    }
    else
    {
        $count=0;
        while($row=mysqli_fetch_row($result))
        {
            $count++;

        }

        echo $count;
        if($count==1)
        {
            $name="user_id";
            $value=$username;
            $expiration=time()+(60*60*24*7);
            setCookie($name,$value,$expiration);
            $name="user_password";
            $value=$userpassword;
            $expiration=time()+(60*60*24*7);

            setCookie($name,$value,$expiration);

            header('Location:user--content.php');
        }
       
    }


}





?>