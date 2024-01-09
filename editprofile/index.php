<?php

    session_start();
    include_once "../php/config.php";

    if(isset($_SESSION['unique_id'])){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id='{$_SESSION['unique_id']}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
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
        <title>Edit profile || infoClass</title>
    </head>
    <body">

        <!-- Navbar -->

        <nav class="navbar sticky-top navbar-expand-lg bg-light">
            <div class="container-lg px-4"> 

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="menucanvas">
                <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand d-none d-lg-inline" href="../"><h2>info<span class="text-bg-primary rounded-2">Class</span></h2></a>

                <h2 class="text-primary">Edit Profile</h2>

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
                    <a href="../classrooms/" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-globe-asia-australia"></i> Classrooms</a>

                </div>

                <div id="maindiv" class="col col-sm-10 col-md-10 col-lg-8 overflow-auto" style="height: calc(100vh - 75px);">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="w-25 ratio ratio-1x1 mx-auto my-4 position-relative">
                                <img src="../profilephotos/<?php echo $row['img'] ?>" class="img-fluid rounded-4">
                                <form action="" method="post" enctype="multipart/form-data" id="photoform">
                                    <label for="updatephoto" class="rounded-circle position-absolute top-100 start-100 translate-middle d-flex justify-content-center align-items-center text-bg-light border border-primary" style="width: 25%; height: 25%; cursor: pointer;" id="photolabel">
                                        <i class="bi bi-camera-fill text-primary"></i>
                                    </label>
                                    <input type="file" name="updatephoto" id="updatephoto" class="d-none" accept="image/png, image/jpeg">
                                    <input type="text" value="<?php echo $_SESSION['unique_id'] ?>" name="userid" hidden>

                                    <button class="rounded-circle position-absolute top-100 start-0 translate-middle d-flex justify-content-center align-items-center text-danger bg-light border border-danger d-none" style="width: 25%; height: 25%; cursor: pointer;" id="abortphotosubmit">
                                        <i class="bi bi-x-lg"></i>
                                    </button>

                                    <button type="submit" class="rounded-circle position-absolute top-100 start-100 translate-middle d-flex justify-content-center align-items-center text-success bg-light border border-success d-none" style="width: 25%; height: 25%; cursor: pointer;" id="photosubmitbutton">
                                        <i class="bi bi-check-lg text-primary"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="py-2 mx-4 my-5 text-danger border border-danger rounded text-center fw-bold d-none" id="errorbox">This is error message....</div>
                        </div>
                        <div class="col-12 col-md-9 my-4" >
                            <h2 class="text-primary fw-bold">Personal info</h2>
                            <hr>
                        </div>
                        <div class="col-12 col-md-9 my-2">
                            <h3 class="text-secondary fw-bold">Name</h3>
                            <form action="" method="post" id="nameform">
                                <div class="input-group">  
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-end-0 border-primary" id="fname" name="fname" placeholder="First Name" value="<?php echo $row['fname']; ?>" autocomplete="off" readonly>
                                        <label for="fname" class="text-primary fw-bold opacity-100">First Name</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-end-0 border-primary" id="lname" name="lname" placeholder="Last Name" value="<?php echo $row['lname']; ?>" autocomplete="off" readonly>
                                        <label for="lname" class="text-primary fw-bold opacity-100">Last Name</label>
                                    </div>
                                    <button onclick="" class="input-group-text border-start-0 bg-transparent border-primary rounded-end" id="editname"><i class="bi bi-pencil text-primary"></i></button>
                                    <button type="submit" class="input-group-text border-start-0 bg-transparent border-primary d-none" id="submitname"><i class="bi bi-check-lg text-primary"></i></button>
                                </div> 
                            </form>
                        </div>

                        <div class="text-secondary col-12 col-md-9 my-2">
                            <h3 class="fw-bold">Username</h3>
                            <form action="" method="post" id="usernameform">
                                <div class="input-group">  
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-end-0 border-primary" id="username" name="username" placeholder="Username" value="<?php echo $row['username'] ?>" autocomplete="off" readonly>
                                        <label for="username" class="text-primary fw-bold opacity-100">Username</label>
                                    </div>
                                    <button onclick="" class="input-group-text border-start-0 bg-transparent border-primary rounded-end" id="editusername"><i class="bi bi-pencil text-primary"></i></button>
                                    <button type="submit" class="input-group-text border-start-0 bg-transparent border-primary d-none" id="submitusername"><i class="bi bi-check-lg text-primary"></i></button>
                                </div> 
                            </form>
                            <hr>
                        </div>

                        <div class="text-secondary col-12 col-md-9 my-2">
                            <h3 class="fw-bold">Email</h3>
                            <form action="" method="post" id="emailform">
                                <div class="input-group">  
                                    <div class="form-floating">
                                        <input type="email" class="form-control border-end-0 border-primary" id="email" name="email" placeholder="Email" value="<?php echo $row['email'] ?>" autocomplete="Off" readonly>
                                        <label for="email" class="text-primary fw-bold opacity-100">Email</label>
                                    </div>
                                    <button onclick="" class="input-group-text border-start-0 bg-transparent border-primary rounded-end" id="editemail"><i class="bi bi-pencil text-primary"></i></button>
                                    <button type="submit" class="input-group-text border-start-0 bg-transparent border-primary d-none" id="submitemail"><i class="bi bi-check-lg text-primary"></i></button>
                                </div> 
                            </form>
                            <div class="d-flex justify-content-start align-items-center mt-1">
                                <div class="form-check form-switch form-check-reverse p-0 m-0 ms-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="emailpriv" <?php if($row['show_email'] == 1) echo "checked"; ?>>
                                    <label class="form-check-label" for="emailpriv">Make email public on your profile</label>
                                </div>
                            </div>  
                        </div>

                        <div class="text-secondary col-12 col-md-9 my-2">
                            <h3 class="fw-bold">Password</h3>
                            <form action="" method="post" id="passform">
                                <div class="form-floating">
                                    <input type="password" class="form-control my-2 border-primary" id="oldpass" name="oldpass" placeholder="Old Password" autocomplete="off">
                                    <label for="oldpass" class="text-primary fw-bold opacity-100">Old Password</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control my-2 border-primary" id="newpass" name="newpass" placeholder="New Password autocomplete="off">
                                    <label for="newpass" class="text-primary fw-bold opacity-100">New Password</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control my-2 border-primary" id="repass" name="repass" placeholder="Repeat New Password" autocomplete="off">
                                    <label for="repass" class="text-primary fw-bold opacity-100">Repeat New Password</label>
                                </div>
                                
                                <div class="mb-2">
                                    <input class="form-check-input" type="checkbox" aria-label="Checkbox for following text input d-inline" id="showpass">
                                    <label class="d-inline">Show passwords</label>
                                </div>
                                
                                <button type="submit" id="passsubmit" class="btn btn-primary rounded">Update Password</button>
                            </form>
                            <hr>
                        </div>

                        <div class="text-secondary col-12 col-md-9 my-2 mb-5">
                            <h3 class="fw-bold">Bio</h3>
                            <form action="" method="post" id="bioform">
                                <div class="input-group">  
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a bio here" name="bio" id="bio" style="height: 150px" readonly><?php echo $row['bio'] ?></textarea>
                                        <label for="bio" class="fw-bold text-primary">Bio</label>
                                    </div>
                                    <button onclick="" class="input-group-text border-start-0 bg-transparent border-primary rounded-end" id="editbio"><i class="bi bi-pencil text-primary"></i></button>
                                    <button type="submit" id="submitbio" class="input-group-text border-start-0 bg-transparent border-primary d-none"><i class="bi bi-check-lg text-primary"></i></button>
                                </div> 
                            </form>
                            <div class="d-flex justify-content-start align-items-center mt-1">
                                <div class="form-check form-switch form-check-reverse p-0 m-0 ms-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="biopriv" <?php if($row['show_bio'] == 1) echo "checked"; ?>>
                                    <label class="form-check-label" for="biopriv">Make bio public on your profile</label>
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
                <!--
                <a href="#" class="text-nowrap d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-chat-left-text"></i> Conversation</a>
                <a href="#" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-calendar4-week"></i> Tests</a>
                <a href="#" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-check2-square"></i> Homework</a>

                <hr class="m-0">

                <a href="#" class="d-block btn text-primary bg-light my-3 text-start fw-bold border border-primary"><i class="bi bi-gear-fill"></i> Class Settings</a>

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
        <script src="./js/editprofile.js"></script>

    </body>
</html>