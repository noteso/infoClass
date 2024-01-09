<?php
    session_start();

    if(!isset($_SESSION['unique_id'])){
        header("Location:../");
    } 

    include_once "config.php";



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
            if(isset($_POST['classid'])){
                $classid = mysqli_real_escape_string($conn, $_POST['classid']);

                $class_image = "";
                $class_image .= $classid . "." . $img_ext;
                if(move_uploaded_file($tmp_name,"../classphotos/" . $class_image)){
                    
                    $update_query = mysqli_query($conn, "UPDATE classrooms SET class_img = '{$class_image}' WHERE class_unique_id = {$classid}");
                    if($update_query){
                        echo "success";
                    }
                }
            }else{
                echo "Somethong went wrong!";
            }
        }else{
            echo "Please upload an image file - jpeg, png, jpg";
        }
    }else{
        echo "Please upload an image file - jpeg, png, jpg";
    }
    exit;
}

//name change

if(isset($_POST['classname']) && isset($_POST['classid'])){
    $classname = mysqli_real_escape_string($conn, $_POST['classname']);
    $classid = mysqli_real_escape_string($conn, $_POST['classid']);

    if(!empty($classname) && !empty($classid)){
        $update_query1 = mysqli_query($conn, "UPDATE classrooms SET class_name = '{$classname}' WHERE class_unique_id = {$classid}");

        if($update_query1){
            echo "success";
        }else{
            echo "something went wrong";
        }
    }
    exit;
}

// returns members

if(isset($_POST['classroom_members'])){
    $classid = mysqli_real_escape_string($conn, $_POST['classroom_members']);

    if(!empty($classid)){
        $sql = mysqli_query($conn, "SELECT * FROM members INNER JOIN users ON members.user_unique_id=users.unique_id WHERE classroom_unique_id = {$classid}");

        $output = "";

        if(mysqli_num_rows($sql) > 0){
            while($row = mysqli_fetch_assoc($sql)){
                $output .= '<div class="row border justify-content-center align-items-center border-primary rounded py-2 my-2">
                                <div class="col-2">
                                    <img src="../profilephotos/' . $row['img'] . '" style="width: 40px; height: 40px;" class="rounded-circle border border-light p-0">
                                </div>
                                <div class="col-6 m-0 overflow-hidden text-wrap text-break fw-bold text-primary">
                                    <p class="m-0">' . $row['fname'] . " " . $row['lname'] . '</p>
                                    <p class="m-0 text-muted">@' . $row['username'] . '</p>
                                </div>
                                <div class="col-4 d-flex justify-content-around">
                                    <a href="../profile/?q=' . $row['username'] . '" class="btn btn-primary rounded" title="View profile"><i class="bi bi-display"></i></a>
                                    <button onclick="removemember(' . $classid .', ' . $row['unique_id'] .')" class="btn btn-danger rounded" title="Remove Member"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>';
            }
        }else{
            $output .= "There are no members!";
        }
    }
    echo $output;
    exit;
}

//search members

if(isset($_POST['usersearch']) && isset($_POST['classid'])){
    $classid = mysqli_real_escape_string($conn, $_POST['classid']);
    $usersearch = mysqli_real_escape_string($conn, $_POST['usersearch']);

    $usersearch = trim($usersearch);

    $output = "";

    if(!empty($classid) && !empty($usersearch)){
        if($usersearch[0] == "@"){
            $substr = substr($usersearch, 1);
            $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '%{$substr}%'");

            if(mysqli_num_rows($sql1) > 0){
                while($row1 = mysqli_fetch_assoc($sql1)){
                    $sql2 = mysqli_query($conn, "SELECT * FROM members WHERE classroom_unique_id = {$classid} AND user_unique_id = {$row1['unique_id']}");

                    if(mysqli_num_rows($sql2) <= 0){
                        $output .= '<div class="row border justify-content-center align-items-center border-primary rounded py-2 my-2">
                                        <div class="col-2">
                                            <img src="../profilephotos/' . $row1['img'] . '" style="width: 40px; height: 40px;" class="rounded-circle border border-light p-0">
                                        </div>
                                        <div class="col-6 m-0 overflow-hidden text-wrap text-break fw-bold text-primary">
                                            <p class="m-0">' . $row1['fname'] . " " . $row1['lname'] . '</p>
                                            <p class="m-0 text-muted">@' . $row1['username'] . '</p>
                                        </div>
                                        <div class="col-4 d-flex justify-content-around">
                                            <a href="../profile/?q=' . $row1['username'] . '" class="btn btn-primary rounded" title="View profile"><i class="bi bi-display"></i></a>
                                            <button onclick="addmember(' . $classid . ', ' . $row1['unique_id'] . ')" class="btn btn-success rounded" title="Add member"><i class="bi bi-plus-lg"></i></button>
                                        </div>
                                    </div>';
                    }

                    
                }
            }else{
                $output .= "No users found!";
            }
        }else{   
            $substrr = explode(" ", $usersearch);
            
            for($i = 0; $i < count($substrr); $i++){
                $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE fname LIKE '%{$substrr[$i]}%' OR lname LIKE '%{$substrr[$i]}%'");

                if(mysqli_num_rows($sql1) > 0){
                    while($row1 = mysqli_fetch_assoc($sql1)){
                        $sql2 = mysqli_query($conn, "SELECT * FROM members WHERE classroom_unique_id = {$classid} AND user_unique_id = {$row1['unique_id']}");

                        if(mysqli_num_rows($sql2) <= 0){
                            $output1 = '<div class="row border justify-content-center align-items-center border-primary rounded py-2 my-2">
                                            <div class="col-2">
                                                <img src="../profilephotos/' . $row1['img'] . '" style="width: 40px; height: 40px;" class="rounded-circle border border-light p-0">
                                            </div>
                                            <div class="col-6 m-0 overflow-hidden text-wrap text-break fw-bold text-primary">
                                                <p class="m-0">' . $row1['fname'] . " " . $row1['lname'] . '</p>
                                                <p class="m-0 text-muted">@' . $row1['username'] . '</p>
                                            </div>
                                            <div class="col-4 d-flex justify-content-around">
                                                <a href="../profile/?q=' . $row1['username'] . '" class="btn btn-primary rounded" title="View profile"><i class="bi bi-display"></i></a>
                                                <button onclick="addmember(' . $classid . ', ' . $row1['unique_id'] . ')" class="btn btn-success rounded" title="Add member"><i class="bi bi-plus-lg"></i></button>
                                            </div>
                                        </div>';
                            if(strpos($output, $output1) === false){
                                $output .= $output1;
                            }
                        }

                        
                    }
                }
            }
        }
    }
    if(empty($output)){
        $output .= "No users found!";
    }
    echo $output;
    exit;
}

//add member

if(isset($_POST['classid']) && isset($_POST['userid'])){
    $classid = mysqli_real_escape_string($conn, $_POST['classid']);
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);

    if(!empty($classid) && !empty($userid)){
        $sql = mysqli_query($conn, "INSERT INTO members (classroom_unique_id, user_unique_id)
                                    VALUES ({$classid}, {$userid})");

        if($sql){
            echo "success";
        }else{
            echo "Something went wrong!";
        }
    }
    exit;
}

// remove member

if(isset($_POST['removeclassid']) && isset($_POST['removeuserid'])){
    $removeclassid = mysqli_real_escape_string($conn, $_POST['removeclassid']);
    $removeuserid = mysqli_real_escape_string($conn, $_POST['removeuserid']);

    if(!empty($removeclassid) && !empty($removeuserid)){
        $sql = mysqli_query($conn, "DELETE FROM members WHERE classroom_unique_id = {$removeclassid} AND user_unique_id = {$removeuserid}");

        if($sql){
            if($removeuserid == $_SESSION['unique_id']){
                echo "kickout";
            }else{
                echo "success";
            }
        }else{
            echo "Something went wrong!";
        }
    }
    exit;
}


?>