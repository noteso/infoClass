<?php
    include_once "../../php/config.php";
    if(isset($_GET['t'])){
        date_default_timezone_set('UTC');

        $time = date("Y-m-d");

        $token = mysqli_real_escape_string($conn, $_GET['t']);
        $sql = mysqli_query($conn, "SELECT * FROM passreset WHERE reset_token = '{$token}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            if($row['valid_time'] < $time){
                $remove_query = mysqli_query($conn, "DELETE FROM passreset WHERE reset_token = '{$token}'");
                header("Location:./expired.html");
            }else{
                $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$row['user_unique_id']}");
                if(mysqli_num_rows($sql2) > 0){
                    $row2 = mysqli_fetch_assoc($sql2);
                }
            }
        }else{
            header("Location:../../");
        }
    }else{
        header("Location:../../");
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
    <title>Password reset || infoClass</title>
</head>
<body>
    <!-- Sign in card -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-5 border border-opacity-25 border-secondary shadow-lg rounded-4 my-5">
                <div class="text-center text-primary">
                    <h1 class="text-secondary my-4">info<span class="text-bg-primary rounded-2">Class</span></h1>
                    <h2 class="text-primary my-3">Forgot Password</h2>
                    <p class="text-muted">Enter new password for your account linked with this email: <span class="fw-bold"><?php echo $row2['email']; ?></span></p>
                </div>
                <div class="py-2 mx-4 my-5 text-danger border border-danger rounded text-center fw-bold d-none" id="errorbox">This is error message....</div>
                <form action="" method="post" class="container justify-content-center" id="resetpassform">
                    <div class="mx-2">
                        <div class="form-floating my-2">
                            <input type="password" class="form-control border border-primary" id="newpass" name="newpass" placeholder="New Password" autocomplete="off">
                            <label for="newpass">New Password</label>
                        </div>
                        <div class="form-floating my-2">
                            <input type="password" class="form-control border border-primary" id="confpass" name="confpass" placeholder="Confirm Password" autocomplete="off">
                            <label for="confpass">Confirm Password</label>
                        </div>
                        <div class="mb-2">
                            <input class="form-check-input" type="checkbox" aria-label="Checkbox for following text input d-inline" id="showpass">
                            <label class="d-inline">Show passwords</label>
                        </div>
                        <input type="text" name="userid" value="<?php echo $row2['unique_id'] ?>" hidden>
                    </div> 
                    <input type="submit" id="passsubmit" value="Restart Password" class="btn btn-lg btn-primary mb-4 float-end">
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="./js/newpass.js"></script>

</body>
</html>