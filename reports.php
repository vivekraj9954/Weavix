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



	<div id="wrapper">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="adjust-nav">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">
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
				
				<div style="padding: 20px;">
					<ul class="nav nav-tabs">
						<li class="active" id="li1"><a data-toggle="tab" href="#productionreport">Production Report</a></li>
						<li id="li2"><a data-toggle="tab" href="#clothreport">Cloth Report</a></li>
						<li id="li3"><a data-toggle="tab" href="#Employeereport">Employee Report</a></li>
					</ul>

					<div class="tab-content">


						<div id="productionreport" class="tab-pane fade in active">	
							<form name="Productionreportform" method="POST" action="reports.php">


								<h3>Production Report</h3>		
								<hr>
								<div class="container">
									<div class="row">
										<form class="form-horizontal" action="reports.php" method="POST">


											<div class="row">
												<div class="col-md-1">
													<label>Loom_No</label>
												</div>
												<div class="col-lg-4">
													<select name="loomnumber" class="form-control">
														<option>-------Select------</option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
													</select>
												</div>
												<div class="col-md-3">
													<button name="submit" class="btn btn-primary">Submit</button>
												</div>
											</div>						 


											<hr>
										</form>
									</div>
								</div>
								<div class="row">
									<table class="table table-striped table-hover" style="width: 100%">
										<thead>
											<tr>
												<th>Loom_No</th>
												<th>Cotton</th>
												<th>Nylon</th>
												<th>Silk</th>
												<th>Production_Total</th>
												<th>Day</th>
												<th>Night</th>
												<th>Marking</th>
											</tr>
										</thead>						
										<tbody>
											<?php 
											/* include("db.php"); */
											if(isset($_POST['submit'])){

												$Loom_No = $_POST['loomnumber']; 
												if($Loom_No !=""){
													$query =  "SELECT * from production_loom WHERE Loom_No='$Loom_No';";

													$conn1 = mysqli_connect('localhost', 'root', '', 'weavix');
													$data = mysqli_query($conn1, $query) or die('error');
													if(mysqli_num_rows($data) > 0){
														while($row = mysqli_fetch_assoc($data)){
															$Loom_No = $row['Loom_No'];
															$Cloth_A = $row['Cotton'];
															$Cloth_B= $row['Nylon'];
															$Cloth_C = $row['Silk'];
															$Production_Total = $row['Production_Total'];
															$Day= $row['Day'];
															$Night= $row['Night'];
															$Marking = $row['Marking'];


															echo '<tr><td>'.$Loom_No.'</td><td>'.$Cloth_A.'</td><td>'.$Cloth_B.'</td><td>'.$Cloth_C.'</td><td>'.$Production_Total.'</td><td>'.$Day.'</td><td>'.$Night.'</td><td>'.$Marking.'</td></tr>';


														}
													}

												} 
											} else {

												#show all

												$query =  "SELECT * from production_loom;";

												$conn1 = mysqli_connect('localhost', 'root', '', 'weavix');
												$data = mysqli_query($conn1, $query) or die('error');
												if(mysqli_num_rows($data) > 0){
													while($row = mysqli_fetch_assoc($data)){
														$Loom_No = $row['Loom_No'];
														$Cloth_A = $row['Cotton'];
														$Cloth_B= $row['Nylon'];
														$Cloth_C = $row['Silk'];
														$Production_Total = $row['Production_Total'];
														$Day= $row['Day'];
														$Night= $row['Night'];
														$Marking = $row['Marking'];


														echo '<tr><td>'.$Loom_No.'</td><td>'.$Cloth_A.'</td><td>'.$Cloth_B.'</td><td>'.$Cloth_C.'</td><td>'.$Production_Total.'</td><td>'.$Day.'</td><td>'.$Night.'</td><td>'.$Marking.'</td></tr>';
													}
												} 
											}
											?>
										</tbody>
									</table>
								</div>
							</form>
						</div>


						<div id="clothreport" class="tab-pane fade in ">

							

							<form class="form-horizontal" method="POST" action="reports.php?tab=2">
								<h3> Cloth Report</h3>
								<hr>
								
								<div class="row">
									<div class="col-md-1">
										<label>Cloth_Type</label>
									</div>
									<div class="col-lg-4">
										<select name="clothtype" class="form-control">
											<option Selected value="">-----Select-----</option>
											<option value="Cotton">Cotton</option>
											<option value="Nylon">Nylon</option>
											<option value="Silk">Silk</option>
										</select>
									</div>
									<div class="col-md-2">
										<button name="submit1" class="btn btn-primary">Submit</button> 
									</div>
								</div>						 

								
								<hr>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<?php
											if(isset($_POST['submit1'])){

												$clothtype = $_POST['clothtype']; 
												if($clothtype =="Cotton"){
													echo '<th>Loom_No</th>';
													echo '<th>Cotton</th>';
													echo '<th>Production_Total</th>';
												} 
												else if ($clothtype == "Nylon") {
													echo '<th>Loom_No</th>';
													echo '<th>Nylon</th>';
													echo '<th>Production_Total</th>';
												} else {
													echo '<th>Loom_No</th>';
													echo '<th>Silk</th>';
													echo '<th>Production_Total</th>';
												}
											} 
											?>
										</tr>
									</thead>						
									<tbody>
										<?php 
										/* include("db.php"); */
										if(isset($_POST['submit1'])){

											$clothtype = $_POST['clothtype']; 
											if($clothtype =="Cotton"){
												$query =  "SELECT * from production_loom;";

												$conn1 = mysqli_connect('localhost', 'root', '', 'weavix');
												$data = mysqli_query($conn1, $query) or die('error');
												if(mysqli_num_rows($data) > 0){
													while($row = mysqli_fetch_assoc($data)){
														$Loom_No = $row['Loom_No'];
														$Cloth = $row['Cotton'];
														$Production_Total = $row['Production_Total'];


														echo '<tr><td>'.$Loom_No.'</td><td>'.$Cloth.'</td><td>'.$Production_Total.'</td><td>';
													}
													$gettotalquery = 'select sum(Cotton) as totalcloth, sum(Production_Total) as totalproduction from production_loom;';

													$data2 = mysqli_query($conn1, $gettotalquery);
													$row2 = mysqli_fetch_assoc($data2);
													echo '<tr><td><strong>Total -></strong></td><td><strong>'.$row2['totalcloth'].'</strong></td><td><strong>'.$row2['totalproduction'].'</strong></td><td>';
												}

											} 
											else if ($clothtype == "Nylon") {
												$query =  "SELECT * from production_loom;";

												$conn1 = mysqli_connect('localhost', 'root', '', 'weavix');
												$data = mysqli_query($conn1, $query) or die('error');
												if(mysqli_num_rows($data) > 0){
													while($row = mysqli_fetch_assoc($data)){
														$Loom_No = $row['Loom_No'];
														$Cloth = $row['Nylon'];
														$Production_Total = $row['Production_Total'];


														echo '<tr><td>'.$Loom_No.'</td><td>'.$Cloth.'</td><td>'.$Production_Total.'</td><td>';
													}
													$gettotalquery = 'select sum(Nylon) as totalcloth, sum(Production_Total) as totalproduction from production_loom;';

													$data2 = mysqli_query($conn1, $gettotalquery);
													$row2 = mysqli_fetch_assoc($data2);
													echo '<tr><td><strong>Total -></strong></td><td><strong>'.$row2['totalcloth'].'</strong></td><td><strong>'.$row2['totalproduction'].'</strong></td><td>';
												}
											} else {
												
												#show all

												$query =  "SELECT * from production_loom;";

												$conn1 = mysqli_connect('localhost', 'root', '', 'weavix');
												$data = mysqli_query($conn1, $query) or die('error');
												if(mysqli_num_rows($data) > 0){
													while($row = mysqli_fetch_assoc($data)){
														$Loom_No = $row['Loom_No'];
														$Cloth = $row['Silk'];
														$Production_Total = $row['Production_Total'];


														echo '<tr><td>'.$Loom_No.'</td><td>'.$Cloth.'</td><td>'.$Production_Total.'</td><td>';
													}
													$gettotalquery = 'select sum(Silk) as totalcloth, sum(Production_Total) as totalproduction from production_loom;';

													$data2 = mysqli_query($conn1, $gettotalquery);
													$row2 = mysqli_fetch_assoc($data2);
													echo '<tr><td><strong>Total -></strong></td><td><strong>'.$row2['totalcloth'].'</strong></td><td><strong>'.$row2['totalproduction'].'</strong></td><td>';
												} 
											}
										}
										?>
									</tbody>
								</table>


							</form>
						</div> 

						<div id="Employeereport" class="tab-pane fade in ">

							<h3> Employee Report</h3>
							<hr>
							<div class="container">
								<div class="row">
									<form class="form-horizontal" action="reports.php?tab=3" method="POST">


										<div class="row">
											<div class="col-md-1">
												<label>Emp_Id</label>
											</div>
											<div class="col-lg-4">
												<input type="number" class="form-control" name="empid" placeholder="Emp_Id">
											</div>
											<div class="col-md-2">
												<button name="submit2" class="btn btn-primary">Submit</button>	
											</div>
										</div>						 


										<hr>


									</form>
								</div>

								<div class="row">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th>Emp_Id</th>
												<th>Cotton</th>
												<th>Nylon</th>
												<th>Silk</th>
												<th>Production_Total</th>
												<th>Day Shift</th>
												<th>Night Shift</th>
											</tr>
										</thead>						
										<tbody>
											<?php 
											/* include("db.php"); */
											if(isset($_POST['submit2'])){

												$Emp_Id= $_POST['empid']; 

												$query =  "SELECT * from employee_wise_prod  WHERE Employee_Id='$Emp_Id';";

												$conn1 = mysqli_connect('localhost', 'root', '', 'weavix');
												$data = mysqli_query($conn1, $query) or die('error');
												$row = mysqli_fetch_assoc($data);
												$Cloth_A = $row['Cotton'];
												$Cloth_B= $row['Nylon'];
												$Cloth_C = $row['Silk'];
												$Production_Total = $row['Total_Production'];
												$dayShift= $row['Day_Shift'];
												$nightShift= $row['Night_Shift'];



												echo '<tr><td>'.$Emp_Id.'</td><td>'.$Cloth_A.'</td><td>'.$Cloth_B.'</td><td>'.$Cloth_C.'</td><td>'.$Production_Total.'</td><td>'.$dayShift.'</td><td>'.$nightShift.'</td></tr>';
												
											} else {
												$query =  "SELECT * from employee_wise_prod;";

												$conn1 = mysqli_connect('localhost', 'root', '', 'weavix');
												$data = mysqli_query($conn1, $query) or die('error');
												while($row = mysqli_fetch_assoc($data)){
													$employeeid = $row['Employee_Id'];	
													$Cloth_A = $row['Cotton'];
													$Cloth_B= $row['Nylon'];
													$Cloth_C = $row['Silk'];
													$Production_Total = $row['Total_Production'];
													$dayShift= $row['Day_Shift'];
													$nightShift= $row['Night_Shift'];



													echo '<tr><td>'.$employeeid.'</td><td>'.$Cloth_A.'</td><td>'.$Cloth_B.'</td><td>'.$Cloth_C.'</td><td>'.$Production_Total.'</td><td>'.$dayShift.'</td><td>'.$nightShift.'</td></tr>';
												}

											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- /. ROW  --> 
					</div>
					<!-- /. PAGE INNER  -->
				</div> 
				
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

	<script type="text/javascript">
		

		var getQueryString = function ( field, url ) {
			var href = url ? url : window.location.href;
			var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
			var string = reg.exec(href);
			return string ? string[1] : null;
		};

		var tab = getQueryString('tab');

		if (tab == '2') {
			document.getElementById("li1").classList.remove('active');
			document.getElementById("productionreport").classList.remove('active');
			document.getElementById("li2").classList.add('active');
			document.getElementById("clothreport").classList.add('active');
		}

		if (tab == '3') {
			document.getElementById("li1").classList.remove('active');
			document.getElementById("productionreport").classList.remove('active');
			document.getElementById("li3").classList.add('active');
			document.getElementById("Employeereport").classList.add('active');
		}


	</script>


</body>
</html>

