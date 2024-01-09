<?php
    session_start();
    include_once "config.php";

    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $birth = mysqli_real_escape_string($conn, $_POST["birth"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pass = mysqli_real_escape_string($conn, $_POST["pass"]);
    $repass = mysqli_real_escape_string($conn, $_POST["repass"]);

    $email = strtolower($email);

    $fname = trim($fname);
    $lname = trim($lname);
    $email = trim($email);

    if($gender == 0 ){
        $gender = "None";
    }
    else if($gender == 1){
        $gender = "Male";
    }
    else{
        $gender = "Female";
    }

    if(!empty($fname) && !empty($lname) && !empty($username) && !empty($birth) && !empty($gender) && !empty($email) && !empty($pass) && !empty($repass)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "Email already exists!";
            }
            else{
                $sql2 = mysqli_query($conn, "SELECT username FROM users WHERE username = '{$username}'");
                if(mysqli_num_rows($sql2) > 0){
                    echo "Username already exists!";
                }
                else{
                    if($gender !== "None"){
                        if($pass === $repass){
                            $random_id = rand(time(), 100000000);
                            if(copy("../images/blankprofpic.png", "../profilephotos/".$random_id.".png")){
                                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
                                
                                $sql3 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, username, email, password, date_of_birth, gender, img, show_email, show_bio, email_verified) VALUES({$random_id}, '{$fname}', '{$lname}', '{$username}', '{$email}', '{$pass_hash}', '{$birth}', '{$gender}', '{$random_id}.png', 0, 0, 0)");

                                if($sql3){
                                    $sql4 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($sql4) > 0){
                                        $result = mysqli_fetch_assoc($sql4);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        echo "success";
                                    }else{
                                        echo "This email address not Exist!";
                                    }
                                }
                                else{
                                    echo "Something went wrong!";
                                }
                            }
                        }
                        else{
                            echo "Passwords arent matching!";
                        }
                    }
                    else{
                        echo "Gender not selected!";
                    } 
                }
            }
        }
        else{
            echo "Email is not valid!";
        }
    }
    else{
        echo "All input fields are required!";
    }
?>