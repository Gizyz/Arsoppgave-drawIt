<?php
// Initialize the session
include_once 'header.php';
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<section class="support">
    <div>
        <h1>How to-</h1>
        <h3>Draw?</h3>
        <p>While hovering over the canvas, simply click your left mouse button and drag.</p>
        <h3>Erase?</h3>
        <p>To erase follow the steps above while clicking right instead. </p>
        <h3>Change size?</h3>
        <p>Click and drag the slider on the left side of the screen</p><input type="range" min="1" value="10">
        <h3>Change color?</h3>
        <p>The button below changes the color of your brush</p><input type="color">

        <h1>Profile</h1>
        <p>In the profile you can view all your stored data</p>
        <p>And all your upoloaded canvases, here you can decide to delete or download them to your device</p>
        <h1>Tickets</h1>
        <form action="../private/include/ticket.inc.php" method="post">
            <label for="email">Mail*: </label><br>
            <input type="text" name="email" placeholder="Email..."
                value="<?php echo htmlspecialchars($_SESSION['email'])?>"><br>

            <label for="problem">Question/bug:</label><br>
            <textarea class="supportMsg" name="ticketMsg" placeholder="Problem...."></textarea><br>

            <input type="submit" name="submit">
        </form>

    </div>

</section>
</body>

</html>