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
               
         $departmentErr = "";
         $department = "";
       
       
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){


            if( empty($_REQUEST["department"]) ){
                $departmentErr = "<p style='color:red'> * Department Name is required</p>";
            }else {
                $department = $_REQUEST["department"];
            }

            
            if( !empty($department) ){

                // database connection
                  require_once "../connection.php";
                     if(isset($_POST['submit']))
                    { 
                        $department = $_POST['department'];
                      
                    }
                    $sql = "INSERT INTO department( orgid,deptname ) VALUES( $orgid,'$department' )  ";
                    $result = mysqli_query($conn , $sql);
                    if($result){
                        $department = "";
                       
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-dept.php');
                            $('#linkBtn').text('View Departments');
                            $('#addMsg').text('Department Added Successfully!');
                            $('#closeBtn').text('Add More?');
                        })
                     </script>
                     ";
                }
                else{
                    echo "<script>
                    $(document).ready( function(){
                        $('#showModal').modal('show');
                        $('#modalHead').hide();
                        $('#linkBtn').attr('href', 'add-dept.php');
                        $('#linkBtn').text('View Departments');
                        $('#addMsg').text('Department is already created!!');
                        $('#closeBtn').text('Add More?');
                    })
                 </script>
                 ";
                }

            
        }
    }

?>



<div style=""> 
<div class="login-form-bg h-100">
        <div class="container  h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-10">
                    <div class="form-input-content">
                        <div class="card login-form mb-4">
                            <div class="card-body pt-8 pb-4 shadow">                       
                                    <h4 class="text-center">Add Department</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                <div class="form-group">
                                    <label >Department Name : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $department; ?>"  name="department" required>
                                   <?php echo $departmentErr; ?>
                                </div>
                              
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Add</button>
                                <br>
                                <a href="./manage-dept.php"> <input type="button"  class="btn btn-primary" value="Back"></a>
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
