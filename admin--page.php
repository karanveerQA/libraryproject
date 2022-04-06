<?php include "header--and--footer/header--of--admin--page.php";
?>
<div class="img--container">
<img src="images/admin--image.jfif"
    height="500px"
    width="800px"/>

</div>

<div class="form--container">

<form action="admin--page.php" method="post">

<div class="username--container">

    <label for="username">Enter username</label>
    <input type="text" name="username" placeholder="Enter username"/>


</div>

    <div class="password--container">

    <label for="password">Enter password</label>
    <input type="text" name="password" placeholder="Enter password"/>

    </div>


    <input type="submit" name="signin" value="SIGN IN"/>
    


</form>




</div>




  



<?php

    if(isset($_POST['signin']))
    {


      $username=$_POST['username'];
      $password=$_POST['password'];
      ?>
      <?php include "functions.php"?>
    <!--
      <div class="validation--div">
      <?php 
      validation();
      ?>
      </div>
    -->
      <?php

      $connection=mysqli_connect('localhost','root','','library_database');
      if(!$connection)
      {
        die('Error Occured');
      }
      else
      {
        $query="Select * from admin_table";
        $query=$query." where username='$username' and password='$password'";
        $result=mysqli_query($connection,$query);
     $count=0;
     while($row=mysqli_fetch_row($result))
     {  
       $count++;


     }

     if($count==1)
     {
       echo $count;
       header("Location: admin--content.php");
       exit;
       

     }

     

     

    
      }
    }



  


?>

<?php include "header--and--footer/footer.php"?>