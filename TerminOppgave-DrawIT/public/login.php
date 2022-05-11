<?php include_once 'header.php';

$username?>


<div class="formContainer">
    <form action="../private/include/login.inc.php" method="post">
        <div id="title">Login</div>
        <input type="text" name="username" placeholder="Username/Email...">
        <input type="password" name="pwd" placeholder="Password...">
        <button type="submit" name="submit">Login</button>
    </form>

    <?php
    if (isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields</p>";
        }
        if($_GET["error"] == "wronglogin") {
            echo "<p>Incorrect login information</p>";
        }
    }
?>
</div>

<?php include_once 'footer.php'?>