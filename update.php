
<?php include 'functions.php'?>
<!DOCTYPE html>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="functions.css" rel="stylesheet"/>
</head>
<body>






  
</body>
</html>

<?php

  


 if(isset($_GET['book_id']))
{
  
  $book_id=$_GET['book_id'];
  $title=$_GET['title'];

  $author_name=$_GET['author_name'];
  $cost=$_GET['cost'];
  $quantity=$_GET['quantity'];
  showupdatebooks($book_id,$title,$author_name,$cost,$quantity);

  



  

 
  
 

}

if(isset($_GET['title']))
{
  global $connection;

  $book_id=$_GET['book_id'];

  $title=$_POST['Title'];
  $author_name=$POST['Author_Name'];
  $cost=$_POST['Cost'];
  $quantity=$POST['Quantity'];

 $query= "update books_table set book_id='$book_id',title='$title',author_name='$author_name',cost='$cost',quantity='$quantity'
  where book_id='$book_id'";

  $result=mysqli_query($connection,$query);
  if(!$result)
  {
    die('error'.mysqli_error($connection));
  }
  else
  {
    echo $book_id;
    echo 'book data updated';

  //  header('Location:admin--content.php');

}
}



?>