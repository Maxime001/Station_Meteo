


$(function () {
    $('#container').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Humidité'
        },
        credits: {
               enabled: false
            },
        exporting:{
        	enabled:false
        },
        subtitle: {
            text: 'Humidité ambiante pour la journée'
        },
        xAxis: {
            type: 'datetime',
            labels: {
                overflow: 'justify'
            }
        },
        yAxis: {
       			min:0,
       			max:100,
            title: {
                text: '%HR'
            },
            minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
            plotBands: [{ // Light air
                from: 0,
                to: 50,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Air sec',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Light breeze
                from: 50,
                to: 70,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Air humide',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Gentle breeze
                from: 70,
                to: 80,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Air très humide',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Moderate breeze
                from: 80,
                to: 90,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: 'Air saturé en eau',
                    style: {
                        color: '#606060'
                    }
                }
            }, { // Fresh breeze
                from: 90,
                to: 100,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: 'Pluie très probable',
                    style: {
                        color: '#606060'
                    }
                }
            
            }]
        },
        tooltip: {
            valueSuffix: '%HR'
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
                },
                pointInterval: 3600000, // one day
                pointStart: Date.UTC(2015, 3, 06, 0, 0, 0)
            }
        },
        series: [{
        name:'humidite',
            data: [1,2,3,4,5,6,7,8,9,10,11,22,13,15,14,56,57,58,51,45,45,85,95,75]

        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });
});