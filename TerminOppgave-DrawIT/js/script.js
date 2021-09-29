//Canvas and context
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
//Cordinates
var xCorEl = document.getElementById("xCor");
var yCorEl = document.getElementById("yCor");
//Clear button
var cClr = document.getElementById("cClear");
//Size slider
var sizeSlider = document.getElementById("sizeSlider");
var strokeSizeEl = document.getElementById("strokeSize");
//Color changer
var colorR = document.getElementById("colorR")
var colorG = document.getElementById("colorG")
var colorB = document.getElementById("colorB")

var Width;
var Height;
var mousePos;
var strokeSize = 10;

var mouseDown = [0, 0, 0, 0, 0, 0, 0, 0, 0],
mouseDownCount = 0;

setup();
window.onresize = setup;

mouseClick()

cClr.addEventListener("click", setup);


function mouseClick(e) {
    // let's pretend that a mouse doesn't have more than 9 buttons

    document.body.onmousedown = function(evt) { 
    ++mouseDown[evt.button];
    ++mouseDownCount;
    }
    document.body.onmouseup = function(evt) {
    --mouseDown[evt.button];
    --mouseDownCount;
    }
}

function setup() {
    Width = window.innerWidth;
    Height = window.innerHeight;
    canvas.width = Width; 
    canvas.height = Height;
    console.log("setup!");
}
function drawSize(){
    strokeSize = sizeSlider.value;
    strokeSizeEl.innerHTML = ("Stroke size: " + strokeSize);
}

function draw(e) {
    drawSize()



    mousePos = {
        x: e.clientX,
        y: e.clientY - 50
    };

    xCorEl.innerHTML = "x: " + mousePos.x
    yCorEl.innerHTML = "y: " + mousePos.y



    if(mouseDownCount){
        // alright, let's lift the little bugger up!
        for(var i = 0; i < mouseDown.length; ++i){
          if(mouseDown[0]){
            // we found it right there!

            console.log("pressing button: " + mouseDown[0])
            

            
            ctx.fillStyle = "rgb("+ colorR.value + "," + colorG.value + "," + colorB.value + ")";
            //ctx.fillRect(mousePos.x - strokeSize/2,mousePos.y - (50 + strokeSize/2),strokeSize,strokeSize);
            ctx.beginPath();
            ctx.arc(mousePos.x,mousePos.y, strokeSize, 0, 2*Math.PI)
            ctx.fill();
           }
           if(mouseDown[2]){
            // we found it right there!

            console.log("pressing button: " + 2)

            ctx.fillStyle = ("white");
            //ctx.fillRect(mousePos.x - strokeSize/2,mousePos.y - (50 + strokeSize/2),strokeSize,strokeSize);
            ctx.beginPath();
            /* ctx.arc(x, y, radius, startAngle, endAngle[, counterclockwise] */
            ctx.arc(mousePos.x,mousePos.y, strokeSize, 0, 2*Math.PI)
            ctx.fill(); 
           }   
        }
    } else {
        console.log("not pressing button")
    }
         
}
