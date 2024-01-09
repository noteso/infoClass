<?php
    session_start();
    
    if(isset($_SESSION['unique_id'])){
        header("Location:../classrooms");
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
    <title>Sign in || infoClass</title>
</head>
<body>
    <!-- Sign in card -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 border border-opacity-25 border-secondary shadow-lg rounded-4 my-5">
                <div class="text-center text-primary">
                    <h1 class="text-secondary my-4">info<span class="text-bg-primary rounded-2">Class</span></h1>
                    <h2 class="text-primary my-3">Sign in</h2>
                    <p class="text-muted">Use existing account, or <a href="../signup">create a new one</a>.</p>
                </div>
                <div class="py-2 mx-4 my-3 text-danger border border-danger rounded text-center fw-bold d-none" id="errorbox">This is error message....</div>
                <form action="" method="post" class="container justify-content-center" id="signinform">
                    <div class="mx-2">
                       <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
                            <label for="email">Email address</label>
                        </div>
                        <div class="input-group">  
                            <div class="form-floating">
                                <input type="password" class="form-control border-end-0" id="Password" name="password" placeholder="Password" autocomplete="off">
                                <label for="Password">Password</label>
                            </div>
                            <button type="button" class="input-group-text border-start-0 bg-transparent"><i class="bi bi-eye-fill"></i></button>
                        </div>
                        <div id="passwordHelpBlock" class="form-text text-end mb-4">
                            <a href="../forgotpassword/" class="">Forgot password?</a>
                        </div>
                    </div> 
                    <input type="submit" value="Log in" class="btn btn-lg btn-primary mb-4 my-5 float-end">
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./js/showpassword.js"></script>
    <script src="./js/signin.js"></script>
</body>
</html>