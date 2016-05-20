TODO
/*

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
 };*/