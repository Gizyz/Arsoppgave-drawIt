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
        <p>The button below changes the color of your brush</p><input type="color"></td>
        <h3></h3>
    </div>
    <div>
        <h1>Bug repport or extra questions</h1>
        <form>
            <label for="email">Mail: </label><br>
            <input type="text" name="email"><br>

            <label for="problem">Question/bug:</label><br>
            <textarea class="supportMsg" name="problem"></textarea><br>

            <input type='submit'>
        </form>
    </div>
</section>
</body>

</html>