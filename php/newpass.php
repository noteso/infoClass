<?php 
    include_once "config.php";

    if(isset($_POST['newpass']) && isset($_POST['confpass']) && isset($_POST['userid'])){
        $newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
        $confpass = mysqli_real_escape_string($conn, $_POST['confpass']);
        $userid = mysqli_real_escape_string($conn, $_POST['userid']);

        if(!empty($newpass) && !empty($confpass) && !empty($userid)){
            if($newpass == $confpass){
                $password_hash = password_hash($newpass, PASSWORD_DEFAULT);
                $update_query = mysqli_query($conn, "UPDATE users SET password = '{$password_hash}' WHERE unique_id = {$userid}");
                $remove_query = mysqli_query($conn, "DELETE FROM passreset WHERE user_unique_id = {$userid}");
                if($update_query){
                    echo "success";
                }else{
                    echo "Something went wrong";
                }
            }else{
                echo "Passwords not matching!";
            }
        }else{
            echo "All fields must be entered";
        }
    }
    exit;
?>