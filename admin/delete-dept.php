<?php 

require_once "../connection.php";

$id =  $_GET["id"];

$sql = "DELETE FROM department WHERE id = $id ";

$result=mysqli_query($conn , $sql); 
if($result){
   
    header("Location: manage-dept.php?delete-success-where-id=" .$id );
}




?>
