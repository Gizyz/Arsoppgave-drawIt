var canvas = document.getElementById("canvas");
var ctx = document.getElementById("canvas").getContext("2d");
var Width;
var Height;
var mX;
var mY
var mousePos;
var strokeSize = 20;
setup();
window.onresize = setup;



function setup() {
            Width = window.innerWidth;
            Height = window.innerHeight;
            canvas.width = Width; 
            canvas.height = Height;
            console.log("setup!");
        }


function draw(e) {
    setup()
    mousePos = {
        x: e.clientX,
        y: e.clientY
    };
    console.log("x: " + mousePos.x);
    console.log("y: " + mousePos.y);
    ctx.fillStyle = ("red");
    ctx.fillRect(mousePos.x - strokeSize/2,mousePos.y - (50 + strokeSize/2),strokeSize,strokeSize);
         
}