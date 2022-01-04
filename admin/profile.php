<?php 

require_once "include/header.php";
?>
 <?php  
 

    // databaseconnection
    require_once "../connection.php";

    $sql_command = "SELECT * FROM organization  WHERE email = '$_SESSION[email]' ";
    $result = mysqli_query($conn , $sql_command);

    if( mysqli_num_rows($result) > 0){
       while( $rows = mysqli_fetch_assoc($result) ){
           $orgname = ucwords($rows["orgname"]);
           $email = ucwords($rows["email"]);
           $address = $rows["address"];
           $empname = $rows["employername"];
           $contact = $rows["contact"];
           $website = $rows["website"];
           $gstno = $rows["gstno"];
            $dp = $rows["dp"];
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
              <h2>organization Details</h2>
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
                    <td><strong>Organization Name</strong></td>
                    <td><?php echo $orgname ?></td>
                   </tr>
                   <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-envelope"></i>
                        </td>
                        <td><strong>Email</strong></td>
                        <td> <?php echo $email ?></td>
                    </tr>
                   
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-user"></i>
                        </td>
                        <td><strong>Address</strong></td>
                        <td><?php echo $address ?></td>
                    </tr>
                    <tr>
                    <td style="width: 10px" class="text-center"><i class="fa fa-user"></i></td>
                    <td><strong>Employer Name</strong></td>
                    <td><?php echo $empname ?></td>
                   </tr>
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-phone"></i>
                        </td>
                        <td><strong>Contact No.</strong></td>
                        <td> <?php echo $contact ?></td>
                    </tr>
                   
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-tasks"></i>
                        </td>
                        <td><strong>Gst No.</strong></td>
                        <td><?php echo $gstno ?></td>
                    </tr>
                    <tr>
                        <td style="width: 10px" class="text-center"><i class="fa fa-home"></i>
                        </td>
                        <td><strong>Website</strong></td>
                        <td><?php echo $website ?></td>
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

</DIV>
<?php 
require_once "include/footer.php";
?>