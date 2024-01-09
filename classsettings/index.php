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

                <h2 class="text-primary"><?php echo $row['class_name'] ?></h2>

                <img src="../profilephotos/<?php echo $row2['img'] ?>" style="width: 40px; height: 40px;" class="rounded-circle border border-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#profilecanvas" aria-controls="offcanvasExample">
                 
            </div>
        </nav>

        <!-- Content -->

        <div class="container shadow-lg rounded">
            <div class="row justify-content-center" style="height: calc(100vh - 75px);">
                <div class="d-none d-lg-block col-lg-3 border-end border-secondary border-end-2 h-100">
                    <a href="../conversation/?c=<?php echo $_GET['c']; ?>" class="text-nowrap d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-chat-left-text"></i> Conversation</a>
                    <a href="../tests/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light mb-2 text-start"><i class="bi bi-calendar4-week"></i> Tests</a>
                    <a href="../homework/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light mb-2 text-start"><i class="bi bi-check2-square"></i> Homework</a> 

                    <hr class="m-0">

                    <a href="../classsettings/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start fw-bold border border-primary"><i class="bi bi-gear-fill"></i> Class Settings</a>

                    <hr class="m-0">
                    
                    <a href="../classrooms" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-globe-asia-australia"></i> Classrooms</a>

                </div>

                <div class="col col-sm-10 col-md-10 col-lg-8 overflow-auto" style="height: calc(100vh - 75px);">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="w-25 ratio ratio-1x1 mx-auto my-4 position-relative">
                                <img src="../classphotos/<?php echo $row['class_img'] ?>" class="img-fluid rounded-4">
                                <form action="" method="post" enctype="multipart/form-data" id="photoform">
                                    <label for="updatephoto" class="rounded-circle position-absolute top-100 start-100 translate-middle d-flex justify-content-center align-items-center text-bg-light border border-primary" style="width: 25%; height: 25%; cursor: pointer;" id="photolabel">
                                        <i class="bi bi-camera-fill text-primary"></i>
                                    </label>
                                    <input type="file" name="updatephoto" id="updatephoto" class="d-none" accept="image/png, image/jpeg">
                                    <input type="text" value="<?php echo $_GET['c'] ?>" name="classid" hidden>

                                    <button class="rounded-circle position-absolute top-100 start-0 translate-middle d-flex justify-content-center align-items-center text-danger bg-light border border-danger d-none" style="width: 25%; height: 25%; cursor: pointer;" id="abortphotosubmit">
                                        <i class="bi bi-x-lg"></i>
                                    </button>

                                    <button type="submit" class="rounded-circle position-absolute top-100 start-100 translate-middle d-flex justify-content-center align-items-center text-success bg-light border border-success d-none" style="width: 25%; height: 25%; cursor: pointer;" id="photosubmitbutton">
                                        <i class="bi bi-check-lg text-primary"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="py-2 mx-4 my-3 text-danger border border-danger rounded text-center fw-bold d-none" id="errorbox">This is error message....</div>
                        </div>
                        <div class="col-12 col-md-9 my-4">
                            <form action="" method="post" id="nameform">
                                <div class="input-group">  
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-end-0 border-primary" id="classname" name="classname" placeholder="Class Name" value="<?php echo $row['class_name'] ?>" readonly autocomplete="off">
                                        <label for="classname" class="text-primary fw-bold opacity-100">Class Name</label>
                                    </div>
                                    <input type="text" value="<?php echo $_GET['c'] ?>" name="classid" id="classid" hidden>
                                    <button type="button" class="input-group-text border-start-0 bg-transparent border-primary rounded-end" id="editname"><i class="bi bi-pencil text-primary"></i></button>
                                    <button type="submit" class="input-group-text border-start-0 bg-transparent border-primary d-none" id="submitname"><i class="bi bi-check-lg text-primary"></i></button>
                                </div> 
                            </form>
                            <hr>
                        </div>

                        <div class="col-12 col-md-9">
                            <h2 class="text-primary fw-bold">Members</h2>
                            <hr>
                            <div class="accordion" id="addmember">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addmemberform" aria-expanded="false" aria-controls="addmemberform" id="addmemberbtn">
                                            Add Member
                                        </button>
                                    </h2>
                                    <div id="addmemberform" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#addmemberform">
                                        <div class="accordion-body">
                                            <form class="row justify-content-center" action="" id="searchusersform">
                                                <div class="col-8">
                                                    <input type="text" class="form-control" name="usersearch" id="peoplesearch" placeholder="Use name or @username for search.." autocomplete="off">
                                                </div>
                                                <input type="text" value="<?php echo $_GET['c'] ?>" name="classid" hidden>
                                                <button type="submit" class="btn text-primary col-2 rounded border border-primary" id="searchbtn"><i class="bi bi-search fw-bold"></i></button>
                                            </form>
                                            <hr>
                                            <div id="searchusersbox">
                                                
                                            </div>
                                            
                                            
                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="Members">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="memberlistbtn">
                                            Member List
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body" id="membersbox">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                <a href="../tests/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-calendar4-week"></i> Tests</a>
                <a href="../homework/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-check2-square"></i> Homework</a>

                <hr class="m-0">

                <a href="../classsettings/?c=<?php echo $_GET['c']; ?>" class="d-block btn text-primary bg-light my-3 text-start fw-bold border border-primary"><i class="bi bi-gear-fill"></i> Class Settings</a>

                <hr class="m-0">

                <a href="../classrooms" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-globe-asia-australia"></i> Classrooms</a>
            </div>            
        </div>    
        
        <?php include_once "../php/profileoffcanvas.php" ?>
          
        <script>
            window.scrollTo(0, document.body.scrollHeight);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

        <script src="./js/settings.js"></script>

    </body>
</html>