<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login\login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Support</title>
</head>

<body>
    <!--Navigation bar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">DrawIT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                    <a class="nav-link" href="account.php">Account</a>
                    <a class="nav-link active" href="#">Support</a>
                    <a class="nav-link disabled">User: <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                </div>
            </div>
        </div>
    </nav>
    <section class="support">
        <div>
            <h1>How to-</h1>
            <h3>Draw?</h3>
            <p>While hovering over the canvas, simply click your left mouse button and drag.</p>
            <h3>Erase?</h3>
            <p>To erase follow the steps above while clicking right instead. </p>
            <h3>Change size?</h3>
            <p>Click and drag the slider on the left side of the screen</p><input type=" range" min="1" value="10">
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