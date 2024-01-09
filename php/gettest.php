<?php

    session_start();
    include "./config.php";

    if(!isset($_SESSION['unique_id'])){
        header("Location:../");
    }
    
    $classroom_id = mysqli_real_escape_string($conn, $_POST['classroom_id']);
    $output = "";

    $sql = mysqli_query($conn, "SELECT * FROM tests WHERE classroom_unique_id='{$classroom_id}' ORDER BY test_date DESC");
    if(mysqli_num_rows($sql) > 0){
        $currentdate = date("Y-m-d");
        while($row = mysqli_fetch_assoc($sql)){
            $date = date("l, d-m-Y", strtotime($row['test_date']));
            if($row['test_date'] > $currentdate){
                if(!strstr( $output, '<div class="h2 my-4 text-center text-primary">Upcoming Tests</div>')){
                    $output .= '<div class="h2 my-4 text-center text-primary">Upcoming Tests</div>';
                }
                $output .= '<div class="position-relative w-100 mx-auto border rounded-2 my-3">
                            <div class="h5 m-3">Subject: ' . $row['test_subject'] .'</div>
                            <div class="h6 m-3">' . $date .'</div>
                            <div class="m-2"><pre class="m-2 p-2 rounded-2" style="background-color:#ddd">' . $row['test_description'] .'</pre></div>
                            </div>';
            }else{
                if(!strstr( $output, '<div class="h2 my-4 text-center text-primary">Finished Tests</div>')){
                    $output .= '<div class="h2 my-4 text-center text-primary">Finished Tests</div>';
                }
                $output .= '<div class="position-relative w-100 mx-auto border rounded-2 my-3">
                            <div class="h5 m-3">Subject: ' . $row['test_subject'] .'</div>
                            <div class="h6 m-3">' . $date .'</div>
                            <div class="m-2"><pre class="m-2 p-2 rounded-2" style="background-color:#ddd">' . $row['test_description'] .'</pre></div>
                            </div>';
            }
        }
    }else{
        $output .= "No booked tests!";
    }
    

    echo $output;
?>