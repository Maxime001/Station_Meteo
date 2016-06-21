/*function updateWeather(){
    $.ajax({
        url : 'ajax.php', // La ressource ciblée
        type : 'GET', // Le type de la requête HTTP.
        data : 'requete=updateWeather'
    });
setTimeout(updateWeather,3000); 
}*/

function miseAJourPhoto(){
     $.ajax({
        url : 'ajax.php',
        type : 'GET',
        data : 'requete=miseAJourPhoto',
 success:function(){                
        var d = new Date(); 
          document.getElementById('cameraNord').src = "img/cameraNord.jpg?ver=" +d.getTime();
          document.getElementById('cameraSud').src = "img/cameraSud.jpg?ver=" + d.getTime();
        }
    });
}

// Affichage des données en dur dans main
function afficheDonnees(data){
    $('#accX').text(data.valeurCapteurs.accelerometreX);
    $('#accY').text(data.valeurCapteurs.accelerometreY);
    $('#accZ').text(data.valeurCapteurs.accelerometreZ);
    $('#capteurUltrason').text(data.valeurCapteurs.capteurUltrason);
     $('#capteurUltrason').fadeIn();
    progressbarr(data);
    meteoResume(data);
    
    
    if(data.position.toit === "ferme"){
        $('#confirmationPositionToit').text("Toit fermé");
        $('#confirmationPositionToit').fadeIn();
        $('#confirmationPositionToit').css("color","green");
    }
    else if(data.position.toit === "ouvert"){
        $('#confirmationPositionToit').text("Toit ouvert");
        $('#confirmationPositionToit').fadeIn();
        $('#confirmationPositionToit').css("color","red");
    }
    
    
}

function progressbarr(data){   
    $("#progressbar").progressbar({
        value: data.valeurCapteurs.capteurUltrason
});
};

function meteoResume(data){
    
    if(data.meteoInstantanee.detectionEau <= 200){
        $('#statusPluie').text("Pluie en cours");
        $('.load').css('display','none');
        $('.texteStatus').fadeIn();
        $('#statusPluie').delay(4000).show();
        $('#statusPluie').css("color","#DA4B4B");
    }
    
    if(data.meteoInstantanee.detectionEau > 200){
        $('#statusPluie').text("Pas de pluie");
         
        $('.texteStatus').fadeIn();
        $('#statusPluie').delay(4000).show();
        $('#statusPluie').css("color","green");
    }
    
    if(data.meteoInstantanee.luminosite === 0){
        $('#statusLumiere').attr('src','img/nuit.png');
         
        $('.texteStatus').fadeIn();
        $('#statusLumiere').delay(4000).show();
        $('#statusLumiere').css("color","green");
    }
    else{
        $('#statusLumiere').attr('src','img/jour.png');
         
        $('.texteStatus').fadeIn();
        $('#statusLumiere').delay(4000).show();
        $('#statusLumiere').css("color","red");
    }
    
    
}

function ouvreToit(){
     $.ajax({
        url : 'ajax.php',
        type : 'GET',
        data : 'requete=ouvreToit'
    });
}

function fermeToit(){
    $.ajax({
        url : 'ajax.php',
        type : 'GET',
        data : 'requete=fermeToit'
    });
}

function  activeAlarme(){
     $.ajax({
        url : 'ajax.php',
        type : 'GET',
        data : 'requete=activeAlarme'
    });
}

function desactiveAlarme(){
     $.ajax({
        url : 'ajax.php',
        type : 'GET',
        data : 'requete=desactiveAlarme'
    });    
}

function resistanceChauffanteOn(){
    $.ajax({
        url : 'ajax.php',
        type : 'GET',
        data : 'requete=resistanceChauffanteOn'
    });   
}

function resistanceChauffanteOff(){
    $.ajax({
        url : 'ajax.php',
        type : 'GET',
        data : 'requete=resistanceChauffanteOff'
    });   
}

function tensionTelescopeOn(){
    $.ajax({
        url : 'ajax.php',
        type : 'GET',
        data : 'requete=tensionTelescopeOn'
    });   
}

function tensionTelescopeOff(){
    $.ajax({
        url : 'ajax.php',
        type : 'GET',
        data : 'requete=tensionTelescopeOff'
    });   
}