<?php include_once 'header.php';?>

<div class="formContainer">
    <form class="signInUp" action="../private/include/signup.inc.php" method="post">
        <div id="title">Signup</div>
        <input type="text" name="name" placeholder="Full name...">
        <input type="text" name="email" placeholder="Email...">
        <input type="text" name="uid" placeholder="Username...">
        <input type="password" name="pwd" placeholder="Password...">
        <input type="password" name="pwdrepeat" placeholder="repeat password...">
        <button type="submit" name="submit">Sign in</button>
    </form>
    <?php 
            if (isset($_GET["error"])) {
                if($_GET["error"] == "emptyinput") {
                    echo "<p>Fille in all fields</p>";
                }
                if($_GET["error"] == "invaliduid") {
                    echo "<p>Choose a proper username</p>";
                }
                if($_GET["error"] == "invalidemail") {
                    echo "<p>Choose a proper email</p>";
                }
                if($_GET["error"] == "passwordsdontmatch") {
                    echo "<p>Password doesn't match</p>";
                }
                if($_GET["error"] == "stmtfailed") {
                    echo "<p>Something went wrong, try again</p>";
                }
                if($_GET["error"] == "usernametaken") {
                    echo "<p>Username already taken</p>";
                }
                if($_GET["error"] == "none") {
                    echo "<p>You have signed up</p>";
                }
            }
        ?>
</div>

<?php include_once 'footer.php' ?>