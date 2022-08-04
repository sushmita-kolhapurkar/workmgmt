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
    $proj = $db->getData("tblproject", "WHERE `SlNo` = ".$projid);
}
?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <!-- Count item widget-->
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Change Work Status</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post" class="form-horizontal">
                    <div class="form-group row">
                      <input name="SlNo" type="hidden" value="<?= $projid ?>" />
                      <label class="col-sm-2 form-control-label">File Name</label>
                      <div class="col-sm-10">
                        <?= $proj[0]['FileName'] ?>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Process</label>
                      <div class="col-sm-10 mb-3">
                        <select name="Process" class="form-control">
                          <option>Clean Up</option>
                          <option>Production</option>
                          <option>PreCompare</option>
                          <option>PreCompare EI</option>
                          <option>QC</option>
                          <option>QC EI</option>
                          <option>PreCompare &amp; QC EI Check</option>
                          <option>Final Comparison</option>
                          <option>File Package</option>
                          <option>Upload</option>
                        </select>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Handled By</label>
                      <div class="col-sm-10">
                        <input name="Emp" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Pages</label>
                      <div class="col-sm-4">
                        <input name="PgRange" type="text" class="form-control">
                      </div>
                      <label class="col-sm-2 form-control-label">Total no of Pages</label>
                      <div class="col-sm-4">
                        <input name="TotPgs" type="text" class="form-control">
                      </div>
                    </div>
                      <div class="col-sm-8">
                         <input type="submit" name="btnPlay" class="btn btn-primary" value='<i class="fa fa-play"></i>' />
                         <input type="submit" name="btnPause" class="btn btn-primary" value='<i class="fa fa-pause"></i>' />  
                         <input type="submit" name="btnStop" class="btn btn-primary" value='<i class="fa fa-stop"></i>' /> 
                      </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Time Taken <br><small class="text-primary">In minutes</small></label>
                      <div class="col-sm-10">
                        <input name="Time" type="text" class="form-control">
                      	<input name="Status" type="hidden" value="Completed" />  <!-- To Be Removed while adding the assignment of tasks -->
                      </div>
                    </div>                    
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <input type="submit" name="btnSave" class="btn btn-primary" value="Save" />
             			<input type="button" class="btn btn-secondary" value="Cancel" onclick="window.location.href='inbox.php';" /></input>
                      </div>
                    </div> 
                  </form>
               </div>
             </div>
          </div>
        </div>
      </section>
      
        
<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['btnStart'])) {
	  
      $db = new DBWrapper();
	  /* Insert into Production table */
      $db->insProduction($_POST);
	  /* Check 'StartDate' in Project table */
      $projStatus = $db->getIndData("StartDate", "tblproject", "WHERE `SlNo` = ".$projid);	  
	  $projStatus = $projStatus[0]['Status'];
	}
	if(isset($_POST['btnSave'])) {
	  /* Check 'Status' in Project table */
      $projStatus = $db->getIndData("Status", "tblproject", "WHERE `SlNo` = ".$projid);	  
	  $projStatus = $projStatus[0]['Status'];
	  
	  /* Change Status to 'Progress'/'Delivered' */
	  if ($projStatus != "Progress" && $_POST['Process'] != "Upload") {
		$db->updData("tblproject", "Status", "Progress", "WHERE `SlNo` = ".$projid); 
	  }
	  else if ($_POST['Process'] == "Upload") {
		$db->updData("tblproject", "Status", "Delivered", "WHERE `SlNo` = ".$projid); 
	  }
	  
	  echo "<script type='text/javascript'>location.href='inbox.php';</script>";
	}
  }
     ?>
     
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