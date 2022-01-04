

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
$sql = "SELECT * FROM employee where orgid= $id";
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

<div class="container bg-white shadow">
    <div class="py-4 mt-5"> 
    <div class='text-center pb-2'><h4>Employees List</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Employee Id</th>
        <th>Name</th>
        <th>Email</th> 
        <th>Gender</th>
        <th>Contact No.</th>
        <th>Date of Birth</th>
        <th>Age</th>
        <th>Salary in Rs</th>
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $fname= $rows["fname"];
            $lname= $rows["lname"];
            $dp= $rows["dp"];
            $email= $rows["email"];
            $contact= $rows["contact"];
            $dob = $rows["dob"];
            $gender = $rows["gender"];
            $id = $rows["id"];
            $salary = $rows["salary"];
            $orgid=$rows["orgid"];
            if($gender == "" ){
                $gender = "Not Defined";
            } 

            if($dob == "" ){
                $dob = "Not Defined";
                $age = "Not Defined";
            }else{
               // $dob = date('jS F, Y' , strtotime($dob));
                $date1=date_create($dob);
                $date2=date_create("now");
                $diff=date_diff($date1,$date2);
                $age = $diff->format("%Y"); 
                
            }

            if($salary== "" ){
                $salary= "Not Defined";
            }   
        
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td><?php echo $id; ?></td>
		<td><?php echo $fname. " ".$lname; ?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $gender; ?></td>
        <td><?php echo $contact; ?></td>
        <td><?php echo $dob; ?></td>
        <td><?php echo $age; ?></td>
        <td><?php echo $salary; ?></td>

        <td>  <?php 
                $edit_icon = "<a href='edit-employee.php?id= {$id}' class='btn-sm btn-primary float-right mr-4'> <span ><i class='fa fa-edit '></i></span> </a>";
                $delete_icon = " <a onClick=\"javascript: return confirm('Are you sure you want to delete an employee?');\" href='delete-employee.php?id={$id}' id='bin' class='btn-lg  float-right mr-3' style='color:red;'> <span ><i class='fa fa-trash '></i></span> </a>";
                echo $edit_icon . $delete_icon;
             ?> 
        </td>

    <?php 
            $i++;
            }
        }else{
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#linkBtn').attr('href', 'add-employee.php');
                $('#linkBtn').text('Add Employee');
                $('#addMsg').text('No Employees added by you!!');
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
