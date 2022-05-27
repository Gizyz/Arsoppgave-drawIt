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
//setting global var's
var old;
var Width;
var Height;
var mousePos;
var strokeSize = 10;

var mouseDown = [0, 0];
var mouseDownCount = 0;

Clr.addEventListener("click", setup);

setup();
window.onresize = setup;
mouseClick();

//save button and upload
var modalBtn = document.getElementById("save");
var modalEl = document.getElementById("modal");

var downloadFormEl = document.forms[0];
var imgName = document.getElementById("imgName");

modalEl.addEventListener("click", modalBtnEvent);
modalBtn.addEventListener("click", modalBtnEvent);

function modalBtnEvent(event) {
  modalEl.style.display = "flex";
  if (event.target === modalEl) {
    modalEl.style.display = "none";
  }
}

function download() {
  var download = document.getElementById("download");
  var image = canvas
    .toDataURL("image/jpg")
    .replace("image/jpg", "image/octet-stream");
  download.setAttribute("href", image);
  download.setAttribute("download", imgName.value + ".jpg");
}

//Canvas functions
function setup() {
  Width = window.innerWidth;
  Height = window.innerHeight;
  canvas.width = Width;
  canvas.height = Height;
  canvas2.width = Width;
  canvas2.height = Height;
}

function oldCord(e) {
  var rect = e.target.getBoundingClientRect();
  old = {
    x: e.clientX,
    y: e.clientY - rect.top,
  };
}
//Detecting mousedown mouseup and mouseleave
function mouseClick() {
  canvas2.onmousedown = function (evt) {
    mouseDown[evt.button] = 1;
    mouseDownCount = 1;
  };
  canvas2.onmouseup = function (evt) {
    mouseDown[evt.button] = 0;
    mouseDownCount = 0;
  };
  canvas2.onmouseleave = function (evt) {
    mouseDown[evt.button] = 0;
    mouseDownCount = 0;
  };
}
//Changing strokeSize number
function drawSize() {
  strokeSize = sizeSlider.value;
  strokeSizeEl.innerHTML = "Stroke size: " + strokeSize;
}

function draw(e) {
  drawSize();
  var rect = e.target.getBoundingClientRect();
  mousePos = {
    x: e.clientX,
    y: e.clientY - rect.top,
  };
  if (mouseDownCount) {
    // alright, let's lift the little bugger up!
    if (mouseDown[0]) {
      ctx.fillStyle = color.value;
      ctx.strokeStyle = color.value;

      //ctx.fillRect(mousePos.x - strokeSize/2,mousePos.y - (50 + strokeSize/2),strokeSize,strokeSize);

      ctx.beginPath();
      ctx.arc(old.x, old.y, strokeSize, 0, 2 * Math.PI);
      ctx.fill();
      // Drawing lines inbetween circles
      ctx.lineWidth = strokeSize * 2;
      ctx.beginPath();
      ctx.moveTo(old.x, old.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();

      old = { x: mousePos.x, y: mousePos.y };

      ctx.beginPath();
      ctx.arc(old.x, old.y, strokeSize, 0, 2 * Math.PI);
      ctx.fill();
    } else if (mouseDown[2]) {
      //"Erasing by drawing in white"
      ctx.fillStyle = "white";
      ctx.beginPath();
      ctx.arc(mousePos.x, mousePos.y, strokeSize, 0, 2 * Math.PI);
      ctx.fill();

      ctx.strokeStyle = "white";
      ctx.lineWidth = strokeSize * 2;
      ctx.beginPath();
      ctx.moveTo(old.x, old.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();

      //setting old cordinates for next line placement
      old = { x: mousePos.x, y: mousePos.y - rect.top };
    }
  }
  //Cordinate view
  xCorEl.innerHTML = "x: " + Math.trunc(mousePos.x);
  yCorEl.innerHTML = "y: " + Math.trunc(mousePos.y);

  //display circle
  ctx2.clearRect(0, 0, canvas2.width, canvas2.height);
  ctx2.strokeStyle = color.value;
  ctx2.beginPath();
  ctx2.arc(mousePos.x, mousePos.y, strokeSize, 0, 2 * Math.PI);
  ctx2.stroke();
  //smaller circle to more easily see middlepoint
  ctx2.strokeStyle = "black";
  ctx2.beginPath();
  ctx2.arc(mousePos.x, mousePos.y, 1, 0, 2 * Math.PI);
  ctx2.stroke();
}
