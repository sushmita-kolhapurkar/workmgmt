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
  $db = new DBWrapper();
  $projStatus = "All";
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['btnAll'])) {
  		$project = $db->getData("tblproject", "ORDER BY `SlNo` DESC");
		$projStatus = "All";
	}
	else if(isset($_POST['btnPend'])) {
  		$project = $db->getData("tblproject", "WHERE `Status` = 'Pending' ORDER BY `SlNo` DESC");
		$projStatus = "Pending";
	}
	else if(isset($_POST['btnDel'])) {
  		$project = $db->getData("tblproject", "WHERE `Status` = 'Delivered' ORDER BY `SlNo` DESC");
		$projStatus = "Delivered";
	}
	else if(isset($_POST['btnProg'])) {
  		$project = $db->getData("tblproject", "WHERE `Status` = 'Progress' ORDER BY `SlNo` DESC");
		$projStatus = "In Progress";
	}
  }
  else {
  	$project = $db->getData("tblproject", " ORDER BY `SlNo` DESC LIMIT 20");
  }
  ?>
      <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row justify-content-end">
            <div class="col col-md-2 justify-content-end m-3">
              <input type="submit" name="btnAddTask" class="btn btn-primary btn-lg float-right" value="&oplus; Add New Task" onclick="window.location.href='workorder.php';" /></input>
            </div>
          </div>
          <div class="row p-2 bg-white">
   	 	    <div class="col-md-2">
              <h4 class="align-text-bottom">Task Inbox: <em><?= $projStatus ?></em></h4>
            </div>
   			      <div class="col-md-10 justify-content-end">
                 	<form action="" method="post" class="form-inline">
              		  <ul class="nav ml-auto">
                      <li class="nav-item">
                        <input type="submit" name="btnAll" class="nav-link <?= ($projStatus == "All") ? "active":'' ?>" value="All" /></input>
                      </li>
                      <li class="nav-item">
                        <input type="submit" name="btnPend" class="nav-link <?= ($projStatus == "Pending") ? "active":'' ?>" value="Pending" /></input>
                      </li>
                      <li class="nav-item">
                        <input type="submit" name="btnProg" class="nav-link <?= ($projStatus == "In Progress") ? "active":'' ?>" value="In Progress" /></input>
                      </li>
                      <li class="nav-item">
                        <input type="submit" name="btnDel" class="nav-link <?= ($projStatus == "Delivered") ? "active":'' ?>" value="Delivered" /></input>
                      </li>
                    </ul>
                    </form>
                  </div>
              </div>
              <div class="row p-2 bg-white">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>S.No</th>
                         <!-- <th>Client Name</th>-->
                          <th>Project</th>
                          <th>File Name</th>
                          <th>Pages</th>
                          <th>Due Date</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($project as $task) {
  						$prod = $db->getIndData("Process", "tblproduction", "WHERE `SlNo` = ".$task['SlNo']." ORDER BY `DelDate` DESC LIMIT 1");
						echo "
                        <tr>
                          <td>".$task['SlNo']."</td>
                          <td>".$task['Reference']."</td>
                          <td><a href='details.php?id=".$task['SlNo']."'>".$task['FileName']."</a></td>
                          <td>".$task['Pages']."</td>
                          <td>".date("d/m/Y", strtotime($task['DueDate']))."</td>
                          <td>";
						echo  $prod[0]['Process'] != "" ?  $prod[0]['Process']." - <em>Done</em>": "<em class='alert-warning'>Yet to start</em>"; 
					    echo "
					   	  <td><a href='status.php?id=".$task['SlNo']."'>Change Status</a></td>
                        </tr>";
						} ?>
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