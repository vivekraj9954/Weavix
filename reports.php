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

<?php include('server.php') ?>

<!DOCTYPE html>
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

	<style type="text/css">
	.error {
		width: 100%; 
		margin: 0px auto; 
		padding: 10px; 
		border: 1px solid #a94442; 
		color: #a94442; 
		background: #f2dede; 
		border-radius: 5px; 
		text-align: left;
	}
	.info {
		width: 100%; 
		margin: 0px auto; 
		padding: 10px; 
		border: 1px solid #58a841; 
		color: #58a841; 
		background: #def1de; 
		border-radius: 5px; 
		text-align: left;
	}
</style>

</head>
<body>



	<div>
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
					<li>
						<a href="production.php"><i class="fa fa-edit "></i>Production</a>
					</li>
					<li class="active-link">
						<a href="reports.php"><i class="fa fa-qrcode "></i>Reports</a>
					</li>

				</ul>
			</div>

		</nav>
		<!-- /. NAV SIDE  -->
		<div id="page-wrapper" >
			<div id="page-inner">
				
				<!-- /. ROW  --> 
				
			</div>
			<!-- /. PAGE INNER  -->
		</div>
		<!-- /. PAGE WRAPPER  -->
	</div>
	<div class="footer">


		<div class="row">
			<div class="col-lg-12" >
				&copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>
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


</body>
</html>

