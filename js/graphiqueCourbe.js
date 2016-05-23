/////////// GRAPHIQUE COURBE ///////////

/*
 * Options pour les graphiques 
 * @param Obj
 */
function loadOptions(data,arrayDate){
       // Humidite 
    GrapheCourbePression = {
        data : data.donnees.pression,
        div : "#graphePression",
        titre: "pression",
        soustitre:"Pression ambiante pour la journée",
        mini:data.minMax.pressionMin,
        maxi:data.minMax.pressionMax,
        unite:"HPa",
        limd1:0,
        limf1:960,
        valeur1:"Capteur à recalibrer",
        couleur1:"#606060",
        limd2:960,
        limf2:1015,
        valeur2:"Dépression - Pluie",
        couleur2:"#ff0000",
        limd3:1015,
        limf3:1040,
        valeur3:"Anticyclone",
        couleur3:"#33cc33",
        limd4:1040,
        limf4:2000,
        valeur4:"Capteur a recalibrer",
        couleur4:"#606060",
        an:arrayDate[0],
        mois:arrayDate[1],
        jour:arrayDate[2],
        heure:arrayDate[3],
        minute:arrayDate[4],
        seconde:arrayDate[5]
    };
        // Humidite 
    GrapheCourbeHumidite = {
        data : data.donnees.humidite,
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
        limf4:100,
        valeur4:"Air saturé en eau",
        couleur4:"#606060",
        an:arrayDate[0],
        mois:arrayDate[1],
        jour:arrayDate[2],
        heure:arrayDate[3],
        minute:arrayDate[4],
        seconde:arrayDate[5]
    };
    // Options pour graphique de température exterieure
    GrapheCourbeTemperatureExt = {
        data : data.donnees.temperatureExterieure,
        data2 : data.donnees.temperatureInterieure,
        div : "#grapheTemperatureExterieure",
        titre: "Température Exterieure",
        soustitre:"Températures de la journée",
        mini:data.minMax.temperatureExterieureMin,
        maxi:data.minMax.temperatureInterieureMax,
        unite:"°C",
        limd1:-20,
        limf1:0,
        valeur1:"",
        couleur1:"#606060",
        limd2:0,
        limf2:10,
        valeur2:"",
        couleur2:"#606060",
        limd3:10,
        limf3:20,
        valeur3:"",
        couleur3:"#606060",
        limd4:20,
        limf4:30,
        valeur4:"",
        couleur4:"#606060",
        limd5:30,
        limf5:40,
        valeur5:"",
        couleur5:"#606060",
        an:arrayDate[0],
        mois:arrayDate[1],
        jour:arrayDate[2],
        heure:arrayDate[3],
        minute:arrayDate[4],
        seconde:arrayDate[5]
    };
    // Options pour le graphique de détection d'eau
    GrapheCourbeDetectionEau = {
        data : data.donnees.detectionEau,
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
        couleur5:"#606060",
        an:arrayDate[0],
        mois:arrayDate[1],
        jour:arrayDate[2],
        heure:arrayDate[3],
        minute:arrayDate[4],
        seconde:arrayDate[5]
    };
    // Options pour le graphique de luminosité
    GrapheCourbeLuminosite = {
        data : data.donnees.luminosite,
        div : "#grapheLuminosite",
        titre: "Luminosité du ciel",
        soustitre:"Graphique de la luminosité du jour",
        mini:data.minMax.luminositeMin,
        maxi:data.minMax.luminositeMax,
        unite:"SU",
        
        an:arrayDate[0],
        mois:arrayDate[1],
        jour:arrayDate[2],
        heure:arrayDate[3],
        minute:arrayDate[4],
        seconde:arrayDate[5]
    };
}

/*
 * Fonction qui détermine l'heure de la première valeure enregistrée dans le json, dans le but de la passer en paramètre du graphique
 * @param {obj} data objet data contenant un tableau avec toutes les dates d'acquisition
 * @returns {array} retourne un tableau contenant les valeur en an,mois,jour,heure,minute,seconde de la premiere acquisiton enregistrée en json
 */
function detectTime(data){
    var elt = data.split("-");
    var an = elt[0];
    var mois = elt[1]-1;
    var elt2 = elt[2];
    var elt2 = elt2.split(" ");
    var jour = elt2[0];;
    var elt3 = elt2[1].split(":");
    var heure = elt3[0];
    var minute = elt3[1];
    var secondes = elt3[2];

    return arrayDate =[an,mois,jour,heure,minute,secondes];
}




/*
 * Initialisation des graphiques
 * @param obj data
 */
function loadDataGraphe(data){
    
    var arrayDate = detectTime(data.donnees.Date[0]);
    loadOptions(data,arrayDate);


    initGrapheCourbe(GrapheCourbeHumidite);
    initGrapheDoubleCourbe(GrapheCourbeTemperatureExt);
    initGrapheCourbe(GrapheCourbeDetectionEau);
    initGrapheCourbe(GrapheCourbeLuminosite);
    initGrapheCourbe(GrapheCourbePression);
}

/*
 * Graphique des courbes - courbe unique 
 * @param Obj objet contenant les parametres du graphique
 */
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
                pointStart: Date.UTC(valeur.an, valeur.mois, valeur.jour, valeur.heure, valeur.minute, valeur.seconde)
            }
        },
        series: [{
        name:valeur.unite,
            data: valeur.data

        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
};


/*
 * Graphique des courbes - courbe unique 
 * @param Obj objet contenant les parametres du graphique
 */
function initGrapheDoubleCourbe(valeur){
    
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
            }, { 
                from: valeur.limd2,
                to: valeur.limf2,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: valeur.valeur2,
                    style: {
                        color: valeur.couleur2
                    }
                }
            }, { 
                from: valeur.limd3,
                to: valeur.limf3,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: valeur.valeur3,
                    style: {
                        color: valeur.couleur3
                    }
                }
            }, { 
                from: valeur.limd4,
                to: valeur.limf4,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: valeur.valeur4,
                    style: {
                        color: valeur.couleur4
                    }
                }
            }, { 
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
                pointStart: Date.UTC(valeur.an, valeur.mois, valeur.jour, valeur.heure, valeur.minute, valeur.seconde)
            }
        },
        series: [{
        name:'temperatureExterieure',
            data: valeur.data

        },
        {
        name:'temperatureInterieure',
            data: valeur.data2

        }
    ],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
};