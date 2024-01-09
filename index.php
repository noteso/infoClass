<?php
    session_start();
    
    if(isset($_SESSION['unique_id'])){
        header("Location:./classrooms");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="google-site-verification" content="2yYvtrrFsN0jDV38vDByJ2q3sv33aNu1hjuHGzWauHU" />
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
        <title>infoClass</title>
    </head>
    <body style="background-image: url(./images/background.jpg); background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
        <!-- navbar -->
        
        <nav class="navbar navbar-expand-md bg-light sticky-top">
            <div class="container-lg px-4">
                <a class="navbar-brand" href=""><h2 class="text-secondary">info<span class="text-bg-primary rounded-2">Class</span></h2></a>
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="menucanvas">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="menucanvas">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">info<span class="text-bg-primary rounded-2">Class</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <hr class="m-0">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link fw-bold ps-3" href="./signup">Sign up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-bg-primary rounded-2 px-3" href="./signin">Sign in</a>
                            </li>                 
                        </ul>
                    </div>            
                </div>
            </div>
        </nav>

        <!-- content -->
        <div class="container-lg">
            <div class="row justify-content-center">
                <div style="background-color: #fff8;" class="col-md-10 p-4 mt-5 rounded-3">
                    <h1 class="text-start text-secondary mb-5 mt-2">info<span class="text-bg-primary rounded-2">Class</span></h1>
                    <h3 class="text-dark">Dont loose track of your school duties.</h3>
                    <h5 class="text-dark">Note your test dates, homework, share your knowledge with classmates and more.</h5>
                    <div class="d-flex justify-content-end pe-4 py-4">
                        <a href="./signup" class="btn btn-transparent fw-bold me-2">Sign up</a>
                        <a href="./signin" class="btn btn-primary fw-bold me-4">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
        
          

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>