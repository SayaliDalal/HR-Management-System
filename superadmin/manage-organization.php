<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "../connection.php";

$sql = "SELECT * FROM organization";
$result = mysqli_query($conn , $sql);

$i = 1;
$you = "";


?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 10px;
}
table {
  border-spacing: 5px;
}
</style>

<div class="container bg-white shadow" style="width:100%">
    <div class="py-4 mt-5"> 
    <div class='text-center pb-2'><h4>View Organizations </h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Organization Name</th>
        <th>Email</th> 
        <th>Employer Name</th>
        <th>Address</th>
        <th>Contact No.</th>
        <th>Website</th>
        <th>GST No.</th>
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){  
            $orgname= $rows["orgname"];
            $email= $rows["email"];
            $empname = $rows["employername"];
            $address = $rows["address"];
            $contact= $rows["contact"];
            $website = $rows["website"];
            $gstno = $rows["gstno"];
            $id = $rows["id"];
    ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $orgname; ?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $empname; ?></td>
        <td><?php echo $address; ?></td>
        <td><?php echo $contact; ?></td>
        <td><?php echo $website; ?></td>
        <td><?php echo $gstno; ?></td>
        <td>   <?php if( $email !== $_SESSION["email"] ){
                $edit_icon = "<a href='edit-organization.php?id= {$id}'  class='btn-sm btn-primary float-right mr-4'> <span ><i class='fa fa-edit '></i></span> </a>";
                $delete_icon = " <a onClick=\"javascript: return confirm('Are you sure you want to delete organization?');\"  href='delete-organization.php?id={$id}' id='bin' class='btn-lg  float-right mr-3' style='color:red;'> <span ><i class='fa fa-trash '></i></span> </a>";
                echo $edit_icon . $delete_icon;
            } else{
                echo "<a href='dashboard.php' class='btn btn-primary float-right mr-5'>Profile</a>";
            } ?> 
        </td>

    <?php 
            $i++;
            }
        }else{
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#addMsg').text('No Organization added by you!!');
                $('#linkBtn').attr('href', 'add-organization.php');
                $('#linkBtn').text('Add Organization');
                $('#closeBtn').text('Remind Me Later!');
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