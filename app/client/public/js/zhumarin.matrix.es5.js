var canvas = document.getElementById("matrix");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

var pos = [];
while (pos.length != 300)
    pos.push(0);

var ctx = canvas.getContext('2d');

setInterval(function () {
    ctx.fillStyle = 'rgba(248, 249, 250, 0.05)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#c3c3c3';
    ctx.font = '10pt Georgia';
    pos.map(function(y, index) {
        var text = String.fromCharCode(1e2 + Math.random() * 33);
        x = (index * 10) + 10;
        ctx.fillText(text, x, y);
        if (y > 100 + Math.random() * 1e4)
            pos[index] = 0;
        else
            pos[index] = y + 10;
    });
}, 33);
