function updageGrapheSolidJauge(data){
    var chart = $('#deltaTemperature').highcharts();
    if (chart) {
        tInt = data.meteoInstantanee.temperatureInterieure;
        tExt = data.meteoInstantanee.temperatureExterieure;
        newVal = tInt-tExt;

        newVal = newVal.toFixed(2);
        newVal = eval(newVal);
        var point = chart.series[0].points[0],newVal;    
        point.update(newVal);
    }
}; 


function solidJauge(){
    var gaugeOptions = {
	   credits: {
               enabled: false
            },

            exporting: {
                enabled: false 
            },
	    chart: {
	        type: 'solidgauge'
	    },
	    
	    title: {
                fontWeight:'bold',
                fontSize: '14px',
            textTransform: '',
            text:"Delta T°C Intérieur/Exterieur"
            },
	    
	    pane: {
	    	center: ['50%', '85%'],
	    	size: '140%',
	        startAngle: -90,
	        endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
	    },

	    tooltip: {
	    	enabled: false
	    },
	       
	    // the value axis
	    yAxis: {
            min: -15,
			stops: [
                            [0, '#DF5353'],
                           [5, '#DDDF0D'],
				[14, '#55BF3B'] // green
 // red
			],
			lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
	        title: {
                y: -70
	        },
            labels: {
                y: 16
            }        
	    },
        
        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: -30,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };
    
    // The speed gauge
    $('#deltaTemperature').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
	        min: -15,
	        max: 15,
	     
            tickPositions: [-15, 15]
	    },

	    credits: {
	    	enabled: false
	    },
	
	    series: [{
	        name: 'Delta T°C',
	        data: [0],
	        dataLabels: {
	        	format: '<div style="text-align:center"><span style="font-size:25px;color:' + 
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' + 
                   	'<span style="font-size:12px;color:silver">°C</span></div>'
	        },
	        tooltip: {
	            valueSuffix: ' °C'
	        }
	    }]
	
	})); 
}
	




