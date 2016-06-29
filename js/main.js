

$(document).ready(function() {

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
    
    var setIntervalFaster = function(){
        var i = 0;
        var test = setInterval(function(){
            importJSON();
            i++;
            if(i>240){
                clearInterval(test);   
            }
        }, 500);
        
    };
    
    // Mise a jour des fichiers jpg des caméras IP 
    setInterval(function() {
        miseAJourPhoto();
    },15000);
    
    $(".textControl").delay(1000).show('fast');
   
    
     $(".logBlock2").click(function(){
           verifId();
       });
        
    // Validation de l'affichage ou non des commandes de l'observatoire (sécurité supplémentaire)
    $('#validChange').on('change',function(){
       if($('#validChange').is(':checked')){
             var validation = prompt('activer les commandes ? y/n');
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
    
    // Progressbarr
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
    
        
    // Fonction d'envoi des commandes d'ouverture et de fermeture du toit 
    $('#ouvreToit').on('click',function(){
        $.getJSON('json/controleObservatoire.json', function(data) {
        var capteurPluie = data.meteoInstantanee.detectionEau;
       if(capteurPluie > 300){
            setIntervalFaster();
        ouvreToit();
    }
    else{
        alert("il pleut, on ne peux pas ouvrir le toit");
        return false;
    }
        });
        
    });
    $('#fermeToit').on('click',function(){
       setIntervalFaster();
       fermeToit();
    });
    
    $('#arretToit').on('click',function(){
       arretToit(); 
    });



    // Jquery sur les boutons de contrôle de l'observatoire
    var alarme = "";
    var self = this;
    var resistance = "";
    var tension = "";
   /*
    $.getJSON('json/controleObservatoire.json', function (data) {
        var statusAlarme = data.position.alarme;
        var statusResistance = data.position.resistanceChauffante;
        var statusTension = data.position.tension;
        
        if(statusAlarme === "activee"){
           self.alarme = false;
        }
        else{
           self.alarme = true;
        }
    });
*/

    
    $("#Alarme").click(function(){
        $.getJSON('json/controleObservatoire.json', function (data) {
            var statusAlarme = data.position.alarme;
            // vérifier si checked ou non etc pour chaque capteur 
            if(statusAlarme === "desactivee"){
               activeAlarme();
               statusAlarme =""; 
           }
           else if(statusAlarme === "activee"){
               desactiveAlarme();
              statusAlarme="";
           } 
        });
    });
    
    $("#Resistance").click(function(){
        $.getJSON('json/controleObservatoire.json', function (data) {
            var statusResistance = data.position.resistanceChauffante;
            if(statusResistance === "off"){
               resistanceChauffanteOn();
               statusResistance = "";
           }
           else if(statusResistance === "on"){
               resistanceChauffanteOff();
               statusResistance = "";
           } 
        });
    });
        
    $("#TensionTelescope").click(function(){
        $.getJSON('json/controleObservatoire.json', function (data) {
            var statusTensionTelescope = data.position.tension;
            if(statusTensionTelescope === "off"){
               tensionTelescopeOn();
               statusTensionTelescope ="";
           }
           else if(statusTensionTelescope === "on"){
               tensionTelescopeOff();
               statusTensionTelescope = "";
           } 
        });
    });
    

    statusCapteurs();
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

