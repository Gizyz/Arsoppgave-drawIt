<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>

<body>
    <nav>
        <ul>
            <a class="icon">DrawIT</a>
            <li><a href="index.php">Home</a></li>
            <li><a href="support.php">Support</a></li>
            <li><a href="trusler.php">Trusler</a></li>
            <li><a href="lover.php">Lovverk</a>
            <li>
        </ul>
        <ul>
            <?php
        // Check if the user is logged in, if not then display "signup" and "login" pages, or if user is display "profile" and "logout"
        if(isset($_SESSION["useruid"])){
            echo "<li class='userName'>User: " . htmlspecialchars($_SESSION["useruid"]) . "</li>";
            echo "<li><a href='profile.php'>Profile</a></li>";
            echo "<li><a href='../private/include/logout.inc.php'>Log out</a></li>";
        } 
        else {
            echo "<li><a href='signup.php'>Sign up</a></li>";
            echo "<li><a href='login.php'>Log in</a></li>";
        }
        ?>
        </ul>
    </nav>