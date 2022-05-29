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
        $_SESSION["userid"] = $uidExists["user_id"];
        $_SESSION["useruid"] = $uidExists["username"];
        $_SESSION["name"] = $uidExists["name"];
        $_SESSION["url"] = $uidExists["url_address"];
        $_SESSION["email"] = $uidExists["email"];
        $_SESSION["dateCreated"] = $uidExists["date"];
        
        header("location: ../../public/index.php");
        exit();
    }
}

function createImgPath ($url) {
    if(!file_exists("../uploads/$url")) {
        $results = mkdir("../uploads/$url" , "0777");
        echo $results;
    } else {
        echo "folder already exists";
    }
}
function createTicket($conn, $email, $msg, ) {
    $sql = "INSERT INTO tickets (email, msg, date, user_id) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../public/index.php?error=ticketStmtfailed");
        exit();
    }
    $user_id = $_SESSION["userid"];
    $date = date("Y-m-d H:i:s");

    mysqli_stmt_bind_param($stmt, "ssss", $email, $msg, $date, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function imgUpload ($conn, $url, $imgName) {
    $sql = "INSERT INTO images (url_address, img_name, date) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../public/index.php?error=uploadStmtfailed");
        exit();
    }
    
    $date = date("Y-m-d H:i:s");

    mysqli_stmt_bind_param($stmt, "sss", $url, $imgName, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    $user_id = $_SESSION["userid"];
    relationTableUpdate($conn, $user_id, $imgName);
    
    header("location: ../../public/index.php?error=none");
}
function relationTableUpdate ($conn, $user_id, $imgName) {   
    // image_id
    $sql = "SELECT image_id FROM images WHERE img_name = '$imgName';";
    
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../public/index.php?error=updateRelationsImageStmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $image_id = mysqli_stmt_get_result($stmt);
    $image_id = mysqli_fetch_assoc($image_id)['image_id'];
    mysqli_stmt_close($stmt);

    //Insert into users_has_images
    $sql = "INSERT INTO users_has_images (user_id, image_id) VALUES (?,?);";
     
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../../public/index.php?error=updateRelationsImageStmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $user_id, $image_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "Navn:".$imgName."<br>"."imageId:".$image_id."<br>"."userId:".$user_id."<br>";
}
function deleteImg($conn, $url, $img_name) {
    //Deleting from sql
    $sql = "DELETE FROM images WHERE url_address = '$url' AND img_name ='$img_name'";


    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        //Couldn't prepare stmt
        header("location: ../../public/index.php?error=deleteImageStmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);


    //deleting from server
    $file = "../uploads/$url/$img_name.jpg";
    If (unlink($file)) {
        // file was successfully deleted
        header("Location: ../../public/profile.php?error=none");
      } else {
        // there was a problem deleting the file
        header("Location: ../../public/profile.php?error=fileDeleteProblem");
      }
}