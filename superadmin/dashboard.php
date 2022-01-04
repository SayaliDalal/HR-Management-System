<?php 
require_once "include/header.php";
?>
<?php

        // database connection
        require_once "../connection.php";
      
            $i = 1;
        // total admin
        $select_organization = "SELECT * FROM organization";
        $total_organization = mysqli_query($conn , $select_organization);

       
?>

<div class="container">
    <div class="row mt-5" style=" display: flex,justify-content: center,align-items: center;">
        <div class="col-6" style=" padding-left:300px;">
            <div class="card shadow " style="width: 25rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center" style="background:#7571f9;"><b style="color:white;">Organization</b></li>
                    <li class="list-group-item">Total Organization : <?php echo mysqli_num_rows($total_organization); ?> </li>
                    <li class="list-group-item text-center"><a href="manage-organization.php"><b>View All Organization</b></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php 
require_once "include/footer.php";
?>