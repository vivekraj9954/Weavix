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

<?php 
include('server.php'); 
?>



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

<script type="text/javascript">

	function addProdFormValidation() {
		var loomno = document.forms["addprodform"]["loomno"];
		var empno = document.forms["addprodform"]["empno"];
		var clothtype = document.forms["addprodform"]["clothtype"];
		var startreading = document.forms["addprodform"]["startreading"];
		var shift = document.forms["addprodform"]["shift"];

		if (loomno.value == "") {
			window.alert("Please enter loomno.");
			loomno.focus();
			return false;
		}
		if (empno.value == "") {
			window.alert("Please enter empno.");
			empno.focus();
			return false;
		}
		if (clothtype.value == "") {
			window.alert("Please select clothtype.");
			clothtype.focus();
			return false;
		}
		if (startreading.value == "") {
			window.alert("Please enter startreading.");
			startreading.focus();
			return false;
		}
		if (shift.value == "") {
			window.alert("Please select shift.");
			shift.focus();
			return false;
		}
	}


</script>

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
						<li class="active" id="li1"><a data-toggle="tab" href="#loomStart">Loom Start</a></li>
						<li class="" id="li2"><a data-toggle="tab" href="#loomStop">Loom Stop</a></li>
						<li class="" id="li3"><a data-toggle="tab" href="#loomActive">Loom Active</a></li>
					</ul>

					<div class="tab-content">


						<div id="loomStart" class="tab-pane fade in active">
							
							<h3>Loom Start</h3>
							<hr>

							<form name="loomstartform" method="POST" action="production.php" onsubmit="return loomstartformValidate()">


								<?php  if (count($errors) > 0) : ?>
									<div class="error">
										<?php foreach ($errors as $error) : ?>
											<strong><p><?php echo $error ?></p></strong>
										<?php endforeach ?>
									</div>
								<?php  endif ?>

								<?php  if (count($info) > 0) : ?>
									<div class="info">
										<?php foreach ($info as $i) : ?>
											<strong><p><?php echo $i ?></p></strong>
										<?php endforeach ?>
									</div>
								<?php  endif ?>

								<div class="row">
									<div class="col-md-3" >
										<span>Loom No. :</span>
									</div>

									<div class="col-md-3" >
										<span>Employee No. :</span>
									</div>

								</div>

								<div class="row">
									<div class="col-md-3 col-sm-12">
										<div class="input-group mb-3">
											<?php if(isset($_GET['loom'])) : ?>
												<input class="form-control" type="number" id="loomno" name="loomno" onchange="updatestartread()" value="<?php echo $_GET['loom'] ?>">
												<?php else :?>	
													<input class="form-control" type="number" id="loomno" name="loomno" onchange="updatestartread()" placeholder="">
												<?php endif?>
											</div>
										</div>

										<div class="col-md-3 col-sm-12">
											<input class="form-control" placeholder="" name="empno" />
										</div>

										
									</div>

									<br>

									<div class="row">

										<div class="col-md-3" >
											<span>Start Reading :</span>
										</div>

										<div class="col-md-3" >
											<span>Cloth Type :</span>
										</div>
									</div>

									<div class="row">

										<div class="col-md-3 col-sm-12">
											<?php 
											if (isset($_GET['loom'])) {
												$loomno = $_GET['loom'];
												$query = "select Marking from production_loom where Loom_No='$loomno';";

												$data = mysqli_query($db, $query);

												$row = mysqli_fetch_assoc($data);

												echo '<input class="form-control" type="number" name="startreading" value="'.$row['Marking'].'">';
											} else {
												echo '<input class="form-control" type="number" name="startreading" disabled placeholder="Select Loom First">';
											}
											?>
										</div>

										<div class="col-md-3 col-sm-12">
											<div class="input-group mb-3">
												<select class="custom-select form-control" name="clothtype">
													<option selected value="">----Select----</option>
													<option value="Cotton">Cotton</option>
													<option value="Nylon">Nylon</option>
													<option value="Silk">Silk</option>
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
								<form name="loomstopform" method="POST" action="production.php?tab=2" onsubmit="return loomstartformValidate()"> 
									<?php if(count($errors2) > 0) : ?>
										<div class="error">
											<?php foreach ($errors2 as $error) : ?>
												<strong><p><?php echo $error ?></p></strong>
											<?php endforeach ?>
										</div>
									<?php endif ?>

									<?php  if (count($info2) > 0) : ?>
										<div class="info">
											<?php foreach ($info2 as $i) : ?>
												<strong><p><?php echo $i ?></p></strong>
											<?php endforeach ?>
										</div>
									<?php  endif ?>

									<div class="row">
										<div class="col-md-3">
											<span>Loom No. :</span>
										</div>
										<div class="col-md-3">
											<span>Stop Reading :</span>
										</div>

									</div>
									<div class="row">
										<div class="col-md-3">
											<?php if(isset($_GET['loomcheck'])) : ?>
												<input type="number" min="0" max="10" class="form-control" name="loomnostop" id="loomnostop" onchange="showloominfo()" value="<?php echo $_GET['loomcheck']; ?>">
												<?php else : ?>
												<input type="number" min="0" max="10" class="form-control" name="loomnostop" id="loomnostop" onchange="showloominfo()" placeholder="Loom to stop">
											<?php endif ?>
										</div>
										<div class="col-md-3">
											<input type="number" name="stopread" class="form-control">
										</div>

									</div>

									<br>

									<div class="row">
										<?php 
										if (isset($_GET['loomcheck'])) {
											$loomstop = $_GET['loomcheck'];
											$query = "select * from loom_status_temp where Loom_No='$loomstop';";
											$result = mysqli_query($db,$query);
											if (mysqli_num_rows($result) > 0) {
												echo '<div class="col-md-3" style="text-align: right;">';
												echo 'Employee No.  :<br>';
												echo 'Cloth Type.  :<br>';
												echo 'Start Reading  :<br>';
												echo 'Start Time  :<br>';
												echo 'Shift  :<br>';
												echo '</div>';
												echo '<div class="col-md-9">';

												$row = mysqli_fetch_assoc($result);

												echo $row['Emp_Id'].'<br>';
												echo $row['Cloth_Type'].'<br>';
												echo $row['Start_Reading'].'<br>';
												echo $row['Start_Time'].'<br>';
												echo $row['Shift'].'<br>';
												echo '</div>';
											} else {
												echo '<div class="error">';
											
												echo '<strong><p>Loom is not active. No Data to show</p></strong>';
											
												echo '</div>';
											}
										}
										?>

									</div>
								

								<br>

								<div class="row">
									<div class="col-md-3">
										<button name="loomstopbtn" class="btn btn-info">Stop</button>
									</div>
								</div>
							</form>
						</div>

						<div id="loomActive" class="tab-pane fade in">
							<h3>Active Looms</h3>
							<hr>

							<table class="table table-hover">
								<thead>
									<tr>
										<th>Loom No.</th>
										<th>Employee Id</th>
										<th>Cloth Type</th>
										<th>Start Reading</th>
										<th>Start Time</th>
										<th>Shift</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$getloomquery = "Select * from loom_status_temp;";

									if ($results2 = mysqli_query($db, $getloomquery)) {
										while ($row = mysqli_fetch_assoc($results2)) {
											echo '<tr><td>'.$row['Loom_No'].'</td><td>'.$row['Emp_Id'].'</td><td>'.$row['Cloth_Type'].'</td><td>'.$row['Start_Reading'].'</td><td>'.$row['Start_Time'].'</td><td>'.$row['Shift'].'</td></tr>';
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

		function updatestartread(){
			var loomno = document.getElementById("loomno").value;
			window.location = "production.php?loom="+loomno;
		}

		function showloominfo(){
			var loomno = document.getElementById("loomnostop").value;
			window.location = "production.php?tab=2&loomcheck="+loomno;
		}

		var getQueryString = function ( field, url ) {
			var href = url ? url : window.location.href;
			var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
			var string = reg.exec(href);
			return string ? string[1] : null;
		};

		var tab = getQueryString('tab');

		if (tab == '2') {
			document.getElementById("li1").classList.remove('active');
			document.getElementById("loomStart").classList.remove('active');
			document.getElementById("li2").classList.add('active');
			document.getElementById("loomStop").classList.add('active');
		}

		if (tab == '3') {
			document.getElementById("li1").classList.remove('active');
			document.getElementById("loomStart").classList.remove('active');
			document.getElementById("li3").classList.add('active');
			document.getElementById("loomActive").classList.add('active');
		}


	</script>


</body>
</html>
