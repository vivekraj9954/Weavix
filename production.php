<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");
}

?>

<? php include('server.php'); ?>



<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Weavix</title>
	<!-- BOOTSTRAP STYLES-->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- CUSTOM STYLES-->
	<link href="assets/css/custom.css" rel="stylesheet" />
	<!-- GOOGLE FONTS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>



	<div id="wrapper">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="adjust-nav">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">
						<img src="assets/img/logo.png" style="height: 50px;" />

					</a>

				</div>

				<span class="logout-spn" >
					<a href="#" style="color:#fff;">LOGOUT</a>  

				</span>
			</div>
		</div>
		<!-- /. NAV TOP  -->
		<nav class="navbar-default navbar-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="main-menu">
					<li>
						<a href="dashboard.php" ><i class="fa fa-desktop "></i>Dashboard</a>
					</li>
					<li>
						<a href="usermanagement.php"><i class="fa fa-table "></i>User Management</a>
					</li>
					<li class="active-link">
						<a href="production.php"><i class="fa fa-edit "></i>Production</a>
					</li>
					<li>
						<a href="reports.php"><i class="fa fa-qrcode "></i>Reports</a>
					</li>
				</ul>
			</div>

		</nav>
		<!-- /. NAV SIDE  -->
		<div id="page-wrapper" >
			<div id="page-inner">

				<div style="padding: 20px;">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#loomStart">Loom Start</a></li>
						<li><a data-toggle="tab" href="#loomStop">Loom Stop</a></li>
					</ul>

					<div class="tab-content">


						<div id="loomStart" class="tab-pane fade in active">
							
							<h3>Loom Start</h3>
							<hr>

							<form name="loomstartform" method="POST" action="production.php" onsubmit="return loomstartformValidate()">

								<div class="row">
									<div class="col-md-3" >
										<span>Loom No. :</span>
									</div>

									<div class="col-md-3" >
										<span>Employee No. :</span>
									</div>

									<div class="col-md-3" >
										<span>Cloth Type :</span>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 col-sm-12">
										<div class="input-group mb-3">
											<select class="custom-select form-control" name="loomno">
												<option selected value="">----Select----</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="3">4</option>
												<option value="3">5</option>
												<option value="3">6</option>
												<option value="3">7</option>
												<option value="3">8</option>
												<option value="3">9</option>
												<option value="3">10</option>
											</select>
										</div>
									</div>

									<div class="col-md-3 col-sm-12">
										<input class="form-control" placeholder="" name="empno" />
									</div>

									<div class="col-md-3 col-sm-12">
										<div class="input-group mb-3">
											<select class="custom-select form-control" name="clothtype">
												<option selected value="">----Select----</option>
												<option value="1">Cotton</option>
												<option value="2">Nylon</option>
												<option value="3">Silk</option>
											</select>
										</div>
									</div>	
								</div>

								<br>

								<div class="row">
									<div class="col-md-3" >
										<span>Start Time :</span>
									</div>

									<div class="col-md-3" >
										<span>Start Reading :</span>
									</div>

									<div class="col-md-3" >
										<span>Shift :</span>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3 col-sm-12">
										<input class="form-control" type="time" placeholder="" name="starttime" />
									</div>

									<div class="col-md-3 col-sm-12">
										<input class="form-control" type="number" placeholder="" name="startreading" />
									</div>

									<div class="col-md-3 col-sm-12">
										<div class="input-group mb-3">
											<select class="custom-select form-control" name="mat ">
												<option selected value="">----Select----</option>
												<option value="1">Day</option>
												<option value="2">Night</option>
											</select>
										</div>
									</div>	
								</div>

								<br>

								<div class="row">
									<div class="col-md-3">
										<button class="btn btn-info" name="startloombtn">Start</button>
									</div>
									<div class="col-md-3">
										<button class="btn btn-info" name="resetbtn">Reset</button>
									</div>
								</div>

							</form>

						</div>


						<div id="loomStop" class="tab-pane fade in">
							<h3>Loom Stop</h3>
							<hr>
							<form name="loopstopform" method="POST" action="production.php">
								<div class="row">
									<div class="col-md-3">
										<span>Loom No. :</span>
									</div>
									<div class="col-md-3">
										<span>Employee No. :</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="input-group mb-3">
											<select class="custom-select form-control" name="loomnostop">
												<option selected value="">----Select----</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="3">4</option>
												<option value="3">5</option>
												<option value="3">6</option>
												<option value="3">7</option>
												<option value="3">8</option>
												<option value="3">9</option>
												<option value="3">10</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<input type="text" name="empId" class="form-control" disabled placeholder="emp id working on loom">
									</div>
								</div>

								<br>

								<div class="row">
									<div class="col-md-3">
										<span>Stop Reading :</span>
									</div>
									<div class="col-md-3">
										<span>Stop Time :</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<input type="number" name="stopread" class="form-control">
									</div>
									<div class="col-md-3">
										<input type="time" name="stoptime" class="form-control">
									</div>
								</div>

								<br>

								<div class="row">
									<div class="col-md-3">
										<button type="submit" name="loomstopbtn" class="btn btn-info">Stop</button>
									</div>
									<div class="col-md-3">
										<button class="btn btn-info">Reset</button>
									</div>
								</div>
							</form>
						</div>

					</div>
				</div>
				
				<!-- /. ROW  --> 
			</div>
			<!-- /. PAGE INNER  -->
		</div>
		<!-- /. PAGE WRAPPER  -->
	</div>
	<div class="footer">


		<div class="row">
			<div class="col-lg-12" >
				&copy;  2014 Weavix.com | Design by: <a href="http://nathcorp.com" style="color:#fff;" target="_blank">www.nathcorp.com</a>
			</div>
		</div>
	</div>


	<!-- /. WRAPPER  -->
	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<!-- JQUERY SCRIPTS -->
	<script src="assets/js/jquery-1.10.2.js"></script>
	<!-- BOOTSTRAP SCRIPTS -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- CUSTOM SCRIPTS -->
	<script src="assets/js/custom.js"></script>

	<script type="text/javascript">
		function loomstartformValidate(){

		}
	</script>


</body>
</html>
