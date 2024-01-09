<?php
    session_start();
    include "./config.php";

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    if(!empty($email) && !empty($password)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            if(password_verify($password, $row['password'])){
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "success";
            }else{
                echo "Credetials not matching!";
            }
        }else{
            echo "Email is not found!";
        }
    }else{
        echo "All fields must be entered!";
    }

?>