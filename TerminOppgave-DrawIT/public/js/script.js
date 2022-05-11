//Canvas and context
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var canvas2 = document.getElementById("canvas2");
var ctx2 = canvas2.getContext("2d");


//Cordinates
var xCorEl = document.getElementById("xCor");
var yCorEl = document.getElementById("yCor");
//Clear button
var Clr = document.getElementById("cClear");
//Size slider
var sizeSlider = document.getElementById("sizeSlider");
var strokeSizeEl = document.getElementById("strokeSize");
//Color changer
var color = document.getElementById("color");
//random
var randomCheck = document.getElementById("randomCheck");
var old
var Width;
var Height;
var mousePos;
var strokeSize = 10;

var mouseDown = [0, 0],
mouseDownCount = 0;

Clr.addEventListener("click", setup);

setup();
window.onresize = setup;
mouseClick();

canvas2.addEventListener("onmousedown", old(e));


function setup() {
    //Width = window.innerWidth;
    //Height = window.innerHeight;
    //canvas.width = Width; 
    //canvas.height = Height;
    //canvas2.width = Width; 
    //canvas2.height = Height;
    //console.log("setup!");
}


function oldCord(e) {
    var rect = e.target.getBoundingClientRect();
    old = {
        x: e.clientX, 
        y: e.clientY-rect.top};
}

function mouseClick(e) {
    document.body.onmousedown = function(evt) { 
    mouseDown[evt.button] = 1;
    mouseDownCount = 1;
    }
    document.body.onmouseup = function(evt) {
    mouseDown[evt.button] = 0;
    mouseDownCount = 0;
    }
}



function drawSize(){
    strokeSize = sizeSlider.value;
    strokeSizeEl.innerHTML = ("Stroke size: " + strokeSize);
}

function draw(e) {
    drawSize()
    var rect = e.target.getBoundingClientRect();
    mousePos = {
        x: e.clientX,
        y: e.clientY-rect.top
    }
    if(mouseDownCount){
        // alright, let's lift the little bugger up!
            if(mouseDown[0]){

                ctx.fillStyle = color.value;
                ctx.strokeStyle = color.value;
                
                //ctx.fillRect(mousePos.x - strokeSize/2,mousePos.y - (50 + strokeSize/2),strokeSize,strokeSize);

                ctx.beginPath();
                ctx.arc(old.x,old.y, strokeSize, 0, 2 * Math.PI)
                ctx.fill();


                ctx.lineWidth = strokeSize*2;
                ctx.beginPath();
                ctx.moveTo(old.x, old.y);
                ctx.lineTo(mousePos.x,mousePos.y);
                ctx.stroke();

                old = {x: mousePos.x, y: mousePos.y}

                ctx.beginPath();
                ctx.arc(old.x,old.y, strokeSize, 0, 2 * Math.PI)
                ctx.fill();

            } else if(mouseDown[2]){

                ctx.fillStyle = ("white");
                ctx.beginPath();     
                ctx.arc(mousePos.x,mousePos.y, strokeSize, 0, 2*Math.PI)
                ctx.fill(); 


                ctx.strokeStyle = ("white");
                ctx.lineWidth = strokeSize*2;
                ctx.beginPath();
                ctx.moveTo(old.x, old.y);
                ctx.lineTo(mousePos.x,mousePos.y);
                ctx.stroke();

                old = {x: mousePos.x, y: mousePos.y}
                }
    } else {
        console.log("not pressing button")
    }

    xCorEl.innerHTML = "x: " + Math.trunc(mousePos.x);
    yCorEl.innerHTML = "y: " + Math.trunc(mousePos.y);

    //display circle
    ctx2.clearRect(0, 0, canvas2.width, canvas2.height);
    ctx2.fillStyle = color.value;
    ctx2.beginPath();
    ctx2.arc(mousePos.x,mousePos.y, strokeSize, 0, 2*Math.PI)
    ctx2.fill();
         
}


function download() {
    var download = document.getElementById("download");
    var image = canvas.toDataURL("image/jpg")
                .replace("image/jpg", "image/octet-stream");
          download.setAttribute("href", image);
          //download.setAttribute("download","archive.jpg");
          $.ajax({
            type: "POST",
            url: "photo_upload.php",
            data: {photo : dataUrl}
          })
          .done(function(respond){console.log("done: "+respond);})
          .fail(function(respond){console.log("fail");})
          .always(function(respond){console.log("always");});
}