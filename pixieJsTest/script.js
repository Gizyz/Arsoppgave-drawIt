let app = new PIXI.Application({ width: 640, height: 360})

document.body.appendChild(app.view);

let sprite = PIXI.Sprite.from('sample.png');

app.stage.addChild(sprite);

let elapsed = 0.0;
app.ticker.add((delta) => {
    elapsed += delta;

    sprite.x = 100.0 + Math.cos(elapsed/2);
    
})