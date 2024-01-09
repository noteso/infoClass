<?php
    session_start();

    if(!isset($_SESSION['unique_id'])){
        header("Location:../");
    } 

    include_once "config.php";

//change profile picture

if(isset($_FILES['updatephoto'])){
    $img_name = $_FILES['updatephoto']['name'];
    $img_type = $_FILES['updatephoto']['type'];
    $tmp_name = $_FILES['updatephoto']['tmp_name'];
            
    $img_explode = explode('.',$img_name);
    $img_ext = end($img_explode);
    $extensions = ["jpeg", "png", "jpg", "PNG"];
    if(in_array($img_ext, $extensions) === true){
        $types = ["image/jpeg", "image/jpg", "image/png"];
        if(in_array($img_type, $types) === true){
            if(isset($_POST['userid'])){
                $userid = mysqli_real_escape_string($conn, $_POST['userid']);

                $user_image = "";
                $user_image .= $userid . "." . $img_ext;
                if(move_uploaded_file($tmp_name,"../profilephotos/" . $user_image)){
                    
                    $update_query = mysqli_query($conn, "UPDATE users SET img = '{$user_image}' WHERE unique_id = {$userid}");
                    if($update_query){
                        echo "success";
                    }
                }
            }else{
                echo "Something went wrong!";
            }
        }else{
            echo "Please upload an image file - jpeg, png, jpg";
        }
    }else{
        echo "Please upload an image file - jpeg, png, jpg";
    }
    exit;
}

//change name

if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_SESSION['unique_id'])){
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $userid = $_SESSION['unique_id'];

    if(!empty($fname) && !empty($lname)){
        $update_query1 = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}'  WHERE unique_id = {$userid}");

        if($update_query1){
            echo "success";
        }else{
            echo "Something went wrong";
        }
    }else{
        echo "Both fields must be entered";
    }
    exit;
}

//update username

if(isset($_POST['username']) && isset($_SESSION['unique_id'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $userid = $_SESSION['unique_id'];

    if(!empty($username)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}'");
        if(mysqli_num_rows($sql) <= 0){
            $update_query2 = mysqli_query($conn, "UPDATE users SET username = '{$username}'  WHERE unique_id = {$userid}");

            if($update_query2){
                echo "success";
            }else{
                echo "Something went wrong!";
            } 
        }else{
            echo "Username already exists!";
        }
    }else{
        echo "Username not entered!";
    }
    exit;
}

// update email

if(isset($_POST['email']) && isset($_SESSION['unique_id'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $userid = $_SESSION['unique_id'];

    if(!empty($email)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) <= 0){
                $update_query3 = mysqli_query($conn, "UPDATE users SET email = '{$email}', email_verified = 0  WHERE unique_id = {$userid}");

                if($update_query3){
                    echo "success";
                }else{
                    echo "Something went wrong!";
                } 
            }else{
                echo "Email already exists!";
            }
        }else{
            echo "Email is invalid!";
        }
    }else{
        echo "Email not entered!";
    }
    exit;
}

// hide/show email

if(isset($_POST['emailprivate'])){
    $emailprivate = mysqli_real_escape_string($conn, $_POST['emailprivate']);
    $userid = $_SESSION['unique_id'];

    $update_query = mysqli_query($conn, "UPDATE users SET show_email = {$emailprivate}  WHERE unique_id = {$userid}");

    if($update_query){
        echo "success";
    }else{
        echo "Something went wrong";
    }
    exit;
}

// update password

if(isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['repass'])){
    $oldpass = mysqli_real_escape_string($conn, $_POST['oldpass']);
    $newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
    $repass = mysqli_real_escape_string($conn, $_POST['repass']);
    $userid = $_SESSION['unique_id'];

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$userid}");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        if(password_verify($oldpass, $row['password'])){
            if($newpass === $repass){
                $pass_hash = password_hash($newpass, PASSWORD_DEFAULT);

                $update_query4 = mysqli_query($conn, "UPDATE users SET password = '{$pass_hash}'  WHERE unique_id = {$userid}");
                if($update_query4){
                    echo "success";
                }else{
                    echo "Something went wrong!";
                }
            }else{
                echo "New passwords not matching!";
            }
        }else{
            echo "Old password incorect!";
        }
    }
    exit;
}

// update bio

if(isset($_POST['bio'])){
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $userid = $_SESSION['unique_id'];

    $sql = mysqli_query($conn, "UPDATE users SET bio = '{$bio}'  WHERE unique_id = {$userid}");
        if($sql){
            echo "success";
        }else{
            echo "Something went wrong!";
        } 
    exit;
}

// hide/show bio

if(isset($_POST['bioprivate'])){
    $bioprivate = mysqli_real_escape_string($conn, $_POST['bioprivate']);
    $userid = $_SESSION['unique_id'];

    $update_query = mysqli_query($conn, "UPDATE users SET show_bio = {$bioprivate}  WHERE unique_id = {$userid}");

    if($update_query){
        echo "success";
    }else{
        echo "Something went wrong";
    }
    exit;
}

?>