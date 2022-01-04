<?php 
require_once "include/header.php";
?>
<?php

        // database connection
        require_once "../connection.php";
        require_once "../connection.php";
        $email= $_SESSION['email'];
        $sql="SELECT id FROM organization where email = '$email'";
        $result1=mysqli_query($conn, $sql);
        $admindata = mysqli_fetch_assoc($result1);
        $id=$admindata['id'];
            $i = 1;

        // total employee
        $select_emp = "SELECT * FROM employee  ";
        $total_emp = mysqli_query($conn , $select_emp);


        // highest paid employee
        $sql_highest_salary =  "SELECT * FROM employee WHERE orgid=$id ORDER BY salary DESC";
        $emp_ = mysqli_query($conn , $sql_highest_salary);
?>

<div class="container">    
   <div class="row bg-white shadow "> 
    <div class="col-12">
            <div class=" text-center my-3 "style="background:#7571f9;"> <h3 style="color:white;">Employee Leadership Board</h3> </div>
            <table class="table  table-hover">
        <thead>
            <tr class="bg-dark">
            <th scope="col">S.No.</th>
            <th scope="col">Employee's Id</th>
            <th scope="col">Employee's Name</th>
            <th scope="col">Employee's Email</th>
            <th scope="col">Salary in Rs.</th>
            </tr>
        </thead>
        <tbody>
        <?php while( $emp_info = mysqli_fetch_assoc($emp_) ){
                    $emp_id = $emp_info["id"];
                    $emp_fname = $emp_info["fname"];
                    $emp_lname = $emp_info["lname"];
                    $emp_email = $emp_info["email"];
                    $emp_salary = $emp_info["salary"];
                    ?>
            <tr>
            <th ><?php echo "$i. "; ?></th>
            <th ><?php echo $emp_id; ?></th>
            <td><?php echo $emp_fname." ".$emp_lname; ?></td>
            <td><?php echo $emp_email; ?></td>
            <td><?php echo $emp_salary; ?></td>
            </tr>

          <?php  
          $i++; 
                } 
            ?>
        </tbody>
        </table>
    </div>
    </div>
</div>

<?php 
require_once "include/footer.php";
?>