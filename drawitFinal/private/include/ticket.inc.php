<?php
require_once '../autoload.php';
session_start();
if(isset($_POST['submit'])) {
    $msg = $_POST['ticketMsg'];
    $email = $_POST['email'];
    echo "$msg";
    echo "$email";
    createTicket($conn, $email, $msg);
}

//header("location: ../../public/support.php")