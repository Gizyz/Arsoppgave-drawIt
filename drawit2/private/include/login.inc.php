<?php
require_once "../autoload.php";

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    
    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../../public/login.php?error=emptyinput");
        exit();
    }
    
    echo $username;
    loginUser($conn, $username, $pwd);
}
else {
    header("location: ../../public/login.php");
}