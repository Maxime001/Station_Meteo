function Theme(theme_name) {
    this.theme_name = theme_name;
}

Theme.prototype.create = function () {
    var stripes = [];
    var sensor_status_bad = [];

    for (var sensor_name in this.data) {
        if (this.data.hasOwnProperty(sensor_name)) {
            var sensor_status = this.data[sensor_name];
            var stripe_element = $('<div/>', {
                class: "stripe-element"
            });

            var stripe_element_tooltip = $('<span/>', {
                class: "stripe-element-tooltip",
                text: sensor_name + " " + sensor_status
            });

            stripe_element["sensorName"] = sensor_name;
            if (sensor_status == 1) {
                stripe_element["backgroundColor"] = "#21C721";
                stripe_element["sensorStatus"] = 1;
            }
            else {
                sensor_status_bad.push(stripe_element);
                stripe_element["backgroundColor"] = "#FF3636";
                stripe_element["sensorStatus"] = 0;
            }

            TweenLite.set(stripe_element, {
                width: this.width + "px",
                height: this.height + "px"
            });

            /*stripe_element.hover(function(){
             $(this).
             });*/

            stripes.push(stripe_element);
            stripe_element_tooltip.appendTo(stripe_element);
            stripe_element.appendTo(this.parent);
        }
    }

    this.updateText(sensor_status_bad);

    this.stripes = stripes;
    stripes = shuffleArray(stripes);

    // Animation
    for (var i = 0; i < stripes.length; i++) {
        TweenLite.fromTo(stripes[i], 0.5, {
            x: randomInt(-35, 35) + "px",
            y: randomInt(-35, 35) + "px",
            scale: 0,
            backgroundColor: "#FFF"
        }, {
            x: "0px",
            y: "0px",
            scale: 1,
            delay: i * 0.05,
            backgroundColor: stripes[i].backgroundColor,
            ease: Back.easeOut.config(3)
        });
    }

    this.started = true;
};

Theme.prototype.update = function(theme_name) {
    
};