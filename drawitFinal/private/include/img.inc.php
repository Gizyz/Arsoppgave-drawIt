<?php
include_once '../autoload.php';

session_start();
$url = $_SESSION['url'];
$img_name = $_POST['img_name'];

if(isset($_POST['delete'])){
    echo 'deleting '. $img_name;
    deleteImg($conn, $url, $img_name);
} else {
    header('Location: ../../public/profile.php?msg=notsupposedtobehere');
}