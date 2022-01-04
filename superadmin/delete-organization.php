<?php 

require_once "../connection.php";

$id =  $_GET["id"];

$sql = "DELETE FROM organization WHERE id = $id ";

mysqli_query($conn , $sql); 

header("Location: manage-organization.php?delete-success-where-id=" .$id );


?>
