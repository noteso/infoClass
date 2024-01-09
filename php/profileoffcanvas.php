<!-- Profile Offcanvas -->

<?php

    include_once "config.php";
    if(isset($_SESSION['unique_id'])){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id='{$_SESSION['unique_id']}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
        }
    }else{
        header("Location:../");
    }

?>

<div class="offcanvas offcanvas-end" tabindex="-1" id="profilecanvas" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?php echo $row['fname'] . " " . $row['lname'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <a href="../profile/<?php echo "?q=" . $row['username']  ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-person-fill"></i> View Profile</a>

        <a href="../editprofile/" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-sliders"></i> Edit profile</a>

        <hr class="m-0">

        <a href="../php/logout.php" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-box-arrow-left"></i> Logout</a>

    </div>
</div>