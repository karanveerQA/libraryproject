<?php include "header--and--footer/header--of--index.php"?>

<h1>Welcome to Online Library Management System</h1>

    <div class="img--container">
    <img src="images/books--image.jpg"

    width="800px"
    height="400px"
    />
    </div>

    

    <div class="admin-and-student-container">


    <form action="admin--page.php" method="post">


        <div class="admin--container">
        <img src="images/admin--image.jfif" height="100px" width="100px"
        />
        <input class="admin--btn" type="submit" value="Admin"
         name="admin"/> 
        </div>

</form>


      <form action="signuporsignin.php" method="post">
        <div class="student--container">
        
        <img src="images/student--image.png" height="100px" width="100px"
        />
        <input class="student--btn" type="submit" value="Student"
         name="student"/>  
        </div>
    </form>



    </div>






    <?php include "header--and--footer/footer.php"?>