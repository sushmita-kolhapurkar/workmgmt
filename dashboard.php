<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
  <?php 
  include(__DIR__.'/inc/env-properties.inc');
  include(__DIR__.'/inc/DBWrapper.php');
	
	  $_SESSION['userid'] = "";
	?>
    
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="assets/css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="assets/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard: Beracah Infosolutions</title>
</head>

<body>
    <div class="page">
    
	<?php 
      $db = new DBWrapper();
	  /* Production: Total */
      $totProd = $db->getProd();
	  $cntTot = $db->getCount("`Status` IN('Pending', 'Progress', 'Delivered')");
	  
	  $cntPrg =0; $cntDel=0; $cntPnd=0; $cntCurWO=0; $cntCurProj=0; $TotPgs=0; $TotCmt=0;
	  
	  /* Production: 'In Progress' Status */
	 // $arrPrg = filter_by_value($totProd, 'Status', 'Progress');
	  $cntPrg = $db->getCount("`Status` = 'Progress'");
	  
	  /* Production: 'Delivered' Status */
	//  $arrDel = filter_by_value($totProd, 'Status', 'Delivered');
	  $cntDel = $db->getCount("`Status` = 'Delivered'");
	  
	  /* Production: 'Pending' Status */
	  $cntPnd = $cntTot - ($cntPrg+$cntDel);
	  
	  $curDate = getdate();
	  
	  /* Count of work orders in the current month */
	  $cntCurWO = $db->getCount("YEAR(`RecDate`) = ".$curDate['year']." AND MONTH(`RecDate`) = ".$curDate['mon']);
	  
	  /* Count of projects in the current month */
	  $CurProj = $db->getDistinct("Reference", "YEAR(`RecDate`) = ".$curDate['year']." AND MONTH(`RecDate`) = ".$curDate['mon']);
	  $cntCurProj = count($CurProj);
	  
	  /* Total of pages in the current month */
	  $TotPgs = $db->getTotal("Pages", "YEAR(`RecDate`) = ".$curDate['year']." AND MONTH(`RecDate`) = ".$curDate['mon']);
	  
	  /* Total of comments in the current month */
	  $TotCmt = $db->getTotal("Comments", "YEAR(`RecDate`) = ".$curDate['year']." AND MONTH(`RecDate`) = ".$curDate['mon']);
	  
	
	  /* Monthly production report: For 6 months (including current) */
	  $datNow =  date("01/m/Y");
	  $datNow = strtotime($datNow);
	  
	  $datPrev = new DateTime();
	  $datPrev->sub(new DateInterval('P6M'));
	  $datPrev->format('01/m/Y');
			
	//  do { 
	for($i=0; $i<6; $i++) {
	  if ($datPrev < $datNow) {
	 	 $datPrev->format('01/m/Y');
		
	  }
	  	$datPrev->add(new DateInterval('P1M'));
	 }
		  
//	  } while (strtotime($datPrev) < $datNow);
		 
	   $lstDate = date("m/Y", strtotime("+4 months", strtotime($lstDate)));
	  $monWO = $db->getCount("YEAR(`RecDate`) = ".$curDate['year']." AND MONTH(`RecDate`) = ".$curDate['mon']);
	  
	  
	  function filter_by_value ($array, $index, $value){
        if(is_array($array) && count($array)>0) 
        {
          foreach(array_keys($array) as $key){
            $temp[$key] = $array[$key][$index];
                
            if ($temp[$key] == $value){
              $newarray[$key] = $array[$key];
            }
		  }
        }
      	return $newarray;
      } ; 
     ?>
     
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Work Orders</strong><span>This month</span>
                  <div class="count-number"><?= $cntCurWO ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-user"></i></div>
                <div class="name"><strong class="text-uppercase">Projects</strong><span>This month</span>
                  <div class="count-number"><?= $cntCurProj ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-check"></i></div>
                <div class="name"><strong class="text-uppercase">Pages</strong><span>This month</span>
                  <div class="count-number"><?= $TotPgs ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-bill"></i></div>
                <div class="name"><strong class="text-uppercase">Comments</strong><span>This month</span>
                  <div class="count-number"><?= $TotCmt ?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list"></i></div>
                <div class="name"><strong class="text-uppercase">TAT</strong><span>This month</span>
                  <div class="count-number">92 %</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list-1"></i></div>
                <div class="name"><strong class="text-uppercase">Some Metrics</strong><span>Last 7 days</span>
                  <div class="count-number">70</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="dashboard-header section-padding">
        <div class="container-fluid">
          <div class="row d-flex align-items-md-stretch">
            <!-- Pie Chart-->
            <div class="col-lg-3 col-md-6">
              <div class="card project-progress">
                <h2 class="display h4">Project Progress</h2>
                <p>Indicates the status of work orders entered in the project database.</p>
                <h4 class="display h5 align-items-center">Total: <?= $cntTot ?></h4>
                <div class="pie-chart">
                  <canvas id="pieChart" width="300" height="300"> </canvas>
                  <?php $valDel = array($cntPnd, $cntPrg, $cntDel); 
				  // echo implode ("','", $valDel)?>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="card project-progress">
                <h2 class="display h4">Bar Chart Example</h2>
                </div>
                <div class="card-body">
                  <canvas id="barChart"></canvas>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </section>
    </div>
    <!-- JavaScript files-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="assets/js/front.js"></script>
    
    
                  
                  <script type="text/javascript">
					  $(document).ready(function () {
						var PIECHARTEXMPLE    = $('#pieChart');
    					var brandPrimary = 'rgba(51, 179, 90, 1)';
						var pieChartExample = new Chart(PIECHARTEXMPLE, {
							type: 'doughnut',
							data: {
								labels: [
									"Pending",
									"In Progress",
									"Completed"
								],
								datasets: [
									{
										data: [<?php echo implode (",", $valDel) ?>],
										borderWidth: [1, 1, 1],
										backgroundColor: [
											brandPrimary,
											"rgba(75,192,192,1)",
											"#FFCE56"
										],
										hoverBackgroundColor: [
											brandPrimary,
											"rgba(75,192,192,1)",
											"#FFCE56"
										]
									}]
								}
						});
					 
					 
						var BARCHARTEXMPLE    = $('#barChart');
					 
    var barChartExample = new Chart(BARCHARTEXMPLE, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Data Set 1",
                    backgroundColor: [
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)',
                        'rgba(51, 179, 90, 0.6)'
                    ],
                    borderColor: [
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)',
                        'rgba(51, 179, 90, 1)'
                    ],
                    borderWidth: 1,
                    data:  [<?php echo implode (",", $valBar1) ?>],
                },
                {
                    label: "Data Set 2",
                    backgroundColor: [
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)',
                        'rgba(203, 203, 203, 0.6)'
                    ],
                    borderColor: [
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)',
                        'rgba(203, 203, 203, 1)'
                    ],
                    borderWidth: 1,
                    data: [35, 40, 60, 47, 88, 27, 30],
                }
            ]
        }
    });

					  });
				  </script>
</body>
</html>