<?php
include("config.php");
session_start();
$uid = $_SESSION["user_id"];
$random = rand(1000, 9999);
if(isset($_FILES['fileToUpload'])){
    $error = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = end(explode('.',$file_name));
    $extension = array("jpeg","jpg","png");

    if(in_array($file_ext,$extension) === false){
        $error[] = "This extension file are not allowed, Please choose a JPG or PNG file.";
    }
    if($file_size > 2097152){
        $error[] = "File size must be 2mb or lower.";
    }
    $target = time()."-".$uid."-".$random."-".$file_name;

    if(empty($error)== true){
        move_uploaded_file($file_tmp,"upload/".$target);
    }else{
        print_r($error);
        die();
    }
}else{
        echo "no upload";
}

$sql = "UPDATE users SET user_profile='{$target}' WHERE user_id = '{$uid}'";
if (mysqli_query($conn, $sql)) {
    header("Location:{$hostname}/profile.php");
    echo $file_name;
} else {
	echo "<div class='alert alert danger'>Query Failed.</div>";
}


?>