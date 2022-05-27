<?php
// Initialize the session
include_once 'header.php';
 
// Check if the user is logged in, if not then redirect him to login page

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){  
    header("location: login.php");
    exit;
}
?>

<!--canvas-->
<div class="canvasContainer" onmousemove="oldCord(event)">
    <canvas id="canvas" width="100%" height="100%"></canvas>
    <canvas id="canvas2" width="100%" height="100%" onmousemove="draw(event)" oncontextmenu="return false"></canvas>
</div>

<div>
    <!--Clear button-->
    <button class="clear unselectable" id="cClear">Clear</button>
    <!--Save button-->
    <button class="unselectable" id="save">Save</button>

    <div class="saveContainer" id="modal">
        <div class="saveBox unselectable" >

            <!-- Bilde uppload -->
            <h1>Download/upload canvas</h1>
            <form action="../private/include/upload.inc.php" method="post" enctype="multipart/form-data">
                <input id="imgName" type="text" placeholder="Image name...">
                <a class="unselectable" id="download" download="">
                    <button type="button" onClick="download()">Save</button>
                </a>
                <input type="file" name="file" >
                <input type="submit" value="upload">
            </form>
        </div>
    </div>
    <!--Stroke Size slider-->
    <div class="sizeSlider unselectable">
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
<script src="js/script.js"></script>
</body>

</html>