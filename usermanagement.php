<?php include('server.php'); ?>

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
	.custom-hr{
		width: 150px;
		border: solid 1px black;
	}
</style>

<script type="text/javascript">
	function addEmpFormValidation() {
		var firstname = document.forms["addempform"]["empFirstName"];
		var lastname = document.forms["addempform"]["empLastName"];
		var dob = document.forms["addempform"]["dOB"];
		var gender = document.forms["addempform"]["gender"];
		var fathername = document.forms["addempform"]["fatherName"];
		var street = document.forms["addempform"]["street"];
		var city = document.forms["addempform"]["city"];
		var state = document.forms["addempform"]["state"];
		var pin = document.forms["addempform"]["pin"];
		var email = document.forms["addempform"]["emailId"];
		var mobilehome = document.forms["addempform"]["mobileHome"];
		var mobilework = document.forms["addempform"]["mobileWork"];
		var designation = document.forms["addempform"]["designation"];
		var shift = document.forms["addempform"]["shift"];
		var jobstatus = document.forms["addempform"]["jobStatus"];
		var doj = document.forms["addempform"]["dOJ"];
		var basicpay = document.forms["addempform"]["basicPay"];

		if (firstname.value == "") {
			window.alert("Please enter first name.");
			firstname.focus();
			return false;
		}
		if (lastname.value == "") {
			window.alert("Please enter last name.");
			lastname.focus();
			return false;
		}
		if (dob.value == "") {
			window.alert("Please enter date of birth.");
			dob.focus();
			return false;
		}
		if (gender.value == "") {
			window.alert("Please select gender.");
			gender.focus();
			return false;
		}
		if (fathername.value == "") {
			window.alert("Please enter Father's name.");
			fathername.focus();
			return false;
		}
		if (street.value == "") {
			window.alert("Please enter street.");
			street.focus();
			return false;
		}
		if (city.value == "") {
			window.alert("Please enter city.");
			city.focus();
			return false;
		}
		if (state.value == "") {
			window.alert("Please enter state.");
			state.focus();
			return false;
		}
		if (pin.value == "") {
			window.alert("Please enter pin.");
			pin.focus();
			return false;
		}
		if (email.value == "") {
			window.alert("Please enter email id.");
			email.focus();
			return false;
		}

		if (mobilehome.value == "" && mobilework.value == "") {
			window.alert("Please enter atleast one mobile number.");
			mobilehome.focus();
			return false;
		}
		if (designation.value == "") {
			window.alert("Please select designation.");
			designation.focus();
			return false;
		}
		if (shift.value == "") {
			window.alert("Please select working shift.");
			shift.focus();
			return false;
		}
		if (jobstatus.value == "") {
			window.alert("Please select job status.");
			jobstatus.focus();
			return false;
		}
		if (doj.value == "") {
			window.alert("Please enter date of joining.");
			doj.focus();
			return false;
		}
		if (basicpay.value == "") {
			window.alert("Please enter basic pay.");
			basicpay.focus();
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
					<a class="navbar-brand" href="#">
						<img src="assets/img/logo.png" style="height: 50px;" />

					</a>

				</div>

				<span class="logout-spn" >
					<a href="usermanagement.php?logout=1" style="color:#fff;">LOGOUT</a>  

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
					<li class="active-link">
						<a href="usermanagement.php"><i class="fa fa-table "></i>User Management</a>
					</li>
					<li>
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
						<li class="active"><a data-toggle="tab" href="#emplist">Employees</a></li>
						<li><a data-toggle="tab" href="#menu1">Add Employee</a></li>
					</ul>

					<div class="tab-content">


						<div id="emplist" class="tab-pane fade in">
							<h3>Employee List</h3>
							<hr>

						</div>



						<div id="menu1" class="tab-pane fade active">
							<form name="addempform" method="post" onsubmit="return addEmpFormValidation()" action="usermanagement.php" >

								<h3>Add Employee</h3>
								<hr>
								<h4>Personal Details</h4>
								<hr align="left" class="custom-hr">

								<div class="row">
									<div class="col-md-12">
										<span>Employee Id :</span>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<input type="text" class="form-control" name="empId" placeholder="105" disabled="true">
									</div>
								</div>

								<br>

								<div class="row">
									<div class="col-md-12">
										<span>Employee Name :</span>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<input type="text" class="form-control" name="empFirstName" placeholder="First Name">
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="empMiddleName" placeholder="Middle Name">
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="empLastName" placeholder="Last Name">
									</div>
								</div>

								<br>

								<div class="row">

									<div class="col-md-3">
										<div class="row">
											<div class="col-md-12">
												<span>Date Of Birth :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<input type="date" class="form-control" name="dOB">
											</div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<span>Gender :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="input-group mb-3">
													<select class="custom-select form-control" name="gender">
														<option selected>------Select------</option>
														<option value="male">Male</option>
														<option value="female">Female</option>
													</select>
												</div>
											</div>
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-md-12">
										<span>Father's Name :</span>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<input type="text" class="form-control" name="fatherName" placeholder="Fathers Name">
									</div>
								</div>

								<br>

								<div class="row">
									<div class="col-md-12">
										<span>Address :</span>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<input type="text" class="form-control" name="street" placeholder="Street">
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="city" placeholder="City">
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="state" placeholder="State">
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="pin" placeholder="Pin Code">
									</div>
								</div>

								<br>

								<div class="row">

									<div class="col-md-4">
										<div class="row">
											<div class="col-md-12">
												<span>Email Id :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<input type="text" class="form-control" name="emailId" placeholder="employeename@example.com">
											</div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
											<div class="col-md-6">
												<span>Mobile No. :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<input type="mobile" class="form-control" name="mobileHome" placeholder="Home" >
											</div>
											<div class="col-md-6">
												<input type="mobile" class="form-control" name="mobileWork" placeholder="Work" >
											</div>
										</div>
									</div>

								</div>




								<hr>
								<h4>Job Details</h4>
								<hr align="left" class="custom-hr">

								<div class="row">

									<div class="col-md-4">
										<div class="row">
											<div class="col-md-12">
												<span>Designation :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="input-group mb-3">
													<select class="custom-select form-control" id="designation">
														<option selected>------Select------</option>
														<option value="1">01 Floor Manager</option>
														<option value="2">02 Loom Worker</option>
													</select>
												</div>
											</div>
										</div>
									</div>


									<div class="col-md-4">
										<div class="row">
											<div class="col-md-12">
												<span>Shift :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="input-group mb-3">
													<select class="custom-select form-control" id="shift">
														<option selected>------Select------</option>
														<option value="1">01 Day</option>
														<option value="2">02 Night</option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="row">
											<div class="col-md-12">
												<span>Status :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="input-group mb-3">
													<select class="custom-select form-control" id="jobStatus">
														<option selected>------Select------</option>
														<option value="1">01 Working</option>
														<option value="2">02 Not Working</option>
													</select>
												</div>
											</div>
										</div>
									</div>

								</div>

								<br>

								<div class="row">

									<div class="col-md-4">
										<div class="row">
											<div class="col-md-12">
												<span>Date Of Joining :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-8">
												<input type="date" class="form-control" name="dOJ">
											</div>
										</div>
									</div>


									<div class="col-md-6">
										<div class="row">
											<div class="col-md-12">
												<span>Basic Pay :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<input type="text" class="form-control" name="basicPay">
											</div>
										</div>
									</div>

								</div>

								<br>

								<button type="submit" class="btn btn-info" name="addemp">Add Employee</button>
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
				&copy;  2014 Weavix.com | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.nathcorp.com</a>
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
