// Jauge Theme
Highcharts.createElement('link', {
    href: '//fonts.googleapis.com/css?family=Dosis:400,600',
    rel: 'stylesheet',
    type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {
    colors: ["#7cb5ec", "#f7a35c", "#90ee7e", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
    "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
    chart: {
        backgroundColor: null,
        style: {
            fontFamily: "Dosis, sans-serif"
        }
    },
    title: {
        style: {
            fontSize: '20px',
            fontWeight: 'bold',
            textTransform: 'uppercase'
        }
    },
    tooltip: {
        borderWidth: 0,
        backgroundColor: 'rgba(219,219,216,0.8)',
        shadow: false

    },
    legend: {
        itemStyle: {
            fontWeight: 'bold',
            fontSize: '15px'
        }
    },
    xAxis: {
        gridLineWidth: 1,
        labels: {
            style: {
                fontSize: '15px'
            }
        }
    },
    yAxis: {
        minorTickInterval: 'auto',
        title: {
            style: {
                textTransform: 'uppercase'

            }
        },
        labels: {
            style: {
                fontSize: '13px'
            }
        }
    },
    plotOptions: {
        candlestick: {
            lineColor: '#404048',
            fontSize : '15px'
        }
    },
// General
background2: '#F0F0EA'
};
// Apply the theme
Highcharts.setOptions(Highcharts.theme);



// Fonction d'affichage du Json en temps réel 
function afficheJson(){
    $(function() {
        
        $('#lecture').on('click', function(){
           $('#zone').empty();
            $.getJSON('donnees.json',function(data){
                 var valeur = data.Date.length -1;
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
});
}

function importJSON() {
    $.getJSON('donnees.json', function(data) {
        updateGraphes(data);
    });
}

function updateGraphes(data) {
    updateGrapheJauge(data.humidite, "#humidite");
    updateGrapheJauge(data.detectionEau, "#pluie");
    updateGrapheJauge(data.pression,"#pression");
    updateGrapheJauge(data.temperatureInterieure,"#temperatureInterieure");
  
    // updateGrapheCourbe(blabla);
}



// ### jauge.js ###
function updateGrapheJauge(valeur,div) {
    var point = $(div).highcharts().series[0].points[0];      
    point.update(eval(valeur[valeur.length-1]));
}
// Graphique d'humidité
function initGrapheJauge(div,titre,titre2,min,max,intD1,intF1,C1,intD2,intF2,C2,intD3,intF3,C3,zero) {
    $(div).highcharts({
            chart:{
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title:{
                text: titre
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



