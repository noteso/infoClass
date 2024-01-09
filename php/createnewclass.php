<?php
    session_start();

    if(!isset($_SESSION['unique_id'])){
        header("Location:../");
    } 

    include_once "config.php";

    $classname = mysqli_real_escape_string($conn, $_POST['classname']);

    $classname = trim($classname);

    if(!empty($classname)){
        if(isset($_FILES['image'])){
            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];
                    
            $img_explode = explode('.',$img_name);
            $img_ext = end($img_explode);
    
            $extensions = ["jpeg", "png", "jpg", "PNG"];
            if(in_array($img_ext, $extensions) === true){
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if(in_array($img_type, $types) === true){
                    $ran_id = rand(time(), 100000000);

                    $class_image = "";
                    $class_image .= $ran_id . "." . $img_ext;
                    if(move_uploaded_file($tmp_name,"../classphotos/" . $class_image)){
                        $insert_query = mysqli_query($conn, "INSERT INTO classrooms (class_unique_id, class_name, class_img)
                        VALUES ({$ran_id}, '{$classname}', '{$class_image}')");
                        if($insert_query){
                            $insert_query2 = mysqli_query($conn, "INSERT INTO members (classroom_unique_id, user_unique_id)
                            VALUES ({$ran_id}, '{$_SESSION['unique_id']}')");
                            if($insert_query2){
                                echo "../conversation/?c=$ran_id";
                            }else{
                                echo "Something went wrong!";
                            }    
                        }else{
                            echo "Something went wrong. Please try again!";
                        }
                    }
                }else{
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }else{
                echo "Please upload an image file - jpeg, png, jpg";
            }
        }
    }else{
        echo "Class name is required!";
    }
?>