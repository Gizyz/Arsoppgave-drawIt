<?php
require_once "../autoload.php";

if (isset($_POST["submit"])) {
    echo "it works";

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: ../../public/signup.php?error=emptyInput");
        exit();
    }
    if(invalidUid($username) !== false) {
        header("location: ../../public/signup.php?error=invaliduid");
        exit();
    }
    if(invalidEmail($email) !== false) {
        header("location: ../../public/signup.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../../public/signup.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn, $username, $email) !== false) {
        header("location: ../../public/signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $username, $email, $pwd);


}
else {
    header("location: ../../public/signup.php");
}