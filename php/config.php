<?php
    $conn = mysqli_connect("host", "user", "password", "database");
    if(!$conn){
        echo "Database not connected" . mysqli_connect_error();
    }
?>