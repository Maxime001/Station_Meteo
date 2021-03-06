/*
 * Style des graphiques
 */
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
            fontFamily: ""
        }
    },
    title: {
        style: {
            fontSize: '14px',
            fontWeight: 'bold',
            textTransform: '',
            opacity:0.8
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
