<?php
    session_start();

    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        
        $classid = mysqli_real_escape_string($conn, $_POST['classid']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $day = mysqli_real_escape_string($conn, $_POST['day']);
        $month = mysqli_real_escape_string($conn, $_POST['month']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);

        $sql = mysqli_query($conn, "SELECT * FROM members WHERE user_unique_id = '{$_SESSION['unique_id']}' AND classroom_unique_id = '{$classid}'");

        if(mysqli_num_rows($sql) <= 0){
            die();
        }
        
        if(!empty($classid) && !empty($subject) && !empty($day) && !empty($month) && !empty($year) && !empty($description)){
            if($day == 0 || $month == 0 || $year == 0){
                echo "Date not entered!";
            }else{
                $homeworkdate = "";
                $homeworkdate .= $year . "-" . $month . "-" .$day;

                $sql2 = mysqli_query($conn, "INSERT INTO homework (classroom_unique_id, homework_subject, homework_description, homework_date) VALUES({$classid}, '{$subject}', '{$description}', '{$homeworkdate}')") or die();
                if($sql2){
                    echo "success";
                }else{
                    echo "Something went wrong!";
                } 
            }
        }else{
            echo "All fields required!";
        }
    }else{
        header("Location: ../");
    }

    
?>