<?php
require_once "../autoload.php";
session_start();
if(isset($_POST['submit'])) {
    if(isset($_SESSION["url"])){
        $url = $_SESSION["url"];
        createImgPath($url);
    }
    $file = $_FILES["file"]
}
