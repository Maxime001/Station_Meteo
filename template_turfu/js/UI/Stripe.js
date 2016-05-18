function Stripe(data, width, height, parent) {
    this.data = data;
    this.width = width;
    this.height = height;
    this.parent = parent;
}

Stripe.prototype.create = function() {
    var stripes = [];
    var sensor_status_bad = [];
    var className = "";

    for (var sensor_name in this.data) {
        if (this.data.hasOwnProperty(sensor_name)) {
            var sensor_status = this.data[sensor_name];
            var stripe_element = $('<span/>', {
                class: "stripe-element",
                title: sensor_name
            });

            stripe_element["sensorName"] = sensor_name;
            if (sensor_status == 1) {
                stripe_element["backgroundColor"] = "#21C721";
                stripe_element["sensorStatus"] = 1;
                className = "ui-tooltip-status-ok";
            }
            else {
                sensor_status_bad.push(stripe_element);
                stripe_element["backgroundColor"] = "#FF3636";
                stripe_element["sensorStatus"] = 0;
                className = "ui-tooltip-status-bad";
            }

            TweenLite.set(stripe_element, {
                width: this.width + "px",
                height: this.height + "px"
            });

            $(stripe_element).tooltip({
                track: true,
                content: sensor_name,
                tooltipClass: className,
                close: function(event, ui) {
                    $(".ui-helper-hidden-accessible").remove();
                }
            });

            stripes.push(stripe_element);
            stripe_element.appendTo(this.parent);
        }
    }

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
};

Stripe.prototype.update = function(data) {
    this.data = data;
    var stripes_to_update = [];
    var statusChanged = false;
    var className = "";

    for (var sensor_name in this.data) {
        if (this.data.hasOwnProperty(sensor_name)) {
            var sensor_status = this.data[sensor_name];

            for (var i = 0; i < this.stripes.length; i++) {
                // Changing status
                if (this.stripes[i].sensorName == sensor_name
                    && sensor_status != this.stripes[i].sensorStatus) {
                    if (sensor_status == 1) {
                        this.stripes[i]["backgroundColor"] = "#21C721";
                        this.stripes[i]["sensorStatus"] = 1;
                        className = "ui-tooltip-status-ok";
                    }
                    else {
                        this.stripes[i]["backgroundColor"] = "#FF3636";
                        this.stripes[i]["sensorStatus"] = 0;
                        className = "ui-tooltip-status-bad";
                    }

                    stripes_to_update.push(this.stripes[i]);
                    statusChanged = true;
                    $(this.stripes[i]).tooltip({
                        track: true,
                        content: sensor_name,
                        tooltipClass: className,
                        close: function(event, ui) {
                            $(".ui-helper-hidden-accessible").remove();
                        }
                    });
                }
            }
        }
    }

    if (statusChanged) {
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