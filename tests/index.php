<?php

    session_start();
    include_once "../php/config.php";

    if(isset($_SESSION['unique_id'])){
        $sql = mysqli_query($conn, "SELECT * FROM members WHERE user_unique_id='{$_SESSION['unique_id']}' AND classroom_unique_id='{$_GET['c']}'");
        if(mysqli_num_rows($sql) > 0){
            $sql2 = mysqli_query($conn, "SELECT * FROM classrooms WHERE class_unique_id='{$_GET['c']}'");
            if(mysqli_num_rows($sql2) > 0){
                $row = mysqli_fetch_assoc($sql2);
                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id='{$_SESSION['unique_id']}'");
                if(mysqli_num_rows($sql2) > 0){
                    $row2 = mysqli_fetch_assoc($sql3);
                }else{
                    header("Location:../");
                }
            }else{
                header("Location:../");
            }
        }else{
            header("Location:../");
        }
    }else{
        header("Location:../");
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
        <title>Tests || infoClass</title>
    </head>
    <body>

        <!-- Navbar -->

        <nav class="navbar sticky-top navbar-expand-lg bg-light">
            <div class="container-lg px-4"> 

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="menucanvas">
                <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand d-none d-lg-inline" href="../"><h2>info<span class="text-bg-primary rounded-2">Class</span></h2></a>

                <h2 class="text-primary"><?php echo $row['class_name'] ?></h2>

                <img src="../profilephotos/<?php echo $row2['img'] ?>" style="width: 40px; height: 40px;" class="rounded-circle border border-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#profilecanvas" aria-controls="offcanvasExample">
                 
            </div>
        </nav>

        <!-- Content -->

        <div class="container shadow-lg rounded">
            <div class="row justify-content-center" style="height: calc(100vh - 75px);">
                <div class="d-none d-lg-block col-lg-3 border-end border-secondary border-end-2">
                    <a href="../conversation/?c=<?php echo $_GET['c']; ?>" class="text-nowrap d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-chat-left-text"></i> Conversation</a>
                    <a href="../tests/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light fw-bold border border-primary  mb-2 text-start"><i class="bi bi-calendar4-week"></i> Tests</a>
                    <a href="../homework/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light mb-2 text-start"><i class="bi bi-check2-square"></i> Homework</a> 

                    <hr class="m-0">

                    <a href="../classsettings/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-gear-fill"></i> Class Settings</a>

                    <hr class="m-0">
                    
                    <a href="../classrooms" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-globe-asia-australia"></i> Classrooms</a>

                </div>



                <div class="col col-sm-10 col-md-10 col-lg-8" style="height: calc(100vh - 75px);">
                    <div class="overflow-auto pb-5" style="height: calc(100vh - 140px);" id="testholder">
                        
                    </div>
                    
                    <div class="d-flex justify-content-center bg-light sticky-bottom" style="height: 65px;">
                        <button class="btn btn-primary bg-light text-primary border border-primary rounded-2 h-75 my-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvastest" aria-controls="offcanvastest">
                            <div class="fw-bold"><i class="bi bi-plus-lg"></i> Book Test</div>    
                        </button>
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
                <a href="../conversation/?c=<?php echo $_GET['c']; ?>" class="text-nowrap d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-chat-left-text"></i> Conversation</a>
                <a href="../tests/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light fw-bold border border-primary  my-3 text-start"><i class="bi bi-calendar4-week"></i> Tests</a>
                <a href="../homework/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-check2-square"></i> Homework</a>

                <hr class="m-0">

                <a href="../classsettings/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-gear-fill"></i> Class Settings</a>

                <hr class="m-0">

                <a href="../classrooms" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-globe-asia-australia"></i> Classrooms</a>
            </div>            
        </div>    
        
        <?php include_once "../php/profileoffcanvas.php" ?>

        <?php include_once "../php/booktestsnip.php" ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

        <script src="./js/booktest.js"></script>
        <script src="./js/gettest.js"></script>

    </body>
</html>