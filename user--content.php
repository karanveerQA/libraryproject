<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *
        {
            margin: 0;
            padding:0;

        }

        body
        {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        form input
        {
            height:30px;
            width:100px;
         
        }

        form
        {
            display: flex;
        
            gap:15px;
        }


        table {
  width: 800px;
  border-collapse: collapse;
  font-size: 18px;
}

table thead th {
  background-color: #2f9e44;
  width: 25%;

  color: #fff;
}

th,
td {
  border: 1px solid #000;
  padding: 16px 24px;
  text-align: left;
}

tbody tr:nth-child(odd) {
  background-color: #e9ecef;
}

tbody tr:nth-child(even) {
  background-color: #adb5bd;
}

        

    </style>
</head>
<body>

    <div class="img--container">

    <img
    src="user--image.png" height="500px" width="500px"/>
    </div>

    <form action="user--content.php" method="post">

        <input type="submit" name="showuserbooks" value="books">
        <input type="submit" name="placeorder" value="placeorder">
        <input type="submit" name="my_ordered_books" value="ordered books">
        <input type="submit" name="accepted_books" value="accepted orders">





    </form>
    
</body>
</html>


<?php

include 'database_connection.php';
        if(isset($_POST['showuserbooks']))
        {

            showAllBooks();

        }

        if(isset($_POST['placeorder']))
        {

            showAllBooksInBooksTable();

        }

        ?>

     
        <?php
    


                    
                    
          function showAllBooks()
        {
            
            global $connection;
            $query="select * from books_table";
            $result=mysqli_query($connection,$query);
            if(!$result)
            {
                die('error'.mysqli_error($connection));
            }
            else
            {
            ?>
                 <table>

 <thead>

<th>Id</th>
<th>Title</th>
<th>Author Name</th>
<th>Cost</th>
<th>Quantity</th>

</thead>

<tbody>
    <?php
                while($row=mysqli_fetch_assoc($result))
                {

                    $book_id=$row['book_id'];
                    $title=$row['title'];
                    $author_name=$row['author_name'];
                    $cost=$row['cost'];
                    $quantity=$row['quantity'];
                    ?>
                <tr>

                    <td><?php echo $book_id ?></td>
                    <td><?php echo $title ?></td>
                    <td><?php echo $author_name?></td>
                    <td><?php echo $cost ?></td>
                    <td><?php echo $quantity ?></td>

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




<?php


            function showAllBooksInBooksTable()
            {
                global $connection;
                $query="select * from books_table where quantity>0";
                $result=mysqli_query($connection,$query);
                if(!$result)
                {
                    die('error'.mysqli_error($connection));
                }
                else
                {
                    ?>
                    <form action="user--content.php" method="post">

                    <select name="book_selected" value="">
                    <?php
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $title=$row['title'];
                        


                       echo "<option value='$title'>$title</option>";
                   
                    }

                    ?>
                 
                


                </select>
                <input type="submit" name="order" value="order"/>
                    </form>
              
                <?php
            }

        }
               if(isset($_POST['order']))
               {
                  
                showOrderedBook();
            
               }
        ?>







<?php

function showOrderedBook()
        {
            
            global $connection;


            $ordered_book_id=0;
         
            $book_selected=$_POST['book_selected'];
            $query="select * from books_table where title='$book_selected'";
            $result=mysqli_query($connection,$query);
            if(!$result)
            {
                die('error'.mysqli_error($connection));
            }
            else
            {
            ?>
                 <table>

 <thead>

<th>Id</th>
<th>Title</th>
<th>Author Name</th>
<th>Cost</th>
<th>Quantity</th>

</thead>

<tbody>
    <?php
                while($row=mysqli_fetch_assoc($result))
                {

                    $book_id=$row['book_id'];
                    
                    $ordered_book_id=$book_id;
                    $title=$row['title'];
                    $author_name=$row['author_name'];
                    $cost=$row['cost'];
                    $quantity=$row['quantity'];
                    ?>
                <tr>

                    <td><?php echo $book_id ?></td>
                    <td><?php echo $title ?></td>
                    <td><?php echo $author_name?></td>
                    <td><?php echo $cost ?></td>
                    <td><?php echo $quantity ?></td>

                </tr>
                        <?php
           

                

                    
                }
                ?>
</tbody>
                 </table>
                 <?php
            }
            storeOrderInDatabase($ordered_book_id);

        }

 


?>





<?php

        function storeOrderInDatabase($ordered_book_id)
        {

            $name="";
            $password="";
            $user_id=0;

        
        if(isset($_COOKIE['user_id']))
        {
          
            $name=$_COOKIE['user_id'];
            
        }
        if(isset($_COOKIE['user_password']))
        {
       
            $password=$_COOKIE['user_password'];
            
        }

        else
        {
            echo 'cookie';
        }

        if(strlen($name)>0 && strlen($password)>0)
            {
             
               global $connection;

               $query="select * from users where name='$name' and password='$password'";
               $result=mysqli_query($connection,$query);
               if(!$result)
               {
                   die('error'.mysqli_error($connection));
               }
               else
               {
                   while($row=mysqli_fetch_assoc($result))
                   {
                       $user_id=$row['id'];


                   }

                   $ans=alreadyOrdered($user_id,$ordered_book_id);

                   if(!$ans)
                   {

                   $query="insert into order_table(book_id,user_id)values('$ordered_book_id','$user_id')";
                   $result=mysqli_query($connection,$query);
                   if(!$result)
                   {

                    die('error'.mysqli_error($connection));

                   }
                   else
                   {

                       echo 'added';
                   }
                }



               }




        }


        }





?>


<?php


            function alreadyOrdered($user_id,$ordered_book_id)
            {
                global $connection;

                $query="select * from order_table where user_id='$user_id' and book_id='$ordered_book_id'";

                $result=mysqli_query($connection,$query);
                if(!$result)
                {
                    die('error'.mysqli_error($connection));
                }
                else
                {
                    while($row=mysqli_fetch_assoc($result))
                    {
                        ?>
                        <h1>already Ordered</h1>
                        
                        <?php
                        return true;
                    }

                    return false;
                }
            }




?>




<?php


                if(isset($_POST['my_ordered_books']))
                {
                    showMyOrders();
                }

        function showMyOrders()
        {   


            if(isset($_COOKIE['user_id']))
            {
              
                $name=$_COOKIE['user_id'];
                
            }
            if(isset($_COOKIE['user_password']))
            {
           
                $password=$_COOKIE['user_password'];
                
            }
    
            else
            {
                echo 'cookie';
            }
    
            if(strlen($name)>0 && strlen($password)>0)
                {
                 
                   global $connection;
    
                   $query="select * from users where name='$name' and password='$password'";
                   $result=mysqli_query($connection,$query);
                   if(!$result)
                   {
                       die('error'.mysqli_error($connection));
                   }
                   else
                   {
                       while($row=mysqli_fetch_assoc($result))
                       {
                           $user_id=$row['id'];
    
    
                       }
                    
    
       
                   $query="select * from order_table inner join books_table on order_table.book_id=books_table.book_id";
                    $query=$query." inner join users on order_table.user_id=users.id having order_table.user_id='$user_id'";
                        $result=mysqli_query($connection,$query);
                        if(!$result)
                        {
                            die('error'.mysqli_error($connection));
                        }
                        else
                        {
                            ?>
                            <table>

                            <thead>
                           
                           <th>Id</th>
                           <th>Title</th>
                           <th>Author Name</th>
                           <th>Cost</th>
                           <th>Quantity</th>
                           
                           </thead>
                           
                           <tbody>
                               <?php
                                           while($row=mysqli_fetch_assoc($result))
                                           {
                           
                                               $book_id=$row['book_id'];
                                               
                                               $ordered_book_id=$book_id;
                                               $title=$row['title'];
                                               $author_name=$row['author_name'];
                                               $cost=$row['cost'];
                                               $quantity=$row['quantity'];
                                               ?>
                                           <tr>
                           
                                               <td><?php echo $book_id ?></td>
                                               <td><?php echo $title ?></td>
                                               <td><?php echo $author_name?></td>
                                               <td><?php echo $cost ?></td>
                                               <td><?php echo $quantity ?></td>
                           
                                           </tr>
                                                   <?php
                                      
                           
                                           
                           
                                               
                                           }
                                           ?>
                           </tbody>
                                            </table>

                                            <?php

                        }
                
                
                }
            }
        }



        if(isset($_POST['accepted_books']))
        {

            showMyAcceptedOrders();

        }

        function showMyAcceptedOrders()
        {   


            if(isset($_COOKIE['user_id']))
            {
              
                $name=$_COOKIE['user_id'];
                
            }
            if(isset($_COOKIE['user_password']))
            {
           
                $password=$_COOKIE['user_password'];
                
            }
    
            else
            {
                echo 'cookie';
            }
    
            if(strlen($name)>0 && strlen($password)>0)
                {
                 
                   global $connection;
    
                   $query="select * from users where name='$name' and password='$password'";
                   $result=mysqli_query($connection,$query);
                   if(!$result)
                   {
                       die('error'.mysqli_error($connection));
                   }
                   else
                   {
                       while($row=mysqli_fetch_assoc($result))
                       {
                           $user_id=$row['id'];
    
    
                       }
                    
    
       
                   $query="select * from order_accepted inner join books_table on order_accepted.book_id=books_table.book_id";
                    $query=$query." inner join users on order_accepted.user_id=users.id having order_accepted.user_id='$user_id'";
                        $result=mysqli_query($connection,$query);
                        if(!$result)
                        {
                            die('error'.mysqli_error($connection));
                        }
                        else
                        {
                            ?>
                            <table>

                            <thead>
                           
                           <th>Id</th>
                           <th>Title</th>
                           <th>Author Name</th>
                           <th>Cost</th>
                           <th>Quantity</th>
                           
                           </thead>
                           
                           <tbody>
                               <?php
                                           while($row=mysqli_fetch_assoc($result))
                                           {
                           
                                               $book_id=$row['book_id'];
                                               
                                               $ordered_book_id=$book_id;
                                               $title=$row['title'];
                                               $author_name=$row['author_name'];
                                               $cost=$row['cost'];
                                               $quantity=$row['quantity'];
                                               ?>
                                           <tr>
                           
                                               <td><?php echo $book_id ?></td>
                                               <td><?php echo $title ?></td>
                                               <td><?php echo $author_name?></td>
                                               <td><?php echo $cost ?></td>
                                               <td><?php echo $quantity ?></td>
                           
                                           </tr>
                                                   <?php
                                      
                           
                                           
                           
                                               
                                           }
                                           ?>
                           </tbody>
                                            </table>

                                            <?php

                        }
                
                
                }
            }
        }





?>