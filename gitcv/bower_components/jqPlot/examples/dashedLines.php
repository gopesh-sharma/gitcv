<?php 
    $title = "Dashed Lines with Smoothing";
    // $plotTargets = array (array('id'=>'chart1', 'width'=>600, 'height'=>400));
?>
<?php include "opener.php"; ?>

<!-- Example scripts go here -->

  <style type="text/css">
    .jqplot-target {
        margin-bottom: 2em;
    }
    
    p {
        margin: 2em 0;
    }  
  </style>

         
    <div id="chart1" style="margin-top:20px; margin-left:20px; width:600px; height:300px;"></div>
        
    <div id="chart1b" style="margin-top:20px; margin-left:20px; width:600px; height:300px;"></div>

    <div id="chart2" style="margin-top:20px; margin-left:20px; width:600px; height:300px;"></div>

    <div id="chart3" style="margin-top:20px; margin-left:20px; width:600px; height:300px;"></div>

    <div id="chart4" style="margin-top:20px; margin-left:20px; width:600px; height:300px;"></div>

    <div id="chart4b" style="margin-top:20px; margin-left:20px; width:600px; height:300px;"></div>

    <div id="chart5" style="margin-top:20px; margin-left:20px; width:600px; height:300px;"></div>

  <script class="code" type="text/javascript">

    $(document).ready(function () {
      s1 = [[0, 2], [1, 6], [2, 7], [3, 10]];

      // Lines can be drawn as solid, dashed or dotted with the "linePattern" option.
      // The default is "solid".  Other basic options are "dashed" and "dotted".

      plot1 = $.jqplot("chart1", [s1], {
        seriesDefaults:{
            linePattern: 'dashed',
            showMarker: false,
            shadow: false
        }
      });
    });
</script>
  
  <script class="code" type="text/javascript">

    $(document).ready(function () {

      s1 = [[0, 2], [1, 6], [2, 7], [3, 10]];

      // Size of the dashes is proportional to the width of the line.

      plot1b = $.jqplot("chart1b", [s1], {
        seriesDefaults:{
            linePattern: 'dashed',
            lineWidth: 7,
            showMarker: false,
            shadow: false
        }
      });
    });
</script>

  
  <script class="code" type="text/javascript">
    $(document).ready(function () {
      s2 = [[0, 6.29], [0.1, 8.21], [0.2, 8.92], [0.3, 7.33], [0.4, 7.91], [0.5, 3.6], [0.6, 6.88], 
      [0.7, 1.5], [0.8, 0.08], [0.9, 6.36], [1, 0.5], [1.1, 9.14], [1.2, 6.23], [1.3, 2.66], 
      [1.4, 9.9], [1.5, 7.44], [1.6, 7.82], [1.7, 8.57], [1.8, 3.99], [1.9, 3.83], [2, 6.78], 
      [2.1, 7.63], [2.2, 6.94], [2.3, 1.24], [2.4, 2.25], [2.5, 0.67], [2.6, 6.73], [2.7, 2.25], 
      [2.8, 7.72], [2.9, 9.36], [3, 8.49]];

      // Here is the default dotted line.

      plot2 = $.jqplot("chart2", [s2], {
        seriesDefaults:{
            linePattern: 'dotted',
            showMarker: false,
            shadow: false
        }
      });
    });
</script>

  
  <script class="code" type="text/javascript">
    $(document).ready(function () {

      // Dashes and dots work with smoothed lines as well.

      plot3 = $.jqplot("chart3", [s2], {
        seriesDefaults:{
            linePattern: 'dashed',
            showMarker: false,
            shadow: false,
            rendererOptions: {
              smooth: true
            }
        }
      });
    });
</script>

  
  <script class="code" type="text/javascript">
    $(document).ready(function () {

      // A user defined linePattern can be specified as well.  The format
      // of a linePattern definition is an array like [dash length, gap length, ...].
      // The line looks best when the line pattern array has an even number
      // of elements, so it begins with a dash and ends with a gap.
      // The dash and gap lengths are scaled to the line thickness.

      plot4 = $.jqplot("chart4", [s2], {
        seriesDefaults:{
            linePattern: [4, 3, 1, 3, 1, 3],
            showMarker: false,
            shadow: false,
            rendererOptions: {
              smooth: true
            }
        }
      });
    });
</script>

  
<script class="code" type="text/javascript">
    $(document).ready(function () {

      // The linePattern option also accepts a shorthand string 
      // notation of dash (-) and dot (.) characters to create
      // a customized pattern.

      plot4b = $.jqplot("chart4b", [s2], {
        seriesDefaults:{
            linePattern: '-.',
            showMarker: false,
            shadow: false,
            rendererOptions: {
              smooth: true
            }
        }
      });
    });
</script>
  
  <script class="code" type="text/javascript">
    $(document).ready(function () {

      // The default dash length and gap length can be controlled 
      // with the dashLength and gapLength config parameters.

      $.jqplot.config.dashLength = 5;
      $.jqplot.config.gapLength = 2;

      plot5 = $.jqplot("chart5", [s2], {
        seriesDefaults:{
            linePattern: 'dashed',
            showMarker: false,
            shadow: false,
            rendererOptions: {
              smooth: true
            }
        }
      });
    });
</script>


<!-- End example scripts -->

<!-- Don't touch this! -->

<?php include "commonScripts.html" ?>

<!-- End Don't touch this! -->

<!-- Additional plugins go here -->

<!-- End additional plugins -->

<?php include "closer.php"; ?>