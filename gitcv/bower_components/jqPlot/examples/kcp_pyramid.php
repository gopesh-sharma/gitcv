<?php 
    $title = "Pyramid Charts";
    // $plotTargets = array (array('id'=>'chart1', 'width'=>600, 'height'=>400));
?>
<?php include "opener.php"; ?>

<!-- Example scripts go here -->


  <link class="include" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/themes/smoothness/jquery-ui.css" rel="Stylesheet" /> 


    <style type="text/css">
        .chart-container {
            border: 1px solid darkblue;
            padding: 30px;
            width: 600px;
            height: 700px;
        }

        #chart1 {
            width: 96%;
            height: 96%;
        }

        .jqplot-datestamp {
          font-size: 0.8em;
          color: #777;
    /*      margin-top: 1em;
          text-align: right;*/
          font-style: italic;
          position: absolute;
          bottom: 15px;
          right: 15px;
        }

        td.controls li {
            list-style-type: none;
        }

        td.controls ul {
            margin-top: 0.5em;
            padding-left: 0.2em;
        }

        pre.code {
            margin-top: 45px;
            clear: both;
        }

        div.tooltip {
            border: 1px solid #aaa;
            margin-right: 10px;
        }

    </style>

    <table class="app">
        <td class="controls">

            <div style="margin-bottom: 15px;">
                Axes:
                <select name="axisPosition">
                    <option value="both">Left &amp; Right</option>
                    <option value = "left">Left</option>
                    <option value = "right">Right</option>
                    <option value = "mid">Mid</option>
                </select>
            </div>

            <div>
                Background Color:
                <ul>
                    <li><input name="backgroundColor" value="white" type="radio" checked />Default</li>
                    <li><input name="backgroundColor" value="#efefef" type="radio" />Gray</li>
                </ul>
            </div>

            <div>
                Pyramid Color:
                <ul>
                    <li><input name="seriesColor" value="green" type="radio" checked />Green</li>
                    <li><input name="seriesColor" value="blue" type="radio" />Blue</li>
                </ul>
            </div>

            <div>
                Grids:
                <ul>
                    <li><input name="gridsVertical" value="vertical" type="checkbox" checked />Vertical</li>
                    <li><input name="gridsHorizontal" value="horizontal" type="checkbox" checked />Horizontal</li>
                    <li><input name="showMinorTicks" value="true" type="checkbox" />Only major</li>
                    <li><input name="plotBands" value="true" type="checkbox" />Plot Bands</li>
                </ul>
            </div>

            <div>
                <ul>
                    <li><input name="barPadding" value="2" type="checkbox" checked />Gap between bars</li>
                    <!-- value for showContour is speed at which to fade lines in/out -->
                    <li><input name="showContour" value="500" type="checkbox" checked />Comparison Line</li>
                </ul>
            </div>

            <div class="tooltip">
                <table>
                    <tr>
                        <td>Age: </td><td><div class="tooltip-item" id="tooltipAge">&nbsp;</div></td>
                    </tr>
                    <tr>
                        <td>Male: </td><td><div class="tooltip-item"  id="tooltipMale">&nbsp;</div></td>
                    </tr>
                    <tr>
                        <td>Female: </td><td><div class="tooltip-item"  id="tooltipFemale">&nbsp;</div></td>
                    </tr>
                    <tr>
                        <td>Ratio: </td><td><div class="tooltip-item"  id="tooltipRatio">&nbsp;</div></td>
                    </tr>
                </table>
            </div>
        </td>

        <td class="chart">
            <div class="chart-container"> 
                <div id="chart1"></div>
                <div class="jqplot-datestamp"></div>
            </div>
        </td>

    </table>

    <pre class="code brush:js"></pre>
  


    <script class="code" type="text/javascript" language="javascript">
    $(document).ready(function(){

        // the "x" values from the data will go into the ticks array.  
        // ticks should be strings for this case where we have values like "75+"
        var ticks = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59", "60", "61", "62", "63", "64", "65", "66", "67", "68", "69", "70", "71", "72", "73", "74", "75+", ""];

        // The "y" values of the data are put into seperate series arrays.
        var male = [0.635441, 1.066868, 0.889602, 0.816883, 1.016458, 0.916705, 0.79569, 0.970443, 1.046451, 1.335686, 0.926962, 0.936646, 0.919405, 0.722027, 0.896342, 0.993397, 0.613794, 0.916921, 0.828748, 0.43487, 0.391652, 0.517303, 0.507104, 0.336168, 0.554176, 0.691826, 0.66553, 0.686232, 0.7097, 0.356915, 0.756028, 0.430155, 0.420597, 0.608589, 0.609348, 0.83607, 0.79871, 0.63388, 0.866719, 0.711042, 1.160429, 0.439268, 0.659694, 0.468406, 0.340002, 0.996662, 0.371047, 0.638918, 0.462334, 0.467053, 0.545638, 0.463275, 0.480992, 0.515747, 0.499415, 0.287639, 0.520332, 0.443779, 0.334986, 0.43161, 0.474405, 0.179186, 0.620127, 0.219074, 0.411669, 0.495684, 0.315231, 0.275056, 0.157341, 0.113926, 0.24991, 0.128113, 0.175297, 0.103093, 0.253292, 0.988836];
        var female = [0.767078, 0.679554, 1.064493, 0.915063, 0.860792, 0.785728, 0.892471, 0.687886, 1.055313, 0.921839, 0.659624, 1.14516, 0.910735, 1.279864, 0.714669, 0.873929, 0.928453, 0.595752, 1.093534, 0.501142, 0.52829, 0.411606, 0.633309, 0.616121, 0.621781, 0.621598, 0.638378, 0.703724, 0.742589, 0.48523, 0.735727, 0.898816, 0.740614, 0.991105, 1.48909, 1.226996, 1.020624, 0.737742, 0.946817, 0.69129, 0.933744, 0.957472, 0.793112, 0.581121, 0.767528, 1.031739, 1.202133, 0.626926, 0.959522, 0.594303, 1.202145, 0.611707, 0.480779, 0.383338, 0.532876, 0.849878, 0.52453, 0.660183, 0.25419, 0.137567, 0.762322, 0.490294, 0.463194, 0.566921, 0.353006, 0.730591, 0.34669, 0.271638, 0.309785, 0.152756, 0.478111, 0.177234, 0.269302, 0.396318, 0.194934, 1.683044];
        var male2 = [0.230476, 0.175917, 0.225027, 0.40564, 0.408617, 0.495873, 0.441314, 0.282774, 0.47483, 0.393433, 0.580612, 0.220204, 0.514281, 0.32985, 0.514933, 0.507871, 0.398236, 0.362535, 0.603625, 0.528885, 0.550904, 0.87645, 0.857331, 0.713371, 0.703566, 0.703473, 0.858118, 0.751679, 0.832039, 0.752134, 1.202689, 1.069239, 1.051431, 0.732728, 0.992696, 0.828825, 0.723044, 0.857868, 1.088298, 0.86951, 0.914989, 0.549574, 0.672405, 0.637425, 0.530195, 0.706179, 0.941525, 0.576152, 0.913033, 0.647477, 0.734785, 0.441276, 0.583452, 0.537074, 0.7625, 0.662768, 0.307013, 0.384606, 0.470416, 0.22771, 0.470173, 0.152773, 0.338433, 0.348797, 0.10273, 0.285215, 0.139796, 0.186955, 0.143478, 0.178882, 0.141022, 0.1435, 0.146959, 0.056583, 0.05317, 0.784258];
        var female2 = [0.203297, 0.298698, 0.452947, 0.783013, 0.50033, 0.53629, 0.451817, 0.69927, 0.741356, 0.545433, 0.559643, 0.334842, 0.443899, 0.437309, 0.584658, 0.451757, 0.509258, 0.73483, 0.640501, 0.698825, 0.803701, 1.018148, 1.504918, 0.701318, 0.781324, 1.792142, 0.968484, 1.3288, 1.059729, 1.079985, 2.245553, 1.080526, 1.122927, 1.512428, 1.296163, 1.047212, 0.988065, 1.239462, 1.521174, 1.05187, 1.253013, 0.983437, 1.181799, 1.090029, 0.718064, 1.578813, 1.121987, 1.010202, 1.438581, 1.051654, 1.656156, 0.732428, 0.719311, 0.742441, 0.623806, 0.643911, 0.579092, 0.472909, 0.683453, 0.39008, 0.437458, 0.464595, 0.385552, 0.520029, 0.240536, 0.457316, 0.339587, 0.203276, 0.282141, 0.19517, 0.283663, 0.12404, 0.147211, 0.141153, 0.177653, 1.193951];

        // Custom color arrays are set up for each series to get the look that is desired.
        // Two color arrays are created for the default and optional color which the user can pick.
        var greenColors = ["#526D2C", "#77933C", "#C57225", "#C57225"];
        var blueColors = ["#3F7492", "#4F9AB8", "#C57225", "#C57225"];

        // To accommodate changing y axis, need to keep track of plot options, so they are defined separately
        // changing axes will require recreating the plot, so need to keep 
        // track of state changes.
        var plotOptions = {
            // We set up a customized title which acts as labels for the left and right sides of the pyramid.
            title: '<div style="float:left;width:50%;text-align:center">Male</div><div style="float:right;width:50%;text-align:center">Female</div>',

            // by default, the series will use the green color scheme.
            seriesColors: greenColors,

            grid: {
                drawBorder: false,
                shadow: false,
                background: 'white',
                rendererOptions: {
                    // plotBands is an option of the pyramidGridRenderer.
                    // it will put banding at starting at a specified value
                    // along the y axis with an adjustable interval.
                    plotBands: {
                        show: false
                    }
                }
            },

            // This makes the effective starting value of the axes 0 instead of 1.
            // For display, the y axis will use the ticks we supplied.
            defaultAxisStart: 0,
            seriesDefaults: {
                renderer: $.jqplot.PyramidRenderer,
                rendererOptions: {
                    barPadding: 2,
                    offsetBars: true
                },
                yaxis: 'yaxis',
                shadow: false
            },

            // We have 4 series, the left and right pyramid bars and
            // the left and rigt overlay lines.
            series: [
                // For pyramid plots, the default side is right.
                // We want to override here to put first set of bars
                // on left.
                {
                    rendererOptions:{
                        side: 'left',
                        synchronizeHighlight: 1
                    }
                },
                {
                    yaxis: 'y2axis',
                    rendererOptions:{
                        synchronizeHighlight: 0
                    }
                },
                // Pyramid series are filled bars by default.
                // The overlay series will be unfilled lines.
                {
                    rendererOptions: {
                        fill: false,
                        side: 'left'
                    }
                },
                {
                    yaxis: 'y2axis',
                    rendererOptions: {
                        fill: false
                    }
                }
            ],

            // Set up all the y axes, since users are allowed to switch between them.
            // The only axis that will show is the one that the series are "attached" to.
            // We need the appropriate options for the others for when the user switches.
            axes: {
                xaxis: {
                    tickOptions: {},
                    rendererOptions: {
                        baselineWidth: 2
                    }
                },
                yaxis: {
                    label: 'Age',
                    // Use canvas label renderer to get rotated labels.
                    labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                    // include empty tick options, they will be used
                    // as users set options with plot controls.
                    tickOptions: {},
                    tickInterval: 5,
                    showMinorTicks: true,
                    ticks: ticks,
                    rendererOptions: {
                        category: false,
                        baselineWidth: 2
                    }
                },
                yMidAxis: {
                    label: 'Age',
                    // include empty tick options, they will be used
                    // as users set options with plot controls.
                    tickOptions: {},
                    tickInterval: 5,
                    showMinorTicks: true,
                    ticks: ticks,
                    rendererOptions: {
                        category: false,
                        baselineWidth: 2
                    }
                },
                y2axis: {
                    label: 'Age',
                    // Use canvas label renderer to get rotated labels.
                    labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                    // include empty tick options, they will be used
                    // as users set options with plot controls.
                    tickOptions: {},
                    tickInterval: 5,
                    showMinorTicks: true,
                    ticks: ticks,
                    rendererOptions: {
                        category: false,
                        baselineWidth: 2
                    }
                }
            }
        };

        // initialize form elements
        // set these before attaching event handlers.

        $('input[type=checkbox][name=gridsVertical]').attr('checked', true);
        $('input[type=checkbox][name=gridsHorizontal]').attr('checked', true);
        $('input[type=checkbox][name=showMinorTicks]').attr('checked', false);
        $('input[type=checkbox][name=plotBands]').attr('checked', false);
        $('input[type=checkbox][name=showContour]').attr('checked', true);
        $('input[type=checkbox][name=barPadding]').attr('checked', true);
        $('select[name=axisPosition]').val('both');
        $('input[type=radio][name=backgroundColor]').attr('checked', false);
        $('input[type=radio][name=backgroundColor][value=white]').attr('checked', true);
        $('input[type=radio][name=backgroundColor]').attr('checked', false);
        $('input[type=radio][name=backgroundColor][value=white]').attr('checked', true);
        $('input[type=radio][name=seriesColor]').attr('checked', false);
        $('input[type=radio][name=seriesColor][value=green]').attr('checked', true);

        plot1 = $.jqplot('chart1', [male, female, male2, female2], plotOptions);


        // After plot creation, check to see if contours should be displayed
        checkContour();

        //////
        // The followng functions use verbose css selectors to make
        // it clear exactly which elements they are binging to/operating on
        //////
        
        //////
        // Function which checkes if the countour lines checkbox is checked.
        // If not, hide the contour lines by hiding the canvases they are
        // drawn on.
        //////
        function checkContour() {
            if (!$('input[type=checkbox][name=showContour]').get(0).checked) {
                plot1.series[2].canvas._elem.addClass('jqplot-series-hidden');
                plot1.series[2].canvas._elem.hide();
                plot1.series[3].canvas._elem.addClass('jqplot-series-hidden');
                plot1.series[3].canvas._elem.hide();
            }
        }    

        $('select[name=axisPosition]').change(function(){ 
            // this refers to the html element we are binding to.
            // $(this) is jQuery object on that element.

            switch ($(this).val()) {
                case 'both':
                    plotOptions.series[0].yaxis = 'yaxis';
                    plotOptions.series[1].yaxis = 'y2axis';
                    plotOptions.series[2].yaxis = 'yaxis';
                    plotOptions.series[3].yaxis = 'y2axis';
                    break;
                case 'left':
                    plotOptions.series[0].yaxis = 'yaxis';
                    plotOptions.series[1].yaxis = 'yaxis';
                    plotOptions.series[2].yaxis = 'yaxis';
                    plotOptions.series[3].yaxis = 'yaxis';
                    break;
                case 'right':
                    plotOptions.series[0].yaxis = 'y2axis';
                    plotOptions.series[1].yaxis = 'y2axis';
                    plotOptions.series[2].yaxis = 'y2axis';
                    plotOptions.series[3].yaxis = 'y2axis';
                    break;
                case 'mid':
                    plotOptions.series[0].yaxis = 'yMidAxis';
                    plotOptions.series[1].yaxis = 'yMidAxis';
                    plotOptions.series[2].yaxis = 'yMidAxis';
                    plotOptions.series[3].yaxis = 'yMidAxis';
                    break;
                default:
                    break;
                    
            }

            plot1.destroy();
            plot1 = $.jqplot('chart1', [male, female, male2, female2], plotOptions);
            // Finally, check to see if we need to hide contour lines.
            checkContour();
        });

        $('input[type=radio][name=backgroundColor]').change(function(){ 
            // this refers to the html element we are binding to.
            // $(this) is jQuery object on that element.
            plot1.grid.background = $(this).val();
            plotOptions.grid.background = $(this).val();
            plot1.replot();
            // Finally, check to see if we need to hide contour lines.
            checkContour();
        });

        $('input[type=radio][name=seriesColor]').change(function(){ 
            // this refers to the html element we are binding to.
            // $(this) is jQuery object on that element.
            if ($(this).val() === 'blue') {
                // reset highlight colors so they will be recalculated.
                plot1.series[0].highlightColors = [];
                plot1.series[1].highlightColors = [];
                // reset series color to properly calculate highlight color.
                plot1.series[0].color = blueColors[0];
                plot1.series[1].color = blueColors[1];
                // to actually draw a new color, have to set the color on the shaperenderer.
                plot1.series[0].renderer.shapeRenderer.fillStyle = blueColors[0];
                plot1.series[1].renderer.shapeRenderer.fillStyle = blueColors[1];
                // update plot options state.
                plotOptions.seriesColors = blueColors;
            }
            else if ($(this).val() === 'green') {
                // reset highlight colors so they will be recalculated.
                plot1.series[0].highlightColors = [];
                plot1.series[1].highlightColors = [];
                // reset series color to properly calculate highlight color.
                plot1.series[0].color = greenColors[0];
                plot1.series[1].color = greenColors[1];
                // to actually draw a new color, have to set the color on the shaperenderer.
                plot1.series[0].renderer.shapeRenderer.fillStyle = greenColors[0];
                plot1.series[1].renderer.shapeRenderer.fillStyle = greenColors[1];
                // update plot options state.
                plotOptions.seriesColors = blueColors;
            }
            plot1.replot();
            // Finally, check to see if we need to hide contour lines.
            checkContour();
        });

        $('input[type=checkbox][name=gridsVertical]').change(function(){
            // this refers to the html element we are binding to.
            // $(this) is jQuery object on that element.
            plot1.axes.xaxis.tickOptions.showGridline = this.checked;
            plotOptions.axes.xaxis.tickOptions.showGridline = this.checked;
            plot1.replot();
            // Finally, check to see if we need to hide contour lines.
            checkContour();
        });

        $('input[type=checkbox][name=gridsHorizontal]').change(function(){
            // this refers to the html element we are binding to.
            // $(this) is jQuery object on that element.
            plot1.axes.yaxis.tickOptions.showGridline = this.checked;
            plot1.axes.y2axis.tickOptions.showGridline = this.checked;
            plot1.axes.yMidAxis.tickOptions.showGridline = this.checked;
            plotOptions.axes.yaxis.tickOptions.showGridline = this.checked;
            plotOptions.axes.y2axis.tickOptions.showGridline = this.checked;
            plotOptions.axes.yMidAxis.tickOptions.showGridline = this.checked;
            plot1.replot();
            // Finally, check to see if we need to hide contour lines.
            checkContour();
        });

        $('input[type=checkbox][name=showMinorTicks]').change(function(){
            // this refers to the html element we are binding to.
            // $(this) is jQuery object on that element.
            plot1.axes.yaxis.showMinorTicks = !this.checked;
            plot1.axes.y2axis.showMinorTicks = !this.checked;
            plot1.axes.yMidAxis.showMinorTicks = !this.checked;
            plotOptions.axes.yaxis.showMinorTicks = !this.checked;
            plotOptions.axes.y2axis.showMinorTicks = !this.checked;
            plotOptions.axes.yMidAxis.showMinorTicks = !this.checked;
            plot1.replot();
            // Finally, check to see if we need to hide contour lines.
            checkContour();
        });

        $('input[type=checkbox][name=plotBands]').change(function(){
            // this refers to the html element we are binding to.
            // $(this) is jQuery object on that element.
            plot1.grid.plotBands.show = this.checked;
            plotOptions.grid.rendererOptions.plotBands.show = this.checked;
            plot1.replot();
            // Finally, check to see if we need to hide contour lines.
            checkContour();
        });

        $('input[type=checkbox][name=showContour]').change(function(){
            // this refers to the html element we are binding to.
            // $(this) is jQuery object on that element.
            var speed = $(this).val();
            if (this.checked) {
                plot1.series[2].canvas._elem.removeClass('jqplot-series-hidden');
                plot1.series[2].canvas._elem.fadeIn(speed);
                plot1.series[3].canvas._elem.removeClass('jqplot-series-hidden');
                plot1.series[3].canvas._elem.fadeIn(speed);
            }
            else {
                plot1.series[2].canvas._elem.addClass('jqplot-series-hidden');
                plot1.series[2].canvas._elem.fadeOut(speed);
                plot1.series[3].canvas._elem.addClass('jqplot-series-hidden');
                plot1.series[3].canvas._elem.fadeOut(speed);
            }
        });

        $('input[type=checkbox][name=barPadding]').change(function(){
            // this refers to the html element we are binding to.
            // $(this) is jQuery object on that element.
            if (this.checked) {
                var val = parseFloat($(this).val());
                plot1.series[0].barPadding = val;
                plot1.series[1].barPadding = val;
                plotOptions.seriesDefaults.rendererOptions.barPadding = val;
            }
            else {
                plot1.series[0].barPadding = 0;
                plot1.series[1].barPadding = 0;
                plotOptions.seriesDefaults.rendererOptions.barPadding = 0;
            }
            plot1.replot();
            // Finally, check to see if we need to hide contour lines.
            checkContour();
        });

        // bind to the data highlighting event to make custom tooltip:
        $('.jqplot-target').bind('jqplotDataHighlight', function(evt, seriesIndex, pointIndex, data) {
            // Here, assume first series is male poulation and second series is female population.
            // Adjust series indices as appropriate.
            var malePopulation = Math.abs(plot1.series[0].data[pointIndex][1]);
            var femalePopulation = Math.abs(plot1.series[1].data[pointIndex][1]);
            var ratio = femalePopulation / malePopulation * 100;

            $('#tooltipMale').stop(true, true).fadeIn(250).html(malePopulation.toPrecision(4));
            $('#tooltipFemale').stop(true, true).fadeIn(250).html(femalePopulation.toPrecision(4));
            $('#tooltipRatio').stop(true, true).fadeIn(250).html(ratio.toPrecision(4));

            // Since we don't know which axis is rendererd and acive with out a little extra work,
            // just use the supplied ticks array to get the age label.
            $('#tooltipAge').stop(true, true).fadeIn(250).html(ticks[pointIndex]);
        });

        // bind to the data highlighting event to make custom tooltip:
        $('.jqplot-target').bind('jqplotDataUnhighlight', function(evt, seriesIndex, pointIndex, data) {
            // clear out all the tooltips.
            $('.tooltip-item').stop(true, true).fadeOut(200).html('');
        });

        // add a date at the bottom.

        var d = new $.jsDate();
        $('div.jqplot-datestamp').html('Generated on '+d.strftime('%v'));
    
        $("div.chart-container").resizable({delay:20});    

        $("div.chart-container").bind("resize", function(event, ui) {
            plot1.replot();
        });

    });
    </script>


<!-- End example scripts -->

<!-- Don't touch this! -->

<?php include "commonScripts.html" ?>

<!-- End Don't touch this! -->

<!-- Additional plugins go here -->

    <script class="include" type="text/javascript" src="../src/plugins/jqplot.categoryAxisRenderer.js"></script>

    <!-- load the pyramidAxis and Grid renderers in production.  pyramidRenderer will try to load via ajax if not present, but that is not optimal and depends on paths being set. -->
    <script class="include" type="text/javascript" src="../src/plugins/jqplot.pyramidAxisRenderer.js"></script>
    <script class="include" type="text/javascript" src="../src/plugins/jqplot.pyramidGridRenderer.js"></script> 

    <script class="include" type="text/javascript" src="../src/plugins/jqplot.pyramidRenderer.js"></script>
    <script class="include" type="text/javascript" src="../src/plugins/jqplot.canvasTextRenderer.js"></script>
    <script class="include" type="text/javascript" src="../src/plugins/jqplot.canvasAxisLabelRenderer.js"></script>
    <script class="include" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>

<!-- End additional plugins -->

<?php include "closer.php"; ?>