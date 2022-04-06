



<?php



include "database_connection.php";







?>



<?php




function validation()
{
  $username=$_POST['username'];
  $password=$_POST['password'];

 
 
  if(strlen($username)==0 || strlen($password)==0)
  {

      echo "please fill the required fields";
  }
}


function addBook()
{
    if(isset($_POST['add']))
    {
      $title=$_POST['Title'];
      $author_name=$_POST['Author_Name'];
      $cost=$_POST['Cost'];
      $quantity=$_POST['Quantity'];

      global $connection;

      $query="Insert into books_table(title,author_name,cost,quantity)values('$title','$author_name','$cost',
      '$quantity')";

      $result=mysqli_query($connection,$query);
      if(!$result)
      {
        die('query failed');
      }
      else
      {

      
      echo "book added";
    
      }

    }


}

  function searchBook()
  {

    

        global $connection;
        $book_title=$_POST['book_title'];
    
        $like='%'.$book_title.'%';
        $query="select * from books_table where title like '$like'";


     
     
        $result=mysqli_query($connection,$query);


        if(!$result)
        {
          die('error'.mysqli_error($connection));
        }

  
        

        else
        {
         
          $array=array();
          $index=0;
          while($row=mysqli_fetch_assoc($result))
          {
            $array[0]=$row;
            $index++;

          }
      
          if($index>0)
          {
          ?>

                 <table class="table">

          <thead>
              <tr>
                <th>Book Id</th>
                <th>Title</th>
                <th>Author Name</th>
                <th>Cost</th>
                <th>Quantity</th>
              </tr>
            </thead>
            <tbody>
          <?php
          for($row=0;$row<$index;$row++)
          {
            $book_id=$array[$row]['book_id'];
            $title=$array[$row]['title'];
            $author_name=$array[$row]['author_name'];
            $cost=$array[$row]['cost'];
            $quantity=$array[$row]['quantity'];

            ?>
            <tr>
              <td>
                <?php  echo $book_id ?>
              </td>
              <td>
                <?php  echo $title ?>
              </td>
              <td>
                <?php  echo $author_name ?>
              </td>
              <td>
                <?php  echo $cost ?>
              </td>
              <td>
                <?php echo $quantity ?>
              </td>

            </tr>
            <?php
            

          }
          ?>

     

            </tbody>



            </table>

            <?php
          }

          else
          {
            ?>
            <h1><?php echo "no books are there"?></h1>
            <?php
          }
        }
      }
        



      function searchBookUpdate()
      {
    
        
    
            global $connection;
      

            $book_id=$_POST['book_id'];
            
            echo $book_id;

        
            $query="select * from books_table where book_id='$book_id'";
    
    
         
         
            $result=mysqli_query($connection,$query);
    
    
            if(!$result)
            {
              echo mysqli_error($connection);
            }
    
      
            
    
            else
            {
             
              $array=array();
              $index=0;
              while($row=mysqli_fetch_assoc($result))
              {
                $array[$index]=$row;
                $index++;
    
              }
          
              if($index>0)
              {
              ?>
    
                     <table class="table">
    
              <thead>
                  <tr>
                    <th>Book Id</th>
                    <th>Title</th>
                    <th>Author Name</th>
                    <th>Cost</th>
                    <th>Quantity</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
              <?php
              
              $book_id=$array[0]['book_id'];
              $title=$array[0]['title'];
              $author_name=$array[0]['author_name'];
              $cost=$array[0]['cost'];
              $quantity=$array[0]['quantity'];
           



                ?>
              
              <?php


                 
                  
                  

              

                  




   



       

    
                ?>
                <tr>
                  <td>
                    <?php  echo $book_id ?>
                  </td>
                  <td>
                    <?php  echo $title ?>
                  </td>
                  <td>
                    <?php  echo $author_name ?>
                  </td>
                  <td>
                    <?php  echo $cost ?>
                  </td>
                  <td>
                    <?php echo $quantity ?>
                  </td>
                  <td>
               

                  <a href="update.php?book_id=<?php echo $book_id?>&
                  title=<?php echo $title?>&
                  author_name=<?php echo $author_name?>&
                  cost=<?php echo $cost?>&
                  quantity=<?php echo $quantity ?>">Edit</a>
           

                  </td>
    
                </tr>
                </tbody>
                     </table>
              
                <?php
                
    
              }
              
    
         
    
             
    
    
    
                
    
                
              
    
              else
              {
                ?>
                <h1><?php echo "no books are there"?></h1>
                <?php
              }
            }
          }






            

    
    

  





          
          ?>






<?php
function showupdatebooks($book_id,$title,$author_name,$cost,$quantity)
  {


    ?>
    
 <div class="form--container1">

<div class="label--div">

<label for="Title">Title</label>
<label for="Author Name">Author Name</label>
<label for="cost">Cost</label>
<label form="Quantity">Quantity</label>

</div>



<form  class="input--div" action="update.php" method="post">

<input type="text" name="Title" value=$title/>
<input type="text" name="Author_Name" value=$author_name/>
<input type="text" name="Cost" value=$cost/>
<input type="text" name="Quantity" value=$quantity/>
<a href="update.php?book_id=<?php echo $book_id?>&
                  title=<?php echo $title?>&
                  author_name=<?php echo $author_name?>&
                  cost=<?php echo $cost?>&
                  quantity=<?php echo $quantity ?>">Update</a>

</form>






</div>
 

  <?php
  }
  ?>

