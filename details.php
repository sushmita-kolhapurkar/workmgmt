<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
    <link rel="stylesheet" href="assets/css/style.blue.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard: Beracah Infosolutions</title>
</head>

<body>     
    <div class="page">    
<?php
  if(isset($_GET['id'])) {
    $projid = $_GET['id'];
  	$db = new DBWrapper();
    $project = $db->getData("tblproject", "WHERE `SlNo` = ".$projid);
  	$production = $db->getData("tblproduction", "WHERE `SlNo` = ".$projid);
  }
  ?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <!-- Count item widget-->
            <div class="col-lg-12">
              <div class="card">
  				<div class="breadcrumb-holder">
                	<a href="inbox.php">&laquo; Go back to Inbox</a>
                </div>
                <div class="card-header">
                  <h4>Work Order Details</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                      <tr>
                        <th>Project</th>
                        <td colspan="3"><?= $project[0]['Reference'] ?></td>
                      </tr>
                      <tr>
                        <th>File Name</th>
                        <td colspan="3"><?= $project[0]['FileName'] ?></td>
                      </tr>
                      <tr>
                        <th>Received Date</th>
                        <td><?= date("d M Y", strtotime($project[0]['RecDate'])) ?></td>
                        <th>Due Date</th>
                        <td><?= date("d M Y", strtotime($project[0]['DueDate'])) ?></td>
                      </tr>
                      <tr>
                        <th>Pages</th>
                        <td><?= $project[0]['Pages'] ?></td>
                        <th>Comments</th>
                        <td><?= $project[0]['Comments'] ?></td>
                      </tr>
                      <tr>
                        <th>Language</th>
                        <td colspan="3"><?= $project[0]['Language'] ?></td>
                      </tr>
                      <tr>
                        <td colspan="4"></td>
                      </tr>
                      <?php 
					  if($production) {
						  foreach($production as $proddata) { ?>
                      <tr class="bg-light">
                      	<th>Process</th>
                        <td colspan="3" class="text-bold"><?= $proddata['Process'] ?></td>
                      </tr>
                      <tr>
                        <th>Handled by</th>
                        <td><?= $proddata['Emp'] ?></td>
                        <th>Status</th>
                        <td><?= $proddata['Status'] ?></td>
                      </tr>
                      <tr>
                        <th>Delivered on</th>
                        <td><?= date("d M Y", strtotime($proddata['DelDate'])) ?></td>
                        <th>Time taken</th>
                        <td><?= $proddata['Time'] ?> minutes</td>
                      </tr>
                      <?php } } ?>
                      </tbody>
                    </table>
                  </div>
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
</body>
</html>