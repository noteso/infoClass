<?php 
    include_once "../../php/config.php"; 
    include_once "../../php/phpmail.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <title>Forgot Password || infoClass</title>
</head>
<body>
    <?php
        if(isset($_POST['email'])){
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);

                $length = 75;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomstring = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomstring .= $characters[random_int(0, $charactersLength - 1)];
                }
                date_default_timezone_set('UTC');

                $validtime = date("Y-m-d");

                $sql2 = mysqli_query($conn, "INSERT INTO passreset (user_unique_id, reset_token, valid_time) VALUES ({$row['unique_id']}, '{$randomstring}', '{$validtime}')");

                $content = '<!DOCTYPE PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN” “https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd”>
                <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width,initial-scale=1.0">
                        <title></title>
                        <style>
                            body{
                                background-color: white;
                                font-family: Arial, Helvetica, sans-serif;
                            }
                            #heading1, #heading2{
                                color: #0d6efd;
                                text-align: center;
                                padding: 20px 0;
                            }
                            .paragraf{
                                margin: 0 0 0 30px;
                            }
                            #buttonreset{
                                background-color: #1c87c9;
                                border: none;
                                width: 200px;
                                padding: 15px 0;
                                color: white;
                                text-align: center;
                                text-decoration: none;
                                margin: 25px auto;
                                font-size: 20px;
                                cursor: pointer;
                                display: inline-block;
                                position: absolute;
                                left: 50%;
                                transform: translateX(-50%);
                            }
                            #buttonreset:active{
                                background-color: #1c87c9;
                                color: white;
                            }
                            #buttonreset:hover{
                                background-color: #1c87c9;
                                color: white;
                            }
                            #something{
                                color:white;
                                background-color: #0d6efd;
                                text-align: center;
                                padding: 5px;
                                border-radius: 7px;
                            }
                            #linkdiv{
                                width: 100%;
                                text-align: center;
                                position: relative;
                            }
                        </style>
                    </head>
                    <body>
                        <h1 id="heading2" style="font-size: 40px;">info<span id="something">Class</span></h1>
                        <h1 id="heading1">Password reset</h1>
                        <div>
                            <p style="margin-bottom: 20px;" class="paragraf">Hello <strong>' . $row['fname'] . " " . $row['lname'] . '</strong>,</p>
                            <p style="margin-bottom: 10px;" class="paragraf">We found account linked with email which requested password reset.</p>
                            <p class="paragraf">If you requested password reset click on the button below.</p>
                            <p class="paragraf">If you didnt you can ignore this email or check your account security.</p>
                        </div>
                        <div id="linkdiv">
                            <a href="'. $_SERVER['SERVER_NAME'] .'/forgotpassword/newpassword/?t=' . $randomstring . '"  id="buttonreset">Reset Password</a>
                        </div>
                        
                    </body>
                </html>';

                if($sql2){
                    phpmail("Password reset || infoClass", $content, $row['email']);
                    unset($_POST['email']);
                    header("Location:./success.html");
                }
            }else{
                echo '<div class="container">
                        <div class="row justify-content-center">
                            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-5 border border-opacity-25 border-secondary shadow-lg rounded-4 my-5">
                                <div class="text-center text-primary">
                                    <h1 class="text-secondary my-4">info<span class="text-bg-primary rounded-2">Class</span></h1>
                                    <h2 class="text-primary my-3">Forgot Password</h2>
                                    <hr>
                                </div>
                                <div class="text-center">
                                    <h3 class="text-danger my-5">We couldnt find account linked with this email.</h3>
                                    <p class="text-muted mt-3 mb-5">Check if your email is correcty spelled and go back on <a href="../">forgot password</a> page.</p>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        } 
    ?>
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>