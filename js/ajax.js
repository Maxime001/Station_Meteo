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