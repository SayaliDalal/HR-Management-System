
<?php
    require_once "include/header.php";
?>


<?php   
        require_once "../connection.php";
        $email= $_SESSION['email'];
        $sql="SELECT id FROM organization where email = '$email'";
        $result1=mysqli_query($conn, $sql);
        $admindata = mysqli_fetch_assoc($result1);
        $orgid=$admindata['id'];

        $id = (isset($_GET['id']) ? $_GET['id'] : '');
        $sql = "SELECT * FROM employee where depid=$id";
        $result1 = mysqli_query($conn , $sql);
        $i = 1;
       
     

                // database connection
                  require_once "../connection.php";
                     if(isset($_POST['submit'])) 
                    {  
                        $empids = $_POST['empemail'];
                        foreach($empids as $item)
                        {                         
                            $result = mysqli_query($conn, "UPDATE employee SET `depid` = $id  WHERE email = '$item' ");
                          
                        }
                        if($result){
                           
                            echo "<script>
                            $(document).ready( function(){
                                $('#showModal').modal('show');
                                $('#modalHead').hide();
                                $('#linkBtn').attr('href', 'manage-dept.php');
                                $('#linkBtn').text('View Employees');
                                $('#addMsg').text('Employee added to department successfully!');
                                $('#closeBtn').text('Add Again?');
                            })
                         </script>
                         ";
                        }
                    }
?>



<div style=""> 
<div class="login-form-bg h-100">
        <div class="container mt-5 h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">                       
                                    <h4 class="text-center">Add Employee to Department</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                               
                                <div class=" form-group">
                                    <label >Employee Email : &nbsp <span style="color:#ff0000">*</span></label>
                                    <select class="js-example-basic-multiple form-control mb-3" name= "empemail[]" multiple="multiple" >
                                 
                                        <?php
                                          require_once "../connection.php";
                                          $sqlquery="SELECT * FROM employee where orgid = '$orgid'";
                                          $resultemp=mysqli_query($conn, $sqlquery);
                                          if( mysqli_num_rows($resultemp) > 0){
                                            while( $rows = mysqli_fetch_assoc($resultemp) ){
                                               ?>
                                                <option value= "<?=$rows['email'];?>"><?=$rows['email'];?></option>
                                                <?php
                                            }
                                        }

                                        ?>
                                       
                                    </select>
                                 
                                </div>

                                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group">
                                   <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="submit" >        
                                    </div>
                                    <div class="input-group">
                                         <a href="manage-dept.php" class="btn btn-primary w-20">Close</a>
                                    </div>
                                </div>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                  
<div class="container bg-white shadow">
    <div class="py-4 mt-5"> 
    <div class='text-center pb-2'><h4>View Employees</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Employee Email</th>
    </tr>
    <?php
    if( mysqli_num_rows($result1) > 0){
        while( $rows = mysqli_fetch_assoc($result1) ){
            $emails= $rows["email"];
    ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $emails; ?></td>
        <?php 
         $i++;
       // $sql = "CREATE TRIGGER after_update_emp AFTER UPDATE ON employee FOR EACH ROW  UPDATE department SET NEW.noemp = $i where depid= $id;";

         //mysqli_query($conn,$sql);
         
            }
        }
    ?>
        </tr>
    </table>
    </div>
</div>
<?php 
    require_once "include/footer.php";
?>
