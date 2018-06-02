// get line chart options
var chartOption = createLineChartOption();

// show the default line chart if default server stats data defined.
if (typeof defaultServerStatslineChartData !== 'undefined' && defaultServerStatslineChartData !== null) {
    $.jqplot('line-chart', [defaultServerStatslineChartData], chartOption);
}

// ------------------------------------------
// get server stats and show in line chart
// ------------------------------------------
$("#server").change(function () {

    var serverName = $(this).val();

    $.ajax({
        url: "ajax.php",
        data: {
            server_name: serverName
        },
        method: "GET",
        dataType: "json"
    }).done(function (chartData) {

        if (typeof chartData == 'undefined' || null == chartData) {
            return false;
        }

        $("#line-chart").empty();

        // line chart render
        $.jqplot('line-chart', [chartData], chartOption);


    });
});


/**
 * get line chart display option
 * @returns json object
 */
function createLineChartOption() {

    return {
        highlighter: {
            show: true,
            sizeAdjust: 1,
            tooltipOffset: 9
        },
        grid: {
            background: 'rgba(57,57,57,0.0)',
            drawBorder: false,
            shadow: false,
            gridLineColor: '#666666',
            gridLineWidth: 1
        },

        seriesDefaults: {
            rendererOptions: {
                smooth: true,
                animation: {
                    show: true
                }
            },
            showMarker: false
        },

        axesDefaults: {
            rendererOptions: {
                baselineWidth: 1.5,
                baselineColor: '#444444',
                drawBaseline: true
            }
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    formatString: "%H:%M",
                    angle: -30,
                    textColor: '#dddddd'
                },


                drawMajorGridlines: false
            },
            yaxis: {
                renderer: $.jqplot.LogAxisRenderer,
                pad: 1.2,
                rendererOptions: {
                    minorTicks: 1
                },
                tickOptions: {
                    showMark: true
                }
            }


        }
    }
}
