$(document).ready(function() {
    // Affichage du stripe (état des capteurs vert ou rouge)
    statusCapteurs();
    // Appel de la solidJauge
    solidJauge();
    // Initialisation de toutes les jauges - donnees instantanées
    initGrapheJauge('#humidite','Taux d\'humidité',' %HR',0,100,0,50,'#55BF3B',50,75,'#DDDF0D',75,100,'#DF5353',0);
    initGrapheJauge('#pluie','Capteur de pluie',' SU',0,1000,0,500,'#DF5353',500,700,'#DDDF0D',700,1000,'#55BF3B',0);
    initGrapheJauge('#pression','Baromètre','Hpa',900,1100,900,975,'#DF5353',975,1000,'#DDDF0D',1000,1100,"#55BF3B",900);
    initGrapheJauge('#temperatureExterieure','T°C Exterieure','°C',-20,45,-20,0,'#0066ff',0,25,'#55BF3B',25,45,"#DF5353",-20);
    initGrapheJauge('#luminosite','Capteur de lumière','lux',0,65536,0,2000,'#0066ff',2000,50000,'#DF5353',50000,65536,"#55BF3B",0);

    // Appel du fichier json pour les données journalières ainsi que des graphiques journaliers
    importJsonJournalier();

    // Mise a jour du fichier Json donneesInstantanee.json 
    setInterval(function() {
        importJSON();
    }, 3000);
    
    // Requetes Ajax plus rapides si ouverture ou fermeture du toit demandée
    var setIntervalFaster = function(){
        var i = 0;
        var interval = setInterval(function(){
            importJSON();
            i++;
            if(i>240){
                clearInterval(interval);   
            }
        }, 500); 
    };
    
    // Mise a jour des fichiers jpg des caméras IP 
    setInterval(function() {
        miseAJourPhoto();
    },15000);
    
    $(".textControl").delay(1000).show('fast');
   
    // Validation de l'affichage ou non des commandes de l'observatoire (sécurité supplémentaire)
    $('#validChange').on('change',function(){
       if($('#validChange').is(':checked')){
            var validation = prompt('activer les commandes ?');
            if(validation === "y" || validation === "Y"){
                $('.commandesTelescopeStyle').fadeIn();
            }
            else{
                return false;
            }
        }
       else{
           $('.commandesTelescopeStyle').fadeOut();
        }
    });
    
    // Affichage de la progressbarr
    var dist=0;
    function progressbarr(){   
        $("#progressbar").progressbar({
            value: dist
        });   
    }
    progressbarr();

    // Disparition du titre
    window.setTimeout(function(){
        $('#titresecondaire').delay(10000).fadeOut(1000);
        $('.affichageJauges').css('padding-top','-20px');
    },1000);
    
        
    // Fonction d'envoi des commandes d'ouverture du toit 
    $('#ouvreToit').on('click',function(){
        $.getJSON('json/controleObservatoire.json', function(data) {
            var capteurPluie = data.meteoInstantanee.detectionEau;
            if(capteurPluie > 300){
                setIntervalFaster();
                envoiCommande("ouvreToit");
                sms('Ouverture du toit de l\'observatoire');
            }
            else{
                alert("il pleut, on ne peux pas ouvrir le toit");
                return false;
            }
        });  
    });
    
    // Fonction d'envoi de commande de fermeture du toit
    $('#fermeToit').on('click',function(){
        setIntervalFaster();
        envoiCommande("fermeToit");
        sms('Fermeture du toit de l\'observatoire');
    });
    // Fonction d'envoi de commande d'arrêt du toit 
    $('#arretToit').on('click',function(){
       envoiCommande("arretToit");
        sms('Arrêt du moteur du toit de l\'observatoire');
    });

    // Jquery sur les boutons de contrôle de l'observatoire
    var alarme = "";
    var self = this;
    var resistance = "";
    var tension = "";
    
    // Activation / Désactivation de l'alarme
    $("#Alarme").click(function(){
        $.getJSON('json/controleObservatoire.json', function (data) {
            var statusAlarme = data.position.alarme;
            // vérifier si checked ou non etc pour chaque capteur 
            if(statusAlarme === "desactivee"){
                envoiCommande("activeAlarme");
               
               statusAlarme =""; 
               sms('L\'alarme s\'active');
           }
           else if(statusAlarme === "activee"){
               envoiCommande("desactiveAlarme");
              
              statusAlarme="";
              sms('L\'alarme se désactive');
               
           } 
        });
    });
    
    // Activation / Désactivation de la résistance chauffante
    $("#Resistance").click(function(){
        $.getJSON('json/controleObservatoire.json', function (data) {
            var statusResistance = data.position.resistanceChauffante;
            if(statusResistance === "off"){
                envoiCommande("resistanceChauffanteOn");
             
               statusResistance = "";
               sms('La résistance chauffante s\'est allumee');
           }
           else if(statusResistance === "on"){
               envoiCommande("resistanceChauffanteOff")
              
               statusResistance = "";
                sms('La résistance chauffante s\'est eteinte');
           } 
        });
    });
    
    // Activation / Désactivation du 220V 
    $("#TensionTelescope").click(function(){
        $.getJSON('json/controleObservatoire.json', function (data) {
            var statusTensionTelescope = data.position.tension;
            if(statusTensionTelescope === "off"){
                envoiCommande("tensionTelescopeOn");
              
               statusTensionTelescope ="";
                sms('Tension télescope ON');
           }
           else if(statusTensionTelescope === "on"){
               envoiCommande("tensionTelescopeOff");
               statusTensionTelescope = "";
                sms('Tension télescope OFF');
           } 
        });
    });
    
    function statusCapteurs(){
        $(function() {
            $.getJSON('json/controleObservatoire.json', function(data) {
                function updateJSON() {
                    $.getJSON('json/controleObservatoire.json', function(data) {
                        stripe.update(data.statutCapteur);
                    });
                }
            var stripe = new Stripe(data.statutCapteur, 15, 35, $("#sensor_status_stripe"));
            stripe.create();
            setInterval(function() {
                    updateJSON();
                }, 60000);
            });
        }); 
    }
     
    $(".logBlock2").click(function(){
        verifId();
    });  
});






