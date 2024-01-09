<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "../php/config.php";
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
        <title>Classrooms || infoClass</title>
    </head>
    <body>

        <!-- Navbar -->

        <nav class="navbar sticky-top navbar-expand-lg bg-light">
            <div class="container-lg px-4"> 

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="menucanvas">
                <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand d-none d-lg-inline" href="../"><h2>info<span class="text-bg-primary rounded-2">Class</span></h2></a>

                <h2 class="text-primary">Select Class</h2>

                <img src="../profilephotos/<?php echo $row['img'] ?>" style="width: 40px; height: 40px;" class="rounded-circle border border-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#profilecanvas" aria-controls="offcanvasExample">
                 
            </div>
        </nav>

        <!-- Content -->

        <div class="container shadow-lg rounded">
            <div class="row justify-content-center">
                <!-- <div class="d-none d-lg-block col-lg-3 border-end border-secondary border-end-2">
                    <a href="#" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-plus-lg"></i> Create Classroom</a>
                </div> -->

                <div class="col col-sm-10 col-md-10 col-lg-8" style="height: calc(100vh - 75px);">
                    <div class="overflow-auto" style="height: calc(100vh - 140px);" id="classholder">

                    </div>
                    <div class="d-flex justify-content-center bg-light sticky-bottom" style="height: 65px;">
                        <button class="btn btn-primary bg-light text-primary border border-primary rounded-2 h-75 my-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasclass" aria-controls="offcanvasclass">
                            <div class="fw-bold"><i class="bi bi-plus-lg"></i> Create New Classroom</div>    
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
                <!-- <a href="#" class="d-block btn text-primary bg-light my-3 text-start"><i class="bi bi-plus-lg"></i> Create Classroom</a> -->

                <h4 class="fw-bold text-primary ms-3 mt-4">Nothing here...</h4>
            </div>            
        </div>    
        
        <?php include_once "../php/profileoffcanvas.php" ?>

        <!-- New ClassRoom Offcanvas -->

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasclass" aria-labelledby="classoffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-primary" id="classoffcanvas">Create New Classroom</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="py-2 mx-4 my-3 text-danger border border-danger rounded text-center fw-bold  d-none" id="errorbox">This is error message....</div>
                <form action="#" method="POST" enctype="multipart/form-data" id="createnewclassform">
                    <div class="mb-3">
                        <label for="classname" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="classname" id="classname" placeholder="Class name...">
                    </div>
                    <div class="mb-3">
                      <label for="classphoto" class="form-label">Class photo:</label>
                      <input type="file" class="form-control" name="image" id="classphoto" placeholder="" accept="image/png, image/jpeg, image/jpg">
                    </div>
                    <button id="createnewclassbtn" type="submit" class="btn btn-primary float-end">Submit</button>                    
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="./js/createclassroom.js"></script>
        <script src="./js/getclassrooms.js"></script>
    </body>
</html>



