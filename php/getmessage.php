<?php

    session_start();
    include "./config.php";

    if(!isset($_SESSION['unique_id'])){
        header("Location:../");
    }
    
    $classroom_id = mysqli_real_escape_string($conn, $_POST['classroom_id']);
    $output = "";

    $sql = mysqli_query($conn, "SELECT * FROM messages WHERE classroom_unique_id='{$classroom_id}' ORDER BY message_date DESC");
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $sql2= mysqli_query($conn, "SELECT * FROM users WHERE unique_id='{$row['sender_unique_id']}'");
            $row2 = mysqli_fetch_assoc($sql2);
            if($row['sender_unique_id'] === $_SESSION['unique_id']){
                $output .= '<div class="rounded-2 p-2 mt-2 ms-auto text-bg-primary" style="max-width: 60%;">
                            <div class="ms-1 text-break">
                                ' . $row['message'] . '
                            </div>
                            <div class="text-end text-light my-2" style="font-size: 10px;">' . $row['message_date'] . '</div>
                            </div>';
            }else{
                $output .=  '<div class="rounded-2 p-2 my-2" style="background-color: #eee; max-width: 60%;">
                            <a href="../profile/?q=' . $row2['username'] . '" class="link-dark">
                            <div class="fw-bold ms-3 mb-1" style="font-size: 15px;">' . $row2['fname'] . $row2['lname'] . '</div>
                            </a>
                            <div class="ms-1 text-break">
                                ' . $row['message'] . '
                            </div>
                            <div class="text-end text-muted my-2" style="font-size: 10px;">' . $row['message_date'] . '</div>
                            </div>';
            }
        }
    }else{
        $output .= "Be the first one to start conversation!";
    }
    

    echo $output;
?>