$(function() {
    var testData = {
        "statutCapteur": {
            "Accélerometre": 1,
            "Alarme": 1,
            "Arduino Télescope": 1,
            "Bruit": 0,
            "Distance Ouverture Toit": 1,
            "Hall Position": 0,
            "Hall Position Toit Est": 1,
            "Hall Position Toit Ouest": 0,
            "Humidite": 0,
            "Lux": 0,
            "Pluie": 0,
            "Pression": 1,
            "Température Intérieure": 0,
            "Température Résistance Chauffante": 0,
            "Etat PC": 0,
            "Photorésistance Laser": 0,
            "Relai 220V": 1
        }
    };


    function updateJSON() {
        /*testData["statutCapteur"] = generateRandomStatusData(testData["statutCapteur"]);*/
        stripe.update(testData["statutCapteur"]);
    }

    var stripe = new Stripe(testData["statutCapteur"], 10, 25, $("#sensor_status_stripe"));
    stripe.create();
   
    setInterval(function() {
        updateJSON();
    }, 5000);
});