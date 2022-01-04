<?php 
require_once "include/header.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>

<?php 
      $old_passErr = $new_passErr = $confirm_passErr = "";
     $old_pass = $new_pass = $confirm_pass = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($_REQUEST["old_pass"])){
            $old_passErr = " <p style='color:red'>* Old Password Is required </p>";
        }else{
            $old_pass = trim($_REQUEST["old_pass"]);
        }
        
        if(empty($_REQUEST["new_pass"])){
            $new_passErr = " <p style='color:red'>* New Password Is required </p>";
        }else{
            $new_pass = trim($_REQUEST["new_pass"]);
        }

        if(empty($_REQUEST["confirm_pass"])){
            $confirm_passErr = " <p style='color:red'>* Please Confirm new Password! </p>";
        }else{
            $confirm_pass = trim($_REQUEST["confirm_pass"]);
        }

        if(!empty($old_pass) && !empty($new_pass) && !empty($confirm_pass) ){

            require_once "../connection.php";

            $check_old_pass = "SELECT password FROM employee WHERE email = '$_SESSION[email_emp]' && password = '$old_pass' ";
            $result = mysqli_query($conn , $check_old_pass);
            if( mysqli_num_rows($result) > 0 ){
               
                if( $new_pass === $confirm_pass ){
                  
                    $change_pass_query = "UPDATE employee SET password = '$new_pass' WHERE email = '$_SESSION[email_emp]' ";
                    if (mysqli_query($conn , $change_pass_query) ){
                        session_unset();
                        session_destroy();
                        echo "<script>
                        $(document).ready(function() {
                            $('#addMsg').text( 'Password Updated successfully! Log in With New Password');
                            $('#linkBtn').attr('href','../login.php');
                            $('#linkBtn').text('OK, Understood');
                            $('#modalHead').hide();
                            $('#closeBtn').hide();
                            $('#showModal').modal('show');
                        });
                        </script>";
                    }
                    
                }else{
                    $confirm_passErr = "<p style='color:red'>* Confirm Password did not matched new Password! </p>";
                }

            }else{
               $old_passErr = " <p style='color:red'>*Sorry! Old Password is Wrong </p> ";
            }
        }
    }
?>


<div style="margin-top:100px"> 
<div class="login-form-bg h-100">
        <div class="container mt-5 h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">                       
                                    <h4 class="text-center">Change Password</h4>
                                    <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                        <div class="form-group">
                                            <label >Old Password : &nbsp <span style="color:#ff0000">*</span></label>
                                            <input type="password" name="old_pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                            <?php echo $old_passErr; ?>
                                        </div>
                                        <div class="form-group">
                                            <label >New Password : &nbsp <span style="color:#ff0000">*</span></label>
                                            <input type="password" name="new_pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                            <?php echo $new_passErr; ?>

                                        </div>
                                        <div class="form-group">
                                            <label >Confirm Password : &nbsp <span style="color:#ff0000">*</span></label>
                                            <input type="password" name="confirm_pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Confirm password should be same as New password" required>
                                            <?php echo $confirm_passErr; ?>

                                        </div>
                
                                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group">
                                        <input type="submit" value="Update Password" class="btn btn-primary w-20 " name="save_changes" >        
                                            </div>
                                            <div class="input-group">
                                                <a href="profile.php" class="btn btn-primary w-20">Close</a>
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