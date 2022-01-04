<?php 
    require_once "include/header.php";
?>

<?php  
        require_once "../connection.php";
      
        $email= $_SESSION['email'];
        $sql1="SELECT id FROM organization where email = '$email'";
        $result1=mysqli_query($conn, $sql1);
        $admindata = mysqli_fetch_assoc($result1);
        $orgid=$admindata['id'];

        $id = (isset($_GET['id']) ? $_GET['id'] : '');
        $sql = "SELECT * FROM employee WHERE id = $id ";
        $result = mysqli_query($conn , $sql);

        if(mysqli_num_rows($result) > 0 ){
        
            while($rows = mysqli_fetch_assoc($result) ){
                $fname = $rows["fname"];
                $lname = $rows["lname"];
                $email = $rows["email"];
                $dob = $rows["dob"];
                $gender = $rows["gender"];
                $salary = $rows["salary"];
                $designation = $rows["designation"];
                $contact = $rows["contact"];
                $address = $rows["address"];
                $pancard = $rows["pancard"];
                $Joiningdate = $rows["Joiningdate"];
               
            }
        }

        $passErr = $fnameErr = $lnameErr = $emailErr  = $salaryErr = $addressErr = $pancardErr = $contactErr = $designationErr  = "";
      
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){

            if( empty($_REQUEST["gender"]) ){
                $gender ="";
            }else {
                $gender = $_REQUEST["gender"];
            }

            if( empty($_REQUEST["Joiningdate"]) ){
                $Joiningdate = "";
            }else {
                $Joiningdate = $_REQUEST["Joiningdate"];
            }

            if( empty($_REQUEST["dob"]) ){
                $dob = "";
            }else {
                $dob = $_REQUEST["dob"];
            }
            if( empty($_REQUEST["pass"]) ){
                $passErr = "<p style='color:red'> * Password is required</p> ";
                $pass = "";
            }else{
                $pass = $_REQUEST["pass"];
            }
            if( empty($_REQUEST["fname"]) ){
                $fnameErr = "<p style='color:red'> * First Name is required</p>";
            }else {
                $fname = $_REQUEST["fname"];
            }

            if( empty($_REQUEST["lname"]) ){
                $lnameErr = "<p style='color:red'> * Last Name is required</p>";
            }else {
                $lname = $_REQUEST["lname"];
            }

            if( empty($_REQUEST["salary"]) ){
                $salaryErr = "<p style='color:red'> * Salary is required</p>";
                $salary = "";
            }else {
                $salary = $_REQUEST["salary"];
            }

            if( empty($_REQUEST["email"]) ){
                $emailErr = "<p style='color:red'> * Email is required</p> ";
            }else{
                $email = $_REQUEST["email"];
            }
           if( empty($_REQUEST["address"]) ){
                $addressErr = "<p style='color:red'> * Address is required</p> ";
            }else{
                $address = $_REQUEST["address"];
            }

            if( empty($_REQUEST["designation"]) ){
                $designationErr = "<p style='color:red'> * Designation is required</p> ";
            }else{
                $designation = $_REQUEST["designation"];
            }

            if( empty($_REQUEST["contact"]) ){
                $contactErr = "<p style='color:red'> * Contact Number is required</p> ";
            }else{
                $contact = $_REQUEST["contact"];
            }

            if( empty($_REQUEST["pancard"]) ){
                $pancardErr = "<p style='color:red'> * Pancard Number is required</p> ";
            }else{
                $pancard = $_REQUEST["pancard"];
            }
         

            if( !empty($fname) && !empty($lname) && !empty($email) && !empty($pass) && !empty($salary) && !empty($address) && !empty($pancard) && !empty($contact)  && !empty($designation)  ){


                // database connection
                require_once "../connection.php";

                $sql_select_query = "SELECT email FROM employee WHERE email = '$email' ";
                $r = mysqli_query($conn , $sql_select_query);

                if(isset($_POST['save_changes'])){
                    $fname =mysqli_real_escape_string($conn, $_POST['fname']);
                    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $dob =  mysqli_real_escape_string($conn, $_POST['dob']);
                    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
                    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
                    $designation =  mysqli_real_escape_string($conn, $_POST['designation']);
                    $contact =  mysqli_real_escape_string($conn, $_POST['contact']);
                    $address = mysqli_real_escape_string($conn, $_POST['address']);
                    $pancard =  mysqli_real_escape_string($conn, $_POST['pancard']);
                    $Joiningdate =  mysqli_real_escape_string($conn, $_POST['Joiningdate']);
                                     
                }
              $result = mysqli_query($conn, "UPDATE employee SET `fname` = '$fname' , `lname` = '$lname' ,`email` = '$email', `salary`='$salary', `dob`='$dob', `gender`='$gender' , `contact`='$contact' , `address`='$address' , `pancard`='$pancard' , `designation`= '$designation' , `Joiningdate`='$Joiningdate' ,`orgid`=$orgid  WHERE id = $id ");

                    if($result){
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-employee.php');
                            $('#linkBtn').text('View Employees');
                            $('#addMsg').text('Profile Edit Successfully!');
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
        <div class="container  h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-8">
                    <div class="form-input-content">
                        <div class="card login-form mb-4">
                            <div class="card-body pt-8 pb-4 shadow">                       
                                    <h4 class="text-center">Edit Employee profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >First Name : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $fname; ?>"  name="fname" required>
                                   <?php echo $fnameErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Last Name : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $lname; ?>"  name="lname" required>
                                   <?php echo $lnameErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Email : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>"  name="email" required>     
                                    <?php echo $emailErr; ?>
                                </div>
                                <div class="form-group">
                                    <label >Password : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="password" class="form-control" value="<?php echo $pass; ?>" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required > 
                                    <?php echo $passErr; ?>           
                                </div>
                                <div class="form-group">
                                    <label >Salary : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="number" class="form-control" min="0"  value="<?php echo $salary; ?>" name="salary"required >  
                                    <?php echo $salaryErr; ?>            
                                </div>

                                <div class="form-group">
                                    <label >Date-of-Birth : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="date" class="form-control" max="2003-12-31" value="<?php echo $dob; ?>" name="dob"required >   
                                </div>

                                <div class="form-group form-check form-check-inline">
                                    <label class="form-check-label" >Gender : &nbsp <span style="color:#ff0000">*</span></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Male" ){ echo "checked"; } ?>  value="Male"  selected>
                                    <label class="form-check-label" >Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Female" ){ echo "checked"; } ?>  value="Female">
                                    <label class="form-check-label" >Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "Other" ){ echo "checked"; } ?>  value="Other">
                                    <label class="form-check-label" >Other</label>
                                </div>

                                <div class="form-group">
                                    <label >Contact No. : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="tel" class="form-control" pattern="[6789][0-9]{9}" value="<?php echo $contact; ?>" name="contact" required >  
                                    <?php echo $contactErr; ?>            
                                </div>

                                <div class="form-group">
                                    <label >Address : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $address; ?>" name="address" required >  
                                    <?php echo $addressErr; ?>            
                                </div>

                                <div class="form-group">
                                    <label >Pancard No. : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $pancard; ?>" name="pancard" pattern = "^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$"required >  
                                    <?php echo $pancardErr; ?>            
                                </div>

                                <div class="form-group">
                                    <label >Designation : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $designation; ?>" name="designation" required>  
                                    <?php echo $designationErr; ?>            
                                </div>

                                <div class="form-group">
                                    <label >Joining Date : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="date" class="form-control" value="<?php echo $Joiningdate; ?>" name="Joiningdate" required> 
                                </div>
                                
                                <br>

                                <button type="submit" name="save_changes" class="btn btn-primary btn-block">Update</button>
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
