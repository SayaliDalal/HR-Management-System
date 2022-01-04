<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "../connection.php";
$email= $_SESSION['email'];
$sql="SELECT id FROM organization where email = '$email'";
$result1=mysqli_query($conn, $sql);
$admindata = mysqli_fetch_assoc($result1);
$id=$admindata['id'];
$sql = "SELECT * FROM department where orgid=$id";
$result = mysqli_query($conn , $sql);


$i = 1;
$you = "";


?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>
<a href="./add-dept.php"> <input type="button"  class="btn btn-primary" value="Add Department"></a>
                                  
<div class="container bg-white shadow">
    <div class="py-4 mt-5"> 
    <div class='text-center pb-2'><h4>View Department</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Organization ID</th>
        <th>Department Name</th>
      
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $deptname= $rows["deptname"];
            $orgid = $rows["orgid"];
           
            $id = $rows["id"];
            
            ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $orgid; ?></td>
        <td><?php echo $deptname; ?></td>
       
       
        <td>   <?php 
                $add_icon = "<a href='add-emp.php?id= {$id}'class='btn-lg btn-primary float-center mr-4'> <span ><i class='fa fa-plus '></i></span> </a>";
                $edit_icon = "<a href='edit-dept.php?id= {$id}'class='btn-lg btn-primary float-center mr-4'> <span ><i class='fa fa-edit '></i></span> </a>";
                $delete_icon = " <a onClick=\"javascript: return confirm('Are you sure you want to delete department ?');\" href='delete-dept.php?id={$id}' id='bin' class='btn-lg  float-center ' style='color:red;'> <span ><i class='fa fa-trash '></i></span> </a>";
                echo  $add_icon . $edit_icon . $delete_icon ;
          ?> 
        </td>

    <?php 
            $i++;
            }
        }else{
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#addMsg').text('No department added by you!!');
                $('#linkBtn').attr('href', 'add-dept.php');
                $('#linkBtn').text('Add New department');
                $('#closeBtn').text('Remind me Later');
            })
        </script>
        ";
        }
    ?>
     </tr>
    </table>
    </div>
</div>


<?php 
    require_once "include/footer.php";
?>
