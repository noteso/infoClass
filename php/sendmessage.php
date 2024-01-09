<?php
    session_start();
    include_once "./config.php";

    if(!isset($_SESSION['unique_id'])){
        header("Location:../");
    } 


    $classroom_id = mysqli_real_escape_string($conn, $_POST['classroomid']);
    $sender_id = $_SESSION['unique_id'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $sendtime = mysqli_real_escape_string($conn, $_POST['sendtime']);

    if(!empty($classroom_id) && !empty($sender_id) && !empty($message) && !empty($sendtime)){
        $sql = mysqli_query($conn, "INSERT INTO messages (classroom_unique_id, sender_unique_id, message, message_date) VALUES({$classroom_id}, {$sender_id}, '{$message}', '{$sendtime}')") or die();
    }

?>