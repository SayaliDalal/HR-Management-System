<?php 

require_once "../connection.php";

$id =  $_GET["id"];

$sql = "DELETE FROM employee WHERE id = $id ";

$result =mysqli_query($conn , $sql); 
 if($result){
        header("Location: manage-employee.php?delete-success-where-id=" .$id );
    }
    else{
        echo "ERROR: Could not able to execute $sql. "  . mysqli_error($conn);
    }

?>
