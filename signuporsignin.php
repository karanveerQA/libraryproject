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


<link href="signuporsignin.css" rel="stylesheet"/>
    
</head>
<body>
    
    <img src="user--image.png" height="500px" width="500px">
    
            <form class="signuporsignin.php" method="post">
             <input  class="signup_submit" type="submit" name="signupbtn" value="sign up">
             <input  class="signup_submit" type="submit" name="signinbtn" value="sign in">
            

            </form>


   
</body>
</html>


<?php 

    if(isset($_POST['signupbtn']))
    {
        header('Location: signup.php');
    }
    else if(isset($_POST['signinbtn']))
    {
            header('Location: signin.php');
    }


?>