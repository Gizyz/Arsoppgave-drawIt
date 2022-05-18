<?php
function get_random_string($length) {

    $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $text = "";

    $length = rand(4, $length);

    for($i=0;$i<$length;$i++) {

        $random = rand(0,61);

        $text .= $array[$random];
    }
    return $text;
}


//  SIGNUP FUNCTIONS
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
    $result;
    
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email) {
    $result;
    if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $email)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd, $pwdRepeat) {
    $result;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../public/signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($resultData)) {  
        return $row;
    }
    else {
        $result = false;
        return $result;
    }   

   mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $username, $email, $pwd) {
    $sql = "INSERT INTO users (url_address, name, username, email, password, date) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../public/signup.php?error=stmtfailed");
        exit();
    }
    
    $url = get_random_string(61);
    $date = date("Y-m-d H:i:s");
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $url, $name, $username, $email, $hashedPwd, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../../public/signup.php?error=none");
}


//  LOGIN FUNCTIONS
function emptyInputLogin($username, $pwd) {
    $result;
    if (strlen($username) == 0 || strlen($pwd) == 0) {
        return true;
    }
    else {
        return false;
    }
}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);
    if ($uidExists === false) {
        header("location: ../../public/login.php?error=wrongloginuidfalsewith");
        exit();
    }
    
    $pwdHashed = $uidExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    
    if ($checkPwd === false) {
        header("location: ../../public/login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["userid"] = $uidExists["id"];
        $_SESSION["useruid"] = $uidExists["username"];
        header("location: ../../public/index.php");
        exit();
    }
}