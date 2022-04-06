
<?php include "functions.php"?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="admin--content--styles.css" rel="stylesheet"/>
</head>




<body>


  <div class="one--container">

    <div class="image--container">

    <img src="images/admin--image.jfif" height="300px" width="800px"/>
    </div>

    <div class="form-btn">


      <form class="form--container" action ="admin--content.php" method="post">


          <input type="submit" name="addBooks" value="Add Books"/>
          <input type="submit" name="bookSearch" value="Books Search"/>
       <!--   <input type="submit" name="bookupdate" value="Book Update"/> -->
          <input type="submit" name="viewOrder" value="View Order"/>

      </form>


    </div>

<?php 


  function showaddbooks()
  {
  
    ?>
    
 <div class="form--container1">

<div class="label--div">

<label for="Title">Title</label>
<label for="Author Name">Author Name</label>
<label for="cost">Cost</label>
<label form="Quantity">Quantity</label>

</div>
<form  class="input--div" action="admin--content.php" method="post">

<input type="text" name="Title"/>
<input type="text" name="Author_Name"/>
<input type="text" name="Cost"/>
<input type="text" name="Quantity"/>
<input  class="btn" type="submit" name="add" value="Add"/>
</form>






</div>
  </div>

<?php 
  }


  
?>



<?php

 function bookSearch()
 {



  ?>

  <h1>
    Book Search
  </h1>
  
  <form action="admin--content.php" method="post">
      <label for="book title">Title</label>
      <input type="text" name="book_title"/>


      <input type="submit" name="search" value="Search"/>

  </form>




<?php
}




?>






  
</body>
</html>





<?php

  if(isset($_POST['add']))
  {
    showaddbooks();
    ?>
 
    <h1>
      <?php 
   
      addBook();
      ?>

  </h1>;
  <?php
  }



?>


<?php

  if(isset($_POST['addBooks']))
  {
    showaddbooks();
  }



?>



<?php 


  if(isset($_POST['bookSearch']))
  {
    bookSearch();
  }
  if(isset($_POST['search']))
  {

    bookSearch();
    searchBook();
  }




?>

<?php


if(isset($_POST['bookupdate']))
{
  bookUpdatePage();

}





?>

<?php

function bookUpdatePage()
{
?>
  <th>Book Update </th>
    
  <form action="admin--content.php" method="post">
      <label for="book title">Book Id</label>
      <input type="text" name="book_id"/>


      <input type="submit" name="search_update" value="Search"/>


      


  </form>
  

<?php
}
?>
<?php
if(isset($_POST['search_update']))
{
  bookUpdatePage();
  searchBookUpdate();
}


if(isset($_POST['edit']))
{

  echo "Edit";


}

?>
     







<?php
/*
function showupdatebooks()
  {

  
    ?>
    
 <div class="form--container1">

<div class="label--div">

<label for="Title">Title</label>
<label for="Author Name">Author Name</label>
<label for="cost">Cost</label>
<label form="Quantity">Quantity</label>

</div>

<form  class="input--div" action="admin--content.php" method="post">

<input type="text" name="Title"/>
<input type="text" name="Author_Name"/>
<input type="text" name="Cost"/>
<input type="text" name="Quantity"/>
<input  class="btn" type="submit" name="update_book" value="Update"/>
</form>






</div>
  </div>

  <?php
  }
  */
  ?>


<?php


    if(isset($_POST['viewOrder']))
    {

        showOrderedBooks();

    }

    ?>
      
        

<?php

    
      if(isset($_GET['user_id']))
      {

        storeAcceptedOrderInDatabase($_GET['user_id'],$_GET['book_id']);

      

      }

      function storeAcceptedOrderInDatabase($user_id,$book_id)

      {

        global $connection;
        $query="Insert into order_accepted (book_id,user_id) values ('$book_id','$user_id')";
        $result=mysqli_query($connection,$query);

        if(!$result)
        {
          die('error'.mysqli_error($connection));
        }
        else
        { 


          $query="Delete from order_table where book_id='$book_id' and user_id='$user_id'";
          $result=mysqli_query($connection,$query);
          if(!$result)
          {
            die('error'.mysqli_error($connection));
          }
          else
          {
            
            echo "Order Accepted";
            updateBooksData($user_id,$book_id);
            showOrderedBooks();

          }

       

        }






        



      }


      function updateBooksData($user_id,$book_id)
      {
        global $connection;
        $query="update books_table set quantity=quantity-1 where book_id='$book_id'";
        $result=mysqli_query($connection,$query);
        if(!$result)
        {
          die('error'.mysqli_error($connection));
        }
        else
        {
          echo "book data is updated";
        }

      }
?>


<?php
function showOrderedBooks()
{
      global $connection;
      $query="select * from order_table inner join users on order_table.user_id=users.id inner join books_table";
      $query=$query." on books_table.book_id=order_table.book_id";
      $result=mysqli_query($connection,$query);

      if(!$result)
      {
        die('error'.mysqli_error($connection));

      }
      else
      {

          ?>
          <table class="table">
            <thead>

            <tr>

                <th>user_id</th>
                <th>book_id</th>
                <th>name</th>
                <th>title</th>
                <th></th>

      </tr>
                
                

            </thead>

            <tbody>
          <?php
            while($row=mysqli_fetch_assoc($result))
        {


          $user_id=$row['user_id'];
          $book_id=$row['book_id'];
          $name=$row['name'];
          
          $title=$row['title'];
          ?>
    <tr>
          <td><?php echo $user_id?></td>
          <td><?php echo $book_id?></td>
          <td><?php echo $name?></td>
          <td><?php echo $title?></td>
          <td>
            <a href="admin--content.php?
            user_id=<?php echo $user_id;?>&
            book_id=<?php echo $book_id?>
            ">Accept Order</a>
         
        </td>
      


        </tr>
          <?php



            



       

        }
        ?>
            </tbody>
          </table>

          <?php
      }

    }



?>

