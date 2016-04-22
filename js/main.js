

$(document).ready(function() {
    // Affiche les données json
    afficheJson();
    
    // Initialisation de toutes les jauges
    initGrapheJauge('#humidite','Taux d\'humidité',' %HR',0,100,0,50,'#55BF3B',50,75,'#DDDF0D',75,100,'#DF5353',0);
    initGrapheJauge('#pluie','Capteur de pluie',' SU',0,1000,0,500,'#DF5353',500,700,'#DDDF0D',700,1000,'#55BF3B',0);
    initGrapheJauge('#pression','Baromètre','Hpa',900,1100,900,975,'#DF5353',975,1000,'#DDDF0D',1000,1100,"#55BF3B",900);
    initGrapheJauge('#temperatureExterieure','T°C Exterieure','°C',-20,45,-20,0,'#0066ff',0,25,'#55BF3B',25,45,"#DF5353",-20);
    initGrapheJauge('#luminosite','Capteur de lumière','lux',0,1000,0,50,'#0066ff',50,500,'#55BF3B',500,1000,"#DF5353",-20);

    // Appel du fichier json pour les données journalières ainsi que des graphiques journaliers
    importJson300s();

    setInterval(function() {
        // Mise a jour du fichier Json donneesInstantanee.json 
        importJSON();


    }, 2000);
});