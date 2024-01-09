<?php
    include_once "config.php";

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");

    if(mysqli_num_rows($sql) > 0){
        echo "no";
    }
    else{
        echo "yes";
    }

?>