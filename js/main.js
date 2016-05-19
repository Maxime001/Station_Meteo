

$(document).ready(function() {

    // Appel de la solidJauge
    solidJauge();
    // Initialisation de toutes les jauges - donnees instantanées
    initGrapheJauge('#humidite','Taux d\'humidité',' %HR',0,100,0,50,'#55BF3B',50,75,'#DDDF0D',75,100,'#DF5353',0);
    initGrapheJauge('#pluie','Capteur de pluie',' SU',0,1000,0,500,'#DF5353',500,700,'#DDDF0D',700,1000,'#55BF3B',0);
    initGrapheJauge('#pression','Baromètre','Hpa',900,1100,900,975,'#DF5353',975,1000,'#DDDF0D',1000,1100,"#55BF3B",900);
    initGrapheJauge('#temperatureExterieure','T°C Exterieure','°C',-20,45,-20,0,'#0066ff',0,25,'#55BF3B',25,45,"#DF5353",-20);
    initGrapheJauge('#luminosite','Capteur de lumière','lux',0,18000,0,500,'#0066ff',500,5000,'#55BF3B',5000,18000,"#DF5353",-20);

    // Appel du fichier json pour les données journalières ainsi que des graphiques journaliers
    importJsonJournalier();

    setInterval(function() {
        // Mise a jour du fichier Json donneesInstantanee.json 
        importJSON();
    }, 2000);
    
    
     $(".logBlock2").click(function(){
           verifId();
       });
       
    
    // Jquery sur les boutons de contrôle de l'observatoire
    var toit = true;
    var alarme = true;
    var resistance = true;
    var tension = true;
        
    $("#Toit").click(function(){
       if(toit === true){
           toit = false;
           ouvreToit();
       }
       else{
           toit = true;
           fermeToit();
       }    
    });
    $("#Alarme").click(function(){
        if(alarme === true){
           alarme = false;
           activeAlarme();
       }
       else{
           alarme = true;
           desactiveAlarme();
       } 
    });
    
    $("#Resistance").click(function(){
        if(resistance === true){
           resistance = false;
           resistanceChauffanteOn();
       }
       else{
           resistance = true;
           resistanceChauffanteOff();
       } 
    });
        
    $("#TensionTelescope").click(function(){
        if(tension === true){
           tension = false;
           tensionTelescopeOn();
       }
       else{
           tension = true;
           tensionTelescopeOff();
       } 
    });
    
    $(function() {
    var testData = {
        "statutCapteur": {
            "Accélerometre": 0,
            "Alarme": 0,
            "Arduino Télescope": 0,
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
        stripe.update(testData["statutCapteur"]);
    }

    var stripe = new Stripe(testData["statutCapteur"], 15, 35, $("#sensor_status_stripe"));
    stripe.create();
   
    setInterval(function() {
        updateJSON();
    }, 5000);
});



});