


<?php 

class books
{
 var  $book_id;
 var $title;
 var $author_name;
 var $cost;
 var $quantity;


 function __construct($book_id,$title,$author_name,$cost,$quantity)
{
  $this->book_id=$book_id;
  $this->title=$title;
  $this->author_name=$author_name;
  $this->cost=$cost;
  $this->quantity=$quantity;
}



}
?>


