<?php 

require_once "include/header.php";
?>
 <?php  
    // databaseconnection
    require_once "../connection.php";

    $sql_command = "SELECT * FROM employee WHERE email = '$_SESSION[email_emp]' ";
    $result = mysqli_query($conn , $sql_command);

    if( mysqli_num_rows($result) > 0){
       while( $rows = mysqli_fetch_assoc($result) ){
            $fname = ucwords($rows["fname"]);
            $lname = ucwords($rows["lname"]);
            $gender = ucwords($rows["gender"]);
            $dob= $rows["dob"];
            $salary = $rows["salary"];   
            $dp = $rows["dp"];     
            $id = $rows["id"];
            $designation = $rows["designation"];
            $contact = $rows["contact"];
            $address = $rows["address"];
            $pancard = $rows["pancard"];
            $Joiningdate = $rows["Joiningdate"];
       }

       if( empty($gender)){
           $gender = "Not Defined";
       }else{
        $dob = date('jS F Y' , strtotime($dob) );
       }

       if( empty($dob)){
            $dob = "Not Defined";
            $age = "Not Defined";
        }else{
                $date1=date_create($dob);
                $date2=date_create("now");
                $diff=date_diff($date1,$date2);
                $age = $diff->format("%y Years"); 
        }
}
 ?>

<div class=container>
    <div class="row">
    <div class="col-2 ">
        </div>
    <div class="col-12 col-lg-8 col-md-6">
        <div class="x_panel">
            <div class="card-body card shadow">
            <div class="x_title text-center alert alert-info btn-info" >
              <h2>Personal Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="col-2 ">
        </div>
        <div  style=" text-align: center;">
           <img class="text-center rounded-circle " width="200" height="200" alt="100x100" src="upload/<?php if(!empty($dp)){ echo $dp; }else{ echo "1.jpg"; } ?>"data-holder-rendered="true">
        </div>
        <br>
            <div class="x_content">
              <table class="table">
                <tbody>
                  <tr>
                    <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                    <td><strong>Full Name</strong></td>
                    <td><?php echo $fname. " ".$lname; ?></td>
                   </tr>
                   <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-envelope"></i>
                        </td>
                        <td><strong>Email</strong></td>
                        <td> <?php echo $_SESSION["email_emp"] ?></td>
                    </tr>
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-user"></i>
                        </td>
                        <td><strong>Contact No.</strong></td>
                        <td> <?php echo $contact ?></td>
                    </tr>
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-birthday-cake"></i>
                        </td>
                        <td><strong>Date of Birth</strong></td>
                        <td><?php echo $dob ?></td>
                    </tr>
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-mars-double"></i>
                        </td>
                        <td><strong>Age</strong></td>
                        <td><?php echo $age ?></td>
                    </tr>
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-mars-double"></i>
                        </td>
                        <td><strong>Gender</strong></td>
                        <td><?php echo $gender ?></td>
                    </tr>
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-phone"></i>
                        </td>
                        <td><strong>Address</strong></td>
                        <td><?php echo $address ?></td>
                    </tr>
                   
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-calendar"></i>
                        </td>
                        <td><strong>Join date</strong></td>
                        <td><?php echo $Joiningdate ?></td>
                    </tr>
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-tasks"></i>
                        </td>
                        <td><strong>Designation</strong></td>
                        <td><?php echo $designation ?></td>
                    </tr>
                    
                </tbody>
            </table>    
            <p class="text-center">
                    <a href="edit-profile.php" class="btn btn-outline-primary">Edit Profile</a>
                    <a href="change-password.php" class="btn btn-outline-primary">Change Password</a>
                    <a href="profile-photo.php" class=" btn btn-outline-primary">Change profile photo</a>
                    </p> 
            </div>
          </div>
        </div>
        </div>

      <!---  <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="x_panel">
            <div class="x_title alert alert-info btn-info text-center">
              <h2>Bank Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table class="table">
                <tbody>
                <tr>
                    <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                    <td><strong>Account Holder </strong></td>
                    <td>{{ $user_details->first_name. ' '. $user_details->last_name }}</td>
                </tr>
                <tr>
                    <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                    <td><strong>Account Number</strong></td>
                    <td>{{ $user_details->account_number}}</td>

                </tr>
                <tr>
                    <td style="width: 10px" class="text-center"><i class="fa fa-credit-card"></i></td>
                    <td><strong>Pancard Number</strong></td>
                    <td><?php echo $pancard ?></td>

                </tr>
                <tr>
                    <td style="width: 10px" class="text-center"><i class="fa fa-tags"></i></td>
                    <td><strong>off Account Number</strong></td>
                    <td>15**********4846</td>
                </tr>
                <tr>
                    <td style="width: 10px" class="text-center"><i class="fa fa-universal-access"></i></td>
                    <td><strong>Bank Name</strong></td>
                    <td>{{ $user_details->bank_name}}</td>
                </tr>
                <tr>
                    <td style="width: 10px" class="text-center"><i class="fa fa-money"></i></td>
                    <td><strong>Salary Amount</strong></td>
                    <td> <?php echo $salary ?></td>
                </tr>
                <tr>
                    <td style="width: 10px" class="text-center"><i class="fa fa-code"></i></td>
                    <td><strong>Ifsc Code</strong></td>
                    <td>{{ $user_details->account_number}}</td>
                </tr>
                </tbody>
            </table>  
            </div>
          </div>
        </div>--->
      </div>
      
        <div class="col-12 col-lg-6 col-md-6" >
            <div style="width: 60rem;">
                   
            </div>
        </div>
    </div>
</div>
<?php 
require_once "include/footer.php";
?>