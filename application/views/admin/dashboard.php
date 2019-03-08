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

  .row:nth-child(1) {
    height: 50%;
    margin-bottom: 20px;
  }

  .reports {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .report-form {
    width: 20%;
    height: 100%;
    box-sizing: border-box;
    padding: 20px;
  }

  .report-table {
    width: 80%;
    height: 100%;
    box-sizing: border-box;
    padding: 20px;
    overflow-y: auto;
  }

  .column-chart {
    width: 64%;
    height: 98%;
  }

  .chartdiv-column {
    height: calc(100% - 59.64px);
  }

  .pie-chart {
    width: 33%;
    height: 98%;
  }

  .chartdiv-pie {
    height: calc(90% - 59.64px);
  }

  h3 {
    font-weight: bolder;
    font-size: 24px;
    margin: 0;
    font-family: "Source Sans Pro", sans-serif;
  }

  h3.padding {
    padding: 1em 20px; 
  }

  .select-panel {
    display: flex;
    flex-direction: column;
    width: 100%;
  }
  
  .select-panel select {
    background: #5BC0BE;
    color: #fff;
    padding: 3px 10px;
    border-radius: 5px;
    border: none;
  }

  .select-panel select{
    margin-bottom: 10px;
  }

  .select-panel select:focus {
    outline: none;
  }

  .select-panel button {
    border: none;
    background: #3A506B;
    color: #fff;
    cursor: pointer;
    padding: 3px 10px;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  table {
    border-collapse: collapse;
    width: 100%;
    font-size: 11px;
  }

  th {
    border: 1px solid #E5E5E5;
    padding: 5px 0;
  }

  tbody {
    text-align: center;
  }

  td {
    padding: 15px 0;
  }

  tbody tr:nth-child(odd) {
    background: rgba(219,223,228, 0.6);
  }

  tbody:before {
    content: "-";
    display: block;
    line-height: 1em;
    color: transparent;
  }
</style>

<div class="dashboard">
   <div class="row">
      <div class="container reports">
        <div class="report-form">
          <h3>Reports</h3>
          <p style="font-style: italic; font-size: 17px; font-family: 'Source Sans Pro', sans-serif; margin-top:5px;">View Ticket Sales Report</p>
            <div class="select-panel">
              <select name="vessel_gid" id="vessel">
                <option value="0" selected disabled>-- Select Vessel --</option>
                <?php foreach ($vessels as $vessel) {?>
                  <option value="<?= $vessel['vessel_gid']?>"><?= $vessel['vessel_name']?></option>
                <?php } ?>
              </select>
              <select name="voyage_num" id="voyage"></select>
              <select name="voyage_date" id="date"></select>
              <button value="create-report" id="create-report">Create Report</button>
              <button value="generate-pdf" id="generate-pdf">Generate PDF</button>
            </div>
        </div>
        <div class="report-table">
          <table>
            <thead>
              <tr>
                <th colspan=2>Port Destination</th>
                <th colspan=2>Series Ticket Stub No.</th>
                <th>Category</th>
                <th>No. of</th>
                <th>Ticket</th>
                <th>TOTAL</th>
              </tr>
              <tr>
                <th>Port From</th>
                <th>Port To</th>
                <th>From No.</th>
                <th>To No.</th>
                <th>Fare</th>
                <th>Passenger</th>
                <th>Price</th>
                <th>AMOUNT</th>
              </tr>
            </thead>
            <tbody id="report">
            </tbody>
          </table>
        </div>
      </div>
   </div>
   <div class="row">
      <div class="container column-chart">
         <h3 class="padding">Monthly Sales</h3>
         <div class="chartdiv-column"></div>
      </div>
      <div class="container pie-chart">
        <h3 class="padding">Monthly Fares</h3>
        <div class="chartdiv-pie"></div>
      </div>
   </div>
</div>
<script>
let base_url = '<?= base_url()?>'
</script>
<script src="<?=base_url()?>assets/js/core.js"></script>
<script src="<?=base_url()?>assets/js/charts.js"></script>
<script src="<?=base_url()?>assets/js/animated.js"></script>
<script src="<?=base_url()?>assets/js/ajax-report-form.js"></script>
<script>
function am4themes_myTheme(target) {
  if (target instanceof am4core.ColorSet) {
    target.list = [
      am4core.color("#5BC0BE"),
      am4core.color("#BDE6E5"),
      am4core.color("#3A506B"),
      am4core.color("#8996A6")
    ];
  }
}

am4core.useTheme(am4themes_animated)

let column_chart = <?= $column_chart ?>;
let pie_chart = <?= $pie_chart ?>;

var chart = am4core.createFromConfig({
  // Reduce saturation of colors to make them appear as toned down
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
    },

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
      },

    "colors": {
      "list": [
        "#845EC2",
        "#D65DB1",
        "#FF6F91",
        "#FF9671",
        "#FFC75F",
        "#F9F871"
      ]
    }
    }
  }],

  // Add legend
}, "chartdiv-pie", "PieChart")

</script>