<?php 
    require_once "include/header.php";
?>
    
    <?php
    require_once "include/header.php";
?>


<?php  

        $orgnameErr = $emailErr = $passErr =  $addressErr = $empnameErr = $contactErr = $websiteErr = $gstnoErr ="";
        $orgname = $email = $pass = $address = $empname = $contact = $website = $gstno = "";

        if( $_SERVER["REQUEST_METHOD"] == "POST" ){

            if( empty($_REQUEST["orgname"]) ){
                $orgnameErr = "<p style='color:red'> * Organization Name is required</p>";
            }else {
                $orgname = $_REQUEST["orgname"];
            }

            if( empty($_REQUEST["email"]) ){
                $emailErr = "<p style='color:red'> * Organization Email is required</p> ";
            }else{
                $email = $_REQUEST["email"];
            }

            if( empty($_REQUEST["pass"]) ){
                $passErr = "<p style='color:red'> * Password is required</p> ";
            }else{
                $pass = $_REQUEST["pass"];
            }
            if( empty($_REQUEST["address"]) ){
                $addressErr = "<p style='color:red'> * Address is required</p> ";
            }else{
                $address = $_REQUEST["address"];
            }

            if( empty($_REQUEST["empname"]) ){
                $empnameErr = "<p style='color:red'> * Employer Name is required</p> ";
            }else{
                $empname = $_REQUEST["empname"];
            }
            if( empty($_REQUEST["contact"]) ){
                $contactErr = "<p style='color:red'> * Contact No. is required</p> ";
            }else{
                $contact = $_REQUEST["contact"];
            }

            if( empty($_REQUEST["website"]) ){
                $websiteErr = "<p style='color:red'> * Website URL is required</p> ";
            }else{
                $website = $_REQUEST["website"];
            }
            if( empty($_REQUEST["gstno"]) ){
                $gstnoErr = "<p style='color:red'> * GST No. is required</p> ";
            }else{
                $gstno = $_REQUEST["gstno"];
            }
    
            if( !empty($orgname) && !empty($email) && !empty($pass) && !empty($address) && !empty($empname) && !empty($contact) && !empty($website) && !empty($gstno)){

                // database connection
                require_once "../connection.php";

                $sql_select_query = "SELECT orgname FROM organization WHERE email = '$email' ";
                $r = mysqli_query($conn , $sql_select_query);

                if( mysqli_num_rows($r) > 0 ){
                    $orgnameErr = "<p style='color:red'> * Organization Already Register</p>";
                } else{

                    $sql = "INSERT INTO organization (  orgname, email , password  , address , employername , contact , website , gstno ) VALUES( '$orgname' , '$email' , '$pass' , '$address' , '$empname' , '$contact' , '$website' , '$gstno' )  ";
                    $result = mysqli_query($conn , $sql);
                    if($result){
                        $orgname = $email = $pass = $address = $empname = $contact = $website = $gstno = "";

                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-organization.php');
                            $('#linkBtn').text('View Organization');
                            $('#addMsg').text('Organization Added Successfully!');
                            $('#closeBtn').text('Add More?');
                        })
                     </script>
                     ";
                }

            }
        }
    }

?>

<div style=""> 
<div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-8">
                    <div class="form-input-content">
                        <div class="card login-form  mb-4">
                            <div class="card-body pt-8 pb-4 shadow">                       
                                    <h4 class="text-center">Add Organization Details</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >Organization Name :  &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $orgname; ?>"  name="orgname" required>
                                   <?php echo $orgnameErr; ?>
                                </div>


                                <div class="form-group">
                                    <label >Email : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>"  name="email" required >     
                                    <?php echo $emailErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Password: &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="password" class="form-control" value="<?php echo $pass; ?>" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required> 
                                    <?php echo $passErr; ?>           
                                </div>

                                <div class="form-group">
                                    <label >Address : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $address; ?>"  name="address" required>
                                   <?php echo $addressErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Contact Person Name : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control" value="<?php echo $empname; ?>"  name="empname" required>
                                   <?php echo $empnameErr; ?>
                                </div>
                                <div class="form-group">
                                    <label >Contact No. : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="tel" class="form-control"  pattern="[6789][0-9]{9}" value="<?php echo $contact; ?>" name="contact"required >  
                                    <?php echo $contactErr; ?>            
                                </div>
                                <div class="form-group">
                                    <label >Website :  &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="url" class="form-control" value="<?php echo $website; ?>" name="website"required >  
                                    <?php echo $websiteErr; ?>            
                                </div>
                                <div class="form-group">
                                    <label >GST No. : &nbsp <span style="color:#ff0000">*</span></label>
                                    <input type="text" class="form-control"  pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" value="<?php echo $gstno; ?>"  name="gstno"required >
                                   <?php echo $gstnoErr; ?>
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary btn-block">Add</button>
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


<?php 
    require_once "include/footer.php";
?>