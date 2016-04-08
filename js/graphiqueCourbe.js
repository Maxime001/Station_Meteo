/////////// GRAPHIQUE COURBE ///////////

function loadDataGraphe(data){
    // Options pour chaque graphique
        // Humidite
    GrapheCourbeHumidite = {
        data : data.humidite,
        div : "#grapheHumidite",
        titre: "humidité",
        soustitre:"Humidite ambiante pour la journée",
        mini:0,
        maxi:100,
        unite:"%HR",
        limd1:0,
        limf1:50,
        valeur1:"Air sec",
        couleur1:"#606060",
        limd2:50,
        limf2:70,
        valeur2:"Air humide",
        couleur2:"#606060",
        limd3:70,
        limf3:80,
        valeur3:"Air très humide",
        couleur3:"#606060",
        limd4:80,
        limf4:90,
        valeur4:"Air saturé en eau",
        couleur4:"#606060",
        limd5:90,
        limf5:100,
        valeur5:"Pluie très probable",
        couleur5:"#606060"
    };
    // Options pour graphique de température exterieure
    GrapheCourbeTemperatureExt = {
        data : data.temperatureExterieure,
        div : "#grapheTemperatureExterieure",
        titre: "Température Exterieure",
        soustitre:"Températures de la journée",
        mini:-20,
        maxi:45,
        unite:"%HR",
        limd1:-20,
        limf1:0,
        valeur1:"",
        couleur1:"#606060",
        limd2:0,
        limf2:20,
        valeur2:"",
        couleur2:"#606060",
        limd3:20,
        limf3:40,
        valeur3:"",
        couleur3:"#606060",
        limd4:40,
        limf4:50,
        valeur4:"",
        couleur4:"#606060",
        limd5:90,
        limf5:100,
        valeur5:"",
        couleur5:"#606060"
    };
    // Options pour le graphique de détection d'eau
    GrapheCourbeDetectionEau = {
        data : data.detectionEau,
        div : "#grapheDetectionEau",
        titre: "Detection d'eau",
        soustitre:"Detection d'eau aujourd'hui",
        mini:0,
        maxi:1000,
        unite:"SU",
        limd1:0,
        limf1:250,
        valeur1:"Pluie",
        couleur1:"#606060",
        limd2:250,
        limf2:500,
        valeur2:"Humide",
        couleur2:"#606060",
        limd3:500,
        limf3:1000,
        valeur3:"Sec",
        couleur3:"#606060",
        limd4:"",
        limf4:"",
        valeur4:"",
        couleur4:"#606060",
        limd5:"",
        limf5:"",
        valeur5:"",
        couleur5:"#606060"
    };
    // Options pour le graphique de luminosité
    GrapheCourbeLuminosite = {
        data : data.luminosite,
        div : "#grapheLuminosite",
        titre: "Luminosité du ciel",
        soustitre:"Graphique de la luminosité du jour",
        mini:0,
        maxi:1000,
        unite:"SU",
        limd1:0,
        limf1:250,
        valeur1:"Pluie",
        couleur1:"#606060",
        limd2:250,
        limf2:500,
        valeur2:"Humide",
        couleur2:"#606060",
        limd3:500,
        limf3:1000,
        valeur3:"Sec",
        couleur3:"#606060",
        limd4:"",
        limf4:"",
        valeur4:"",
        couleur4:"#606060",
        limd5:"",
        limf5:"",
        valeur5:"",
        couleur5:"#606060"
    };
    
    initGrapheCourbe(GrapheCourbeHumidite);
    initGrapheCourbe(GrapheCourbeTemperatureExt);
    initGrapheCourbe(GrapheCourbeDetectionEau);
    initGrapheCourbe(GrapheCourbeLuminosite);
}

function initGrapheCourbe(valeur){
    
    $(valeur.div).highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: valeur.titre
        },
        credits: {
               enabled: false
            },
        exporting:{
        	enabled:false
        },
        subtitle: {
            text: valeur.soustitre
        },
        xAxis: {
            type: 'datetime',
            labels: {
                overflow: 'justify'
            }
        },
        yAxis: {
       			min:valeur.mini,
       			max:valeur.maxi,
            title: {
                text: valeur.unite
            },
            minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
            plotBands: [{ 
                from: valeur.limd1,
                to: valeur.limf1,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: valeur.valeur1,
                    style: {
                        color: valeur.couleur1
                    }
                }
            }, { // Light breeze
                from: valeur.limd2,
                to: valeur.limf2,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: valeur.valeur2,
                    style: {
                        color: valeur.couleur2
                    }
                }
            }, { // Gentle breeze
                from: valeur.limd3,
                to: valeur.limf3,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: valeur.valeur3,
                    style: {
                        color: valeur.couleur3
                    }
                }
            }, { // Moderate breeze
                from: valeur.limd4,
                to: valeur.limf4,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: valeur.valeur4,
                    style: {
                        color: valeur.couleur4
                    }
                }
            }, { // Fresh breeze
                from: valeur.limd5,
                to: valeur.limf5,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: valeur.valeur5,
                    style: {
                        color: valeur.couleur5
                    }
                }
            
            }]
        },
        tooltip: {
            valueSuffix: valeur.unite
        },
        plotOptions: {
            spline: {
                lineWidth: 2,
                states: {
                    hover: {
                        lineWidth: 3
                    }
                },
                marker: {
                    enabled: false
                }, //3600000
                pointInterval: 300000, 
                pointStart: Date.UTC(2015, 3, 07, 9, 47, 0)
            }
        },
        series: [{
        name:'humidite',
            data: valeur.data

        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
};