/////////// GRAPHIQUE JAUGE ///////////

/*
 * Mise a jour des données provenant du fichier Json
 * @param {obj} data Objet contenant tout les tableaux contenant les nouvelles données
 */
function updateGraphes(data) {
    updateGrapheJauge(data.meteoInstantanee.humidite, "#humidite");
    updateGrapheJauge(data.meteoInstantanee.detectionEau, "#pluie");
    //updateGrapheJauge(data.meteoInstantanee.pression, "#pression");
    updateGrapheJauge(data.meteoInstantanee.temperatureExterieure, "#temperatureExterieure");
    updateGrapheJauge(data.meteoInstantanee.luminosite, "#luminosite");
}

/*
 * Requetes ajax pour la mise a jour des jauges
 * @param {array} valeur tableau contenant les nouvelles données
 * @param {string} div nom de l'id dans lequel sera affiché le graphique 
 */
function updateGrapheJauge(valeur,div) {
    var point = $(div).highcharts().series[0].points[0];      
    point.update(eval(valeur));
}

/*
 * Graphique des courbes 
 * @param {String} paramètres divers pour le graphique
 */
function initGrapheJauge(div,titre,titre2,min,max,intD1,intF1,C1,intD2,intF2,C2,intD3,intF3,C3,zero) {
    $(div).highcharts({
            chart:{
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            credits: {
               enabled: false
            },
            title:{
                text: titre,
                y:50
                
                
            },
            exporting: {
                enabled: false 
            },
            pane:{
                startAngle: -150,
                endAngle: 150,
                background: [{
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#FFF'],
                            [1, '#333']
                        ]
                    },
                    borderWidth: 0,
                    outerRadius: '109%'
                }, {
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#333'],
                            [1, '#FFF']
                        ]
                    },
                    borderWidth: 1,
                    outerRadius: '107%'
                }, {
                    // default background
                }, {
                    backgroundColor: '#DDD',
                    borderWidth: 0,
                    outerRadius: '105%',
                    innerRadius: '103%'
                }]
            },
            yAxis: {
                min: min,
                max: max,
                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',

                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
                title: {
                    text: titre2
                },
                plotBands: [{
                    from: intD1,
                    to: intF1,
                    color: C1 // green
                }, {
                    from: intD2,
                    to: intF2,
                    color: C2 // yellow
                }, {
                    from: intD3,
                    to: intF3,
                    color: C3 // red
                }]
            },
            series: [{
                name: titre,
                data: [zero],
                tooltip: {
                    valueSuffix: titre2
                }
            }]
        });
}