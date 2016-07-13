$(document).ready(function(){
    $.getJSON('json/meteo.json', function (data) {
        
        
        $('.loading_historiqueMeteo').fadeOut();
        AfficheGraphe("#Humidite2",data.humidite," Humidité (%HR)");
        AfficheGraphe("#Pression2",data.pression," Pression (HPa)");
        AfficheGraphe("#luminosite2",data.luminosite,"Luminosite (Lux)");
        AfficheGraphe("#detectionEau2",data.detectionEau,"Détection Eau (SU)");
        AfficheGraphe("#mesureBruit2",data.mesureBruit,"Mesure de Bruit (SU)");
        AfficheGraphe("#temperatureExterieure2",data.temperatureExterieure,"Température exterieure (°C)");
        AfficheGraphe("#temperatureInterieure2",data.temperatureInterieure,"Température Intérieure (°C)");
        
        
        // Création du graphique
        function AfficheGraphe(Div,dataType,Name){
                Highcharts.setOptions({
        global: {
            timezoneOffset: -2 * 60
        }
    });
                $(Div).highcharts('StockChart', {
                    
                    title:{
                        text:''
                    },
                    credits: {
                        enabled: false
                     },
                    exporting: {
                        enabled: false 
                    },
                    rangeSelector : {
                        selected : 1
                    },
                    series : [{
                            name : Name,
                            data : dataType,
                            tooltip: {
                                    valueDecimals: 1
                            }
                    }]
                });
            }
        });
});