function Stripe(data, width, height, parent) {
    this.data = data;
    this.width = width;
    this.height = height;
    this.parent = parent;
    this.started = false;
}

Stripe.prototype.create = function () {
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

Stripe.prototype.update = function (data) {
    this.data = data;
    var i = 0;
    var stripes_to_update = [];
    var sensor_status_bad = [];
    var statusChanged = false;

    for (var sensor_name in this.data) {
        if (this.data.hasOwnProperty(sensor_name)) {
            var sensor_status = this.data[sensor_name];

            for (i = 0; i < this.stripes[i].length; i++) {
                // Changing status
                if (this.stripes[i].sensorName == sensor_name
                    && sensor_status != this.stripes[i].sensorStatus) {
                    if (sensor_status == 1) {
                        this.stripes[i]["backgroundColor"] = "#21C721";
                        this.stripes[i]["sensorStatus"] = 1;
                    }
                    else {
                        this.stripes[i]["backgroundColor"] = "#FF3636";
                        this.stripes[i]["sensorStatus"] = 0;
                    }

                    stripes_to_update.push(this.stripes[i]);
                    statusChanged = true;
                    console.log("pass");
                }
            }

            if (sensor_status != 1) {
                sensor_status_bad.push(this.stripes[i]);
            }

            i++;
        }
    }

    if (statusChanged) {
        this.updateText(sensor_status_bad);

        // Animations
        TweenMax.staggerTo(stripes_to_update, 0.4, {
            opacity: 0,
            scaleY: 0.5
        });

        for (i = 0; i < stripes_to_update.length; i++) {
            TweenMax.fromTo(stripes_to_update[i], 0.5, {
                x: randomInt(-10, 10) + "px",
                y: randomInt(-10, 10) + "px",
                scale: 0,
                backgroundColor: "#FFF",
                immediateRender: false
            }, {
                x: "0px",
                y: "0px",
                opacity: 1,
                scale: 1,
                delay: 0.4 + i * 0.05,
                backgroundColor: stripes_to_update[i].backgroundColor,
                ease: Back.easeOut.config(3)
            });
        }
    }
    else {
        var sensor_status_stripes = $("#sensor_status_stripe").children();

        for (i = 0; i < sensor_status_stripes.length; i++) {
            TweenLite.to(sensor_status_stripes[i], 0.4, {
                scale: 0.7,
                ease: Power2.easeOut,
                delay: i * 0.05
            });
            TweenLite.to(sensor_status_stripes, 0.4, {
                scale: 1,
                ease:Bounce.easeOut,
                delay: i * 0.1
            });
        }
    }
};

Stripe.prototype.createText = function(sensor_status_bad, sensor_status_text, delay) {
    var sensor_status_bad_text_elements = [];

    for (var i = 0; i < sensor_status_bad.length; i++) {
        var sensor_status_bad_text = $('<div/>', {
            text: "- " + sensor_status_bad[i].sensorName
        });

        sensor_status_bad_text_elements.push(sensor_status_bad_text);
        sensor_status_bad_text.appendTo(sensor_status_text);
    }

    TweenLite.set(sensor_status_text, {
        perspective: 400
    });

    TweenLite.set(sensor_status_text.children(), {
        opacity: 0
    });
    // Animation
    for (i = 0; i < sensor_status_bad_text_elements.length; i++) {
        TweenLite.set(sensor_status_bad_text_elements[i], {
            transformStyle:"preserve-3d",
            transformOrigin:'0% 0% 0%'
        });
        TweenLite.fromTo(sensor_status_bad_text_elements[i], 0.5, {
            scale: 0.8,
            opacity: 1,
            rotationX: -90,
            immediateRender: false
        }, {
            scale: 1,
            opacity: 1,
            rotationX: 0,
            delay: delay + i * 0.1,
            ease: Back.easeOut.config(2)
        });
    }
};

Stripe.prototype.updateText = function(sensor_status_bad) {
    var sensor_status_text = $("#sensor_status_text");

    if (sensor_status_bad.length != 0 && this.started) {
        var self = this;

        TweenMax.staggerTo(sensor_status_text.children(), 0.5, {
            opacity: 0,
            rotationZ: 25,
            x: "80px",
            scale: 0.2
        }, -0.05, function() {
            sensor_status_text.empty();
            self.createText(sensor_status_bad, sensor_status_text, 0);
        })
    }
    else if (sensor_status_bad.length != 0) {
        this.createText(sensor_status_bad, sensor_status_text, 1);
    }
};