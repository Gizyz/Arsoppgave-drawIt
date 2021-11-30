<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TerminOppgave-DrawIT</title>
    <link rel="stylesheet" type="text/css" href="css\style.css">
</head>

<body>
    <!--Navigation bar-->
    <nav class="container">
        <a href="index.php">
            <h1 class="title">DrawIT</h1>
        </a>
        <a href="account.php">
            <p class="item">Account</p>
        </a>
        <a href="help.php">
            <p class="item">Help</p>
        </a>
        <a href="account.php">
            <p class="item">User support</p>
        </a>
    </nav>
    <!--canvas-->
    <div>
        <canvas id="canvas" width="100%" height="100%" oncontextmenu="return false"></canvas>
        <canvas id="canvas2" width="100%" height="100%" onmousemove="draw(event)" oncontextmenu="return false"></canvas>
    </div>
    <div>
        <!--Clear button-->
        <button class="clear" id="cClear">Clear</button>

        <!--Stroke Size slider-->
        <div class="sizeSlider">
            <p id="strokeSize">Stroke size: </p>
            <input type="range" id="sizeSlider" min="1" value="10">
        </div>
        <!--Mouse Cordinates-->
        <div class="cords unselectable">
            <p id="xCor">x: 0</p>
            <p id="yCor">y: 0</p>
        </div>

        <!--Color-->
        <div class="colorSelector">
            <input id="color" type="color"></td>
        </div>
    </div>
    <!--RANDOM-->
    <input id="randomCheck" class="random" type="checkbox">
    <script src="js\script.js"></script>
</body>

</html>