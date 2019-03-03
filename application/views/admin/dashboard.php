<style>
   .container {
      position: relative;
      background: #fff;
      box-shadow: 0 10px 20px rgba(0,0,0,.25);
      box-sizing: border-box;
   }

   .dashboard {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-content: space-between
   }

   .row {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      width: 100%;
      height: 50%;
   }

   .reports {
      width: 100%;
      height: 90%;
   }

   .column-chart {
      width: 64%;
      height: 90%;
   }

   .chartdiv-column {
      height: calc(100% - 59.64px);
   }

   .pie-chart {
      width: 33%;
      height: 90%;
   }
</style>

<div class="dashboard">
   <div class="row">
      <div class="container reports">
      </div>
   </div>

   <div class="row">
      <div class="container column-chart">
         <h3 style="padding: 1em 20px; margin:0">Monthly Sales</h3>
         <div class="chartdiv-column"></div>
      </div>
      <div class="container pie-chart">
        <h3 style="padding: 1em 20px; margin:0">Fares</h3>
        <div class="chartdiv-pie"></div>
      </div>
   </div>
</div>
<!-- <div class="chartdiv">
</div> -->

<script src="<?=base_url()?>assets/js/core.js"></script>
<script src="<?=base_url()?>assets/js/charts.js"></script>
<script src="<?=base_url()?>assets/js/animated.js"></script>
<script>
am4core.useTheme(am4themes_animated);
let column_chart = <?= $column_chart ?>;
let pie_chart = <?= $pie_chart ?>;

var chart = am4core.createFromConfig({
  // Reduce saturation of colors to make them appear as toned down
  "colors": {
    "saturation": 0.4
  },
  "fontSize": 9,
  // Setting data
  "data": column_chart,

  // Add Y axis
  "yAxes": [{
    "type": "ValueAxis",
    "renderer": {
      "maxLabelPosition": 0.98
    }
  }],

  // Add X axis
  "xAxes": [{
    "type": "CategoryAxis",
    "renderer": {
      "minGridDistance": 20,
      "grid": {
        "location": 0
      }
    },
    "dataFields": {
      "category": "month"
    }
  }],

  // Add series
  "series": [{
    // Set type
    "type": "ColumnSeries",

    "tooltipText": "{categoryX}: [bold]{valueY}[/]",
    
    // Define data fields
    "dataFields": {
      "categoryX": "month",
      "valueY": "total"
    },

    // Modify default state
    "defaultState": {
      "ransitionDuration": 1000
    },

    // Set animation options
    "sequencedInterpolation": true,
    "sequencedInterpolationDelay": 100,

    // Modify color appearance
    "columns": {
      // Disable outline
      "strokeOpacity": 0,

      // Add adapter to apply different colors for each column
      "adapter": {
        "fill": function (fill, target) {
          return chart.colors.getIndex(target.dataItem.index);
        }
      }
    }
  }],

  // Enable chart cursor
  "cursor": {
    "type": "XYCursor",
    "behavior": "zoomX"
  }
}, "chartdiv-column", "XYChart");


am4core.useTheme(am4themes_animated);

// Create chart
var chart = am4core.createFromConfig({
  "fontSize": 9,
  // Set data
  data: pie_chart,

  // Create series
  "series": [{
    "type": "PieSeries",
    "tooltipText": "",
    "dataFields": {
      "value": "total",
      "category": "fair_type"
    },
    "hiddenState": {
      "properties": {
        // this creates initial animation
        "opacity": 1,
        "endAngle": -90,
        "startAngle": -90
      }
    }
  }],

  // Add legend
}, "chartdiv-pie", "PieChart");

</script>