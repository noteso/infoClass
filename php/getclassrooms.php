<?php
    session_start();
    include_once "config.php";

    if(isset($_SESSION['unique_id'])){
        $sql = mysqli_query($conn, "SELECT * FROM members 
                                    LEFT JOIN classrooms ON members.classroom_unique_id = classrooms.class_unique_id
                                    WHERE user_unique_id='{$_SESSION['unique_id']}'");
        $output = "";
        if(mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_assoc($sql)){
                $output .= '<div class="card mb-3 position-relative w-100 mx-auto border rounded-2 my-3">
                            <div class="row g-0">
                            <div class="col-2 d-flex align-items-center">
                            <img src="../classphotos/' . $row['class_img'] . '" class="img-fluid rounded">
                            </div>
                            <div class="col-10 d-flex align-items-center">
                            <div class="card-body">
                            <h3 class="card-title">' . $row['class_name'] . '</h3>
                            <p class="card-text"><small class="text-muted">Click to open.</small></p>
                            </div>
                            </div>
                            </div>
                            <a href="../conversation/?c=' . $row['classroom_unique_id'] . '"class="position-absolute top-0 start-0 w-100 h-100"></a>
                            </div>';
            }
        }else{
            $output .= "<h2>You are not part of any classroom right now!</h2>";
        }
    }else{
        header("Location:../");
    }

    echo $output;
?>