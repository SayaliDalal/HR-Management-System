
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
        $sql = "SELECT * FROM department WHERE id = $id ";
        $result = mysqli_query($conn , $sql);

        if(mysqli_num_rows($result) > 0 ){
        
            while($rows = mysqli_fetch_assoc($result) ){
               
                $department = $rows['deptname'];
               
                
            }
        }
        $departmentErr =  "";
      
       if( $_SERVER["REQUEST_METHOD"] == "POST" ){

           if( empty($_REQUEST["deptname"]) ){
               $departmentErr = "<p style='color:red'> * Department Name is required</p>";
           }else {
               $department = $_REQUEST["deptname"];
           }
           
            if( !empty($department) ){

                // database connection
                  require_once "../connection.php";
                     if(isset($_POST['submit'])) 
                    { 
                        $department = mysqli_real_escape_string($conn, $_POST['deptname']);
                       
                    }
                    $result = mysqli_query($conn, "UPDATE department SET `orgid` = $orgid , `deptname` = '$department' WHERE id = $id ");

                   
                    if($result){
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-dept.php');
                            $('#linkBtn').text('View Departments');
                            $('#addMsg').text('Department Edit Successfully!');
                            $('#closeBtn').text('Edit Again?');
                        })
                     </script>
                     ";
                    }

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
                                    <h4 class="text-center">Edit Department Details</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                               

                                <div class="form-group">
                                    <label >Department Name : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $department; ?>"  name="deptname" required>
                                   <?php echo $departmentErr; ?>
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

<?php 
    require_once "include/footer.php";
?>
