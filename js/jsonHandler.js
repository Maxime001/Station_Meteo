/*
 * Lecture du fichier Json - donneesInstantannee.json
 */
function importJSON() {
    $.getJSON('json/controleObservatoire.json', function(data) {
        updateGraphes(data);
        updageGrapheSolidJauge(data);
    });
}

/*
 * Lecture du fichier Json - donneesJournalieres.json
 */

// fichier a modifier 
function importJsonJournalier() {
    $.getJSON('json/meteo24h.json', function(data) {
        loadDataGraphe(data);
    });
}
