document.addEventListener("DOMContentLoaded", function(event) {

    var g2 = new JustGage({
        id: "g2",
        value: getRandomInt(0, 100),
        min: 0,
        max: 100,
        title: "Précipitations",
        label: "oz",
        symbol: 'ppm',
        pointer: true,
        pointerOptions: {
            toplength: -15,
            bottomlength: 10,
            bottomwidth: 12,
            color: '#8e8e93',
            stroke: '#ffffff',
            stroke_width: 3,
            stroke_linecap: 'round'
        },
        gaugeWidthScale: 0.6,
        counter: true
    });

    setInterval(function() {
        g2.refresh(getRandomInt(0, 100));
    }, 2000);
});
