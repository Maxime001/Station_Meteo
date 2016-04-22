/*
 * Lecture du fichier Json - donneesInstantannee.json
 */
function importJSON() {
    $.getJSON('json/donneesInstantanee.json', function(data) {
        updateGraphes(data);
        updageGrapheSolidJauge(data);
    });
}

/*
 * Lecture du fichier Json - donneesJournalieres.json
 */
function importJson300s() {
    $.getJSON('json/donneesJournalieres.json', function(data) {
        loadDataGraphe(data);
    });
}


/*
 * Affichage des données Json
 */
function afficheJson(){
    $('#lecture').on('click', function () {
        $('#zone').empty();
        $.getJSON('donnees.json', function (data) {
            var valeur = data.Date.length - 1;
            $('#zone').append('Date : ' + data.Date[valeur] + '<br>');
            $('#zone').append('pression : ' + data.pression[valeur] + '<br>');
            $('#zone').append('luminosite : ' + data.luminosite[valeur] + '<br>');
            $('#zone').append('Humidite : ' + data.humidite[valeur] + '<br>');
            $('#zone').append('Photoresistance : ' + data.photoresistance[valeur] + '<br>');
            $('#zone').append('Humidite : ' + data.humidite[valeur] + '<br>');
            $('#zone').append('detectionEau : ' + data.detectionEau[valeur] + '<br>');
            $('#zone').append('mesureBruit : ' + data.mesureBruit[valeur] + '<br>');
            $('#zone').append('temperatureExterieure : ' + data.temperatureExterieure[valeur] + '<br>');
            $('#zone').append('temperatureInterieure : ' + data.temperatureInterieure[valeur] + '<br>');
            $('#zone').append('---------------------------------------------------------------------</br>');
        });
});
}