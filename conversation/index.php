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
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
        <title>Coversation || infoClass</title>
    </head>
    <body">

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
                <div class="d-none d-lg-block col-lg-3 border-end border-secondary border-end-2 h-100">
                    <a href="../conversation/?c=<?php echo $_GET['c']; ?>" class="text-nowrap d-block btn text-primary bg-light fw-bold border border-primary my-3 text-start"><i class="bi bi-chat-left-text"></i> Conversation</a>
                    <a href="../tests/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light mb-2 text-start"><i class="bi bi-calendar4-week"></i> Tests</a>
                    <a href="../homework/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light mb-2 text-start"><i class="bi bi-check2-square"></i> Homework</a> 

                    <hr class="m-0">

                    <a href="../classsettings/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-gear-fill"></i> Class Settings</a>

                    <hr class="m-0">
                    
                    <a href="../classrooms" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-globe-asia-australia"></i> Classrooms</a>

                </div>



                <div class="col col-sm-10 col-md-10 col-lg-8" style="height: calc(100vh - 75px);">
                    <div class="overflow-auto d-flex flex-column-reverse pb-5" style="height: calc(100vh - 140px);" id="messageholder">
                        
                    </div>
                    <form class="border-top bg-light sticky-bottom row justify-content-around align-items-center" style="height: 65px;" id="messageform">
                        <div class="col-9 col-lg-8 h-75">
                            <input type="text" name="message" id="message" placeholder="Enter your message..." class="form-control border-0 outline-none shadow-none rounded-pill h-100" style="background-color: #eee;" autocomplete="off" tabindex="-1">
                            <input type="text" name="classroomid" id="classroomid" value="<?php echo $row['class_unique_id'] ?>" hidden tabindex="-1">
                            <input type="text" id="sendtime" name="sendtime" value="" hidden tabindex="-1">
                        </div>
                        
                        <div class="col-2 h-75">
                            <input type="submit" id="sendbtn" value="Send" class="rounded-pill border-0 text-bg-primary px-3 h-100 d-flex" tabindex="-1"> 
                        </div>
                        
                    </form>

                    
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
                <a href="../conversation/?c=<?php echo $_GET['c']; ?>" class="text-nowrap d-block btn text-primary bg-light fw-bold border border-primary my-3 text-start"><i class="bi bi-chat-left-text"></i> Conversation</a>
                <a href="../tests/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-calendar4-week"></i> Tests</a>
                <a href="../homework/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-check2-square"></i> Homework</a>

                <hr class="m-0">

                <a href="../classsettings/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-gear-fill"></i> Class Settings</a>

                <hr class="m-0">

                <a href="../classrooms" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-globe-asia-australia"></i> Classrooms</a>
            </div>            
        </div>    
        
        <?php include_once "../php/profileoffcanvas.php" ?>
          
        <script>
            window.scrollTo(0, document.body.scrollHeight);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="./js/send&recieve.js"></script>

    </body>
</html>