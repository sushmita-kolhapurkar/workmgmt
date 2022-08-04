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
    <link rel="stylesheet" href="assets/css/style.default.css" id="theme-stylesheet">
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
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <!-- Count item widget-->
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add Work Order</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post" class="form-horizontal">
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">File Name</label>
                      <div class="col-sm-10">
                        <input name="FileName" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Reference</label>
                      <div class="col-sm-10">
                        <input name="Reference" type="text" class="form-control"><span class="text-small text-gray help-block-none">E-mail header</span>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Number of Pages</label>
                      <div class="col-sm-10">
                        <input name="Pages" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Number of Comments</label>
                      <div class="col-sm-10">
                        <input name="Comments" type="text" class="form-control">
                      </div>
                    </div>                    
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Language</label>
                      <div class="col-sm-10 mb-3">
                        <select name="Language" class="form-control">
                          <option>English</option>
                          <option>Arabic</option>
                          <option>French</option>
                          <option>German</option>
                          <option>Chinese</option>
                        </select>
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Due Date</label>
                      <div class="col-sm-10">
                      	<input type="date" name="DueDate">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <input type="submit" name="btnSave" class="btn btn-primary" value="Save Work Order" /></input>
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
	if(isset($_POST['btnSave'])) {
	
      $db = new DBWrapper();
	  /* Production: Total */
      $db->insProject($_POST);
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