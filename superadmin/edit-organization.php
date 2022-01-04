
<?php
    require_once "include/header.php";
?>


<?php   
        require_once "../connection.php";
        $id = (isset($_GET['id']) ? $_GET['id'] : '');
        $sql = "SELECT * FROM organization WHERE id = $id ";
        $result = mysqli_query($conn , $sql);
    
        if(mysqli_num_rows($result) > 0 ){
           
            while($rows = mysqli_fetch_assoc($result) ){
                $orgname= $rows["orgname"];
                $email= $rows["email"];
                $empname = $rows["employername"];
                $address = $rows["address"];
                $contact= $rows["contact"];
                $website = $rows["website"];
                $gstno = $rows["gstno"];
            }
        }


        $orgnameErr = $emailErr = $passErr =  $addressErr = $empnameErr = $contactErr = $websiteErr = $gstnoErr ="";
       
        if( $_SERVER["REQUEST_METHOD"] == "POST" ){
 
            if( empty($_REQUEST["orgname"]) ){
                $orgnameErr = "<p style='color:red'> * Organization Name is required</p>";
                $orgname = "";
            }else {
                $orgname = $_REQUEST["orgname"];
            }

            if( empty($_REQUEST["email"]) ){
                $emailErr = "<p style='color:red'> * Organization Email is required</p> ";
                $email = "";
            }else{
                $email = $_REQUEST["email"];
            }

            if( empty($_REQUEST["pass"]) ){
                $passErr = "<p style='color:red'> * Password is required</p> ";
                $pass = "";
            }else{
                $pass = $_REQUEST["pass"];
            }
            if( empty($_REQUEST["address"]) ){
                $addressErr = "<p style='color:red'> * Address is required</p> ";
                $address ="";
            }else{
                $address = $_REQUEST["address"];
            }

            if( empty($_REQUEST["empname"]) ){
                $empnameErr = "<p style='color:red'> * Employer Name is required</p> ";
                $empname = "";
            }else{
                $empname = $_REQUEST["empname"];
            }
            if( empty($_REQUEST["contact"]) ){
                $contactErr = "<p style='color:red'> * Contact No. is required</p> ";
                $contact = "";
            }else{
                $contact = $_REQUEST["contact"];
            }

            if( empty($_REQUEST["website"]) ){
                $websiteErr = "<p style='color:red'> * Website URL is required</p> ";
                $website = "";
            }else{
                $website = $_REQUEST["website"];
            }
            if( empty($_REQUEST["gstno"]) ){
                $gstnoErr = "<p style='color:red'> * GST No. is required</p> ";
                $gstno ="";
            }else{
                $gstno = $_REQUEST["gstno"];
            }

            $sql_select_query = "SELECT email FROM organization WHERE email = '$email' ";
            $r = mysqli_query($conn , $sql_select_query);

            if(isset($_POST['save_changes'])){
            
               
                $orgname = mysqli_real_escape_string($conn, $_POST['orgname']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $empname = mysqli_real_escape_string($conn, $_POST['empname']);
                $contact = mysqli_real_escape_string($conn, $_POST['contact']);
                $address = mysqli_real_escape_string($conn, $_POST['address']);
                $website = mysqli_real_escape_string($conn, $_POST['website']);
                $gstno = mysqli_real_escape_string($conn, $_POST['gstno']);
               
            }
              
$result = mysqli_query($conn, "UPDATE `organization` SET `orgname`='$orgname',`email`='$email',`address`='$address',`employername`='$empname',`contact`='$contact',`website`='$website',`gstno`='$gstno' WHERE id=$id");

                   // $sql = "UPDATE admin SET orgname = '$orgname', email = '$email', address = '$address', employername= '$empname' , contact = '$contact', website = '$website', gstno =$gstno WHERE id = $id ";
                    //$result = mysqli_query($conn , $sql);
                    if($result){
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-organization.php');
                            $('#linkBtn').text('View Organization');
                            $('#addMsg').text('Profile Edit Successfully!');
                            $('#closeBtn').text('Edit Again?');
                        })
                     </script>
                     ";
                    }
    }           
?>
<div style=""> 
<div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-8">
                    <div class="form-input-content">
                        <div class="card login-form mb-4">
                            <div class="card-body pt-8 pb-4  shadow">                       
                                    <h4 class="text-center">Edit Organization Details</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                <div class="form-group">
                                    <label >Organization Name : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $orgname; ?>"  name="orgname" required>
                                   <?php echo $orgnameErr; ?>
                                </div>


                                <div class="form-group">
                                    <label >Email : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>"  name="email"required >     
                                    <?php echo $emailErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Password: &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="password" class="form-control" value="<?php echo $pass; ?>" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required> 
                                    <?php echo $passErr; ?>           
                                </div>

                                <div class="form-group">
                                    <label >Address : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $address; ?>"  name="address"required >
                                   <?php echo $addressErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Contact Person Name : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $empname; ?>"  name="empname" required>
                                   <?php echo $empnameErr; ?>
                                </div>
                                <div class="form-group">
                                    <label >Contact No. : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="tel" class="form-control" pattern="[6789][0-9]{9}" value="<?php echo $contact; ?>" name="contact"required >  
                                    <?php echo $contactErr; ?>            
                                </div>
                                <div class="form-group">
                                    <label >Website : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="url" class="form-control" value="<?php echo $website; ?>" name="website" required>  
                                    <?php echo $websiteErr; ?>            
                                </div>
                                <div class="form-group">
                                    <label >GST No. : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control"  pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" value="<?php echo $gstno; ?>"  name="gstno"required >
                                   <?php echo $gstnoErr; ?>
                                </div>

                                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group">
                                   <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes" >        
                                    </div>
                                    <div class="input-group">
                                         <a href="manage-organization.php" class="btn btn-primary w-20">Close</a>
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
