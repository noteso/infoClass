<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "../php/config.php";
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
        $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$_GET['q']}'");
        if(mysqli_num_rows($sql) > 0 && mysqli_num_rows($sql1) > 0){
            $row = mysqli_fetch_assoc($sql);
            $row1 = mysqli_fetch_assoc($sql1);
        }else{
            header("Location: ../");
        }
    }
    else{
        header("Location: ../");
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
        <title>Class Settings || infoClass</title>
    </head>
    <body">

        <!-- Navbar -->

        <nav class="navbar sticky-top navbar-expand-lg bg-light">
            <div class="container-lg px-4"> 

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="menucanvas">
                <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand d-none d-lg-inline" href="../"><h2>info<span class="text-bg-primary rounded-2">Class</span></h2></a>

                <h2 class="text-primary">Profile</h2>

                <img src="../profilephotos/<?php echo $row['img'] ?>" style="width: 40px; height: 40px;" class="rounded-circle border border-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#profilecanvas" aria-controls="offcanvasExample">
            </div>
        </nav>

        <!-- Content -->

        <div class="container shadow-lg rounded">
            <div class="row justify-content-center" style="height: calc(100vh - 75px);">
                <div class="d-none d-lg-block col-lg-3 border-end border-secondary border-end-2 h-100">
                    <!--            
                    <a href="#" class="text-nowrap d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-chat-left-text"></i> Conversation</a>
                    <a href="#" class="d-block btn text-primary bg-light mb-2 text-start"><i class="bi bi-calendar4-week"></i> Tests</a>
                    <a href="#" class="d-block btn text-primary bg-light mb-2 text-start"><i class="bi bi-check2-square"></i> Homework</a> 

                    <hr class="m-0">

                    <a href="" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-gear-fill"></i> Class Settings</a>

                    <hr class="m-0">

                    -->
                    
                    <a href="../classrooms" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-globe-asia-australia"></i> Classrooms</a>
                </div>

                <div class="col col-sm-10 col-md-10 col-lg-8 overflow-auto" style="height: calc(100vh - 75px);">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="w-25 ratio ratio-1x1 mx-auto my-4 position-relative">
                                <img src="../profilephotos/<?php echo $row1['img']; ?>" class="img-fluid rounded-4">
                            </div>
                        </div>
                        <div class="col-12">
                            <h2 class="text-center text-primary"><?php echo $row1['fname'] . " " . $row1['lname']; ?></h2>
                            <h5 class="text-center text-muted">@<?php echo $row1['username']; ?></h5>
                        </div>
                        <?php
                            if($row1['show_bio'] == 1){
                                echo '<div class="col-10">
                                        <hr>
                                        <h3 class="text-primary text-center my-3">Bio</h3>
                                        <div class="m-2"><pre class="m-2 p-2 rounded-2" style="background-color:#ddd">' . $row1['bio'] .'</pre></div>
                                    </div>';
                            }
                            if($row1['show_email'] == 1){
                                echo '<div class="col-10">
                                            <hr>
                                            <h3 class="text-primary text-center my-3">Contact Email</h3>
                                            <h5 class="text-center my-3">' . $row1['email'] . '</h5>
                                        </div>';
                                
                            }
                            if($_SESSION['unique_id'] === $row1['unique_id']){
                                echo '<div class="col-10 d-flex justify-content-center my-4">
                                        <a href="../editprofile/" class="btn btn-primary bg-light text-primary border border-primary rounded-2 ">
                                        <div class="fw-bold"><i class="bi bi-sliders"></i> Edit Profile</div>    
                                        </a>
                                    </div>';
                            }
                        ?>
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Menu Offcanvas -->

        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="menucanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title ps-3 pt-3" id="offcanvasNavbarLabel">info<span class="text-bg-primary rounded-2">Class</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <hr class="m-0">
                <!--
                <a href="#" class="text-nowrap d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-chat-left-text"></i> Conversation</a>
                <a href="#" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-calendar4-week"></i> Tests</a>
                <a href="#" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-check2-square"></i> Homework</a>

                <hr class="m-0">

                <a href="#" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-gear-fill"></i> Class Settings</a>

                <hr class="m-0">
                        -->
                <a href="../classrooms/" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-globe-asia-australia"></i> Classrooms</a>
            </div>            
        </div>    
        
        <?php include_once "../php/profileoffcanvas.php" ?>
          
        <script>
            window.scrollTo(0, document.body.scrollHeight);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    </body>
</html>