
<page style="font-size: 14px">
    
    <script src="UPP%20-%20Admin_files/jquery.js"></script>
</head>
<body>
<div class="container"> 
  <script src="UPP%20-%20Admin_files/highcharts.js"></script>
  <div class="row">
    <div class="col-lg-6">
      <div data-highcharts-chart="0" id="container-178" style="width:100%;height:400px;margin: 0 auto;"></div>
      <script>
								$(function () {
								    $("#container-178").highcharts({
								    	title: {
								    		text: null
								    	},
								    	tooltip: {
								    	    pointFormat: '<b>{point.percentage:.1f}</b>%'
								        },
								        series: [{
								            type: "pie",
								            data: [
								             	 
								                ["Excellent", 30.0],
								                 
								                ["Good", 50.0],
								                 
								                ["Average", 20.0],
								                 
								                ["Poor", 0.0],
								                
								            ]
								        }]
								    });
								});
							</script> 
    </div>
    <div class="col-lg-6">
      <p> <strong>Excellent</strong> (0%) </p>
      <div class="progress" style="height:5px;">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0.0" aria-valuemin="0" aria-valuemax="100" style="width: 0.0%"> <span class="sr-only">0.0%</span> </div>
      </div>
      <p> <strong>Good</strong> (100%) </p>
      <div class="progress" style="height:5px;">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100.0" aria-valuemin="0" aria-valuemax="100" style="width: 100.0%"> <span class="sr-only">100.0%</span> </div>
      </div>
      <p> <strong>Average</strong> (0%) </p>
      <div class="progress" style="height:5px;">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0.0" aria-valuemin="0" aria-valuemax="100" style="width: 0.0%"> <span class="sr-only">0.0%</span> </div>
      </div>
      <p> <strong>Poor</strong> (0%) </p>
      <div class="progress" style="height:5px;">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0.0" aria-valuemin="0" aria-valuemax="100" style="width: 0.0%"> <span class="sr-only">0.0%</span> </div>
      </div>
    </div>
  </div>
</div>
</body>
</page>