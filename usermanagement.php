<?php include('server.php'); ?>

<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");
}

if (isset($_GET['edit'])) {
	
	$id = $_GET['edit'];

	$getEmpInfoToEdit = "select * from emp_info where Emp_Id='$id';";

	$resultsToEdit = mysqli_query($db, $getEmpInfoToEdit);

	$row1 = mysqli_fetch_array($resultsToEdit);

}

?>



<!DOCTYPE html>
<html>
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
		if(!(/^[/^[a-zA-Z]+$/.test(addempform.empFirstName.value)))
			{
				window.alert("You have entered an invalid first name!");
				return false;
			}

		if (lastname.value == "") {
			window.alert("Please enter last name.");
			lastname.focus();
			return false;
		}
		if(!(/^[/^[a-zA-Z]+$/.test(addempform.empLastName.value)))
			{
				window.alert("You have entered an invalid last name!");
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
		if(!(/^[/^[a-zA-Z]+$/.test(addempform.fatherName.value)))
			{
				window.alert("You have entered an invalid father's name!");
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
		if(!(/^[/^[a-zA-Z]+$/.test(addempform.city.value)))
			{
				window.alert("You have entered an invalid city!");
				return false;
			}
		if (state.value == "") {
			window.alert("Please enter state.");
			state.focus();
			return false;
		}
		if(!(/^[/^[a-zA-Z]+$/.test(addempform.state.value)))
			{
				window.alert("You have entered an invalid state!");
				return false;
			}
		if (pin.value == "") {
			window.alert("Please enter pin.");
			pin.focus();
			return false;
		}
		if(!(/^\d{6}$/.test(addempform.pin.value)))
			{
				window.alert("You have entered an invalid pin!");
				return false;
			}


		if (email.value == "") {
			window.alert("Please enter email id.");
			email.focus();
			return false;
		}

		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(addempform.emailId.value)))
		{
			window.alert("You have entered an invalid email address!");
			return false;
		} 

		if (mobilehome.value == "" && mobilework.value == "") {
			window.alert("Please enter atleast one mobile number.");
			mobilehome.focus();
			return false;
		}
		if(!(/^\d{10}$/.test(addempform.mobileHome.value)))
			{
				window.alert("You have entered an invalid mobileHome!");
				return false;
			}
			if(!(/^\d{10}$/.test(addempform.mobileWork.value)))
			{
				window.alert("You have entered an invalid mobileWork!");
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
		if(!(/^\d{1,6}(?:\.\d{0,2})?$/.test(addempform.basicPay.value)))
			{
				window.alert("You have entered an invalid basicpay");
				return false;
			}




		

	}

	var getQueryString = function ( field, url ) {
		var href = url ? url : window.location.href;
		var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
		var string = reg.exec(href);
		return string ? string[1] : null;
	};

	
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
						<li class="active" id="li1"><a data-toggle="tab" href="#emplist">Employees</a></li>
						<li id="li2" class=""><a data-toggle="tab" href="#addemp">Add Employee</a></li>
					</ul>

					<div class="tab-content">


						<div id="emplist" class="tab-pane fade in active">
							<h3>Employee List</h3>
							<hr>

							<?php if(count($errors2) >0) : ?>
							<div class="error">
								<?php foreach($errors2 as $error) : ?>
									<strong><p><?php echo $error; ?></p></strong>
								<?php endforeach ?>
							</div>
						<?php endif ?>

						<?php if(count($info2) > 0) : ?>
							<div class="info">
								<?php foreach($info2 as $i) : ?>
									<strong><p><?php echo $i; ?></p></strong>
								<?php endforeach ?>
							</div>
						<?php endif ?>

							<table class="table table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Designation</th>
										<th>Shift</th>
										<th>Mobile</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$getempquery = "Select * from emp_info;";

									if ($results = mysqli_query($db, $getempquery)) {
										while ($row = mysqli_fetch_assoc($results)) {
											echo '<tr><td>'.$row['First_Name'].' '.$row['Last_Name'].'</td><td>'.$row['Designation'].'</td><td>'.$row['Shift'].'</td><td>'.$row['Mobile_Work'].'</td><td>'.$row['Status'].'</td><td><a href="usermanagement.php?tab=2&edit='.$row['Emp_Id'].'">Edit</a> | <a href="usermanagement.php?delete='.$row['Emp_Id'].'">Delete</a></td></tr>';
										}
									}
									?>
								</tbody>
							</table>

						</div>



						<div id="addemp" class="tab-pane fade in">
							<form name="addempform" method="post" onsubmit="return addEmpFormValidation()" action="usermanagement.php?tab=2" >

								<h3>Add Employee</h3>
								<hr>

								<?php if(count($info) > 0) : ?>
									<div class="info">
										<?php foreach ($info as $i) : ?>
											<strong><p><?php echo $i ?></p><strong>
											<?php endforeach ?>
										</div>
										<hr>
									<?php endif ?>

									<?php if(count($errors) > 0) : ?>
										<div class="error">
											<?php foreach ($errors as $i) : ?>
												<strong><p><?php echo $i ?></p><strong>
												<?php endforeach ?>
											</div>
											<hr>
										<?php endif ?>

										<h4>Personal Details</h4>
										<hr align="left" class="custom-hr">

										<div class="row">
											<div class="col-md-12">
												<span>Employee Id :</span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-3">
												<input type="text" class="form-control" name="empId"
												<?php if ($row1 != null) : ?>
													value="<?php echo $row1['Emp_Id'];?>"
													<?php else : ?>
														placeholder="Employee Id"
													<?php endif ?>
													readonly>
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
													<input type="text" class="form-control" name="empFirstName" 
													<?php if ($row1 != null) : ?>
														value="<?php echo $row1['First_Name'];?>"
														<?php else : ?>
															placeholder="First Name"
														<?php endif ?>
														>
													</div>
													<div class="col-md-3">
														<input type="text" class="form-control" name="empMiddleName" 
														<?php if ($row1 != null) : ?>
															value="<?php echo $row1['Middle_Name'];?>"
															<?php else : ?>
																placeholder="Middle Name"
															<?php endif ?>
															>
														</div>
														<div class="col-md-3">
															<input type="text" class="form-control" name="empLastName"
															<?php if ($row1 != null) : ?>
																value="<?php echo $row1['Last_Name'];?>"
																<?php else : ?>
																	placeholder="Last Name"
																<?php endif ?>
																>
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
																		<input type="date" class="form-control" name="dOB" value="<?php echo $row1['DOB'];?>">
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
																				<?php if($row1 == null) : echo 'selected'; ?>
																				<option selected value="">------Select------</option>
																				<?php else : ?>
																				<option value="">------Select------</option>
																				<?php endif ?>
																				
																				<?php if($row1['Gender'] == 'male') : ?>
																				<option selected value="male">Male</option>
																				<?php else : ?>
																				<option value="male">Male</option>
																				<?php endif ?>

																				<?php if($row1['Gender'] == 'female') : ?>
																				<option selected value="female">Female</option>
																				<?php else : ?>
																				<option value="female">Female</option>
																				<?php endif ?>
																			</select>
																		</div>
																	</div>
																</div>
															</div>

														</div>

														<br>

														<div class="row">
															<div class="col-md-12">
																<span>Father's Name :</span>
															</div>
														</div>

														<div class="row">
															<div class="col-md-4">
																<input type="text" class="form-control" name="fatherName" 
																<?php if ($row1 != null) : ?>
																	value="<?php echo $row1['Father_name'];?>"
																	<?php else : ?>
																		placeholder="Father's Name"
																	<?php endif ?>
																	>
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
																	<input type="text" class="form-control" name="street" 
																	<?php if ($row1 != null) : ?>
																		value="<?php echo $row1['Street'];?>"
																		<?php else : ?>
																			placeholder="Street"
																		<?php endif ?>
																		>
																	</div>
																	<div class="col-md-3">
																		<input type="text" class="form-control" name="city" 
																		<?php if ($row1 != null) : ?>
																			value="<?php echo $row1['City'];?>"
																			<?php else : ?>
																				placeholder="City"
																			<?php endif ?>
																			>
																		</div>
																		<div class="col-md-3">
																			<input type="text" class="form-control" name="state"
																			<?php if ($row1 != null) : ?>
																				value="<?php echo $row1['State'];?>"
																				<?php else : ?>
																					placeholder="State"
																				<?php endif ?>
																				>
																			</div>
																			<div class="col-md-3">
																				<input type="text" class="form-control" name="pin" 
																				<?php if ($row1 != null) : ?>
																					value="<?php echo $row1['Pin'];?>"
																					<?php else : ?>
																						placeholder="Pin Code"
																					<?php endif ?>
																					>
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
																							<input type="text" class="form-control" name="emailId" 
																							<?php if ($row1 != null) : ?>
																								value="<?php echo $row1['Email'];?>"
																								<?php else : ?>
																									placeholder="employeename@example.com"
																								<?php endif ?>
																								>
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
																								<input type="mobile" class="form-control" name="mobileHome" 
																								<?php if ($row1 != null) : ?>
																									value="<?php echo $row1['Mobile_Home'];?>"
																									<?php else : ?>
																										placeholder="Home"
																									<?php endif ?>
																									>
																								</div>
																								<div class="col-md-6">
																									<input type="mobile" class="form-control" name="mobileWork" 
																									<?php if ($row1 != null) : ?>
																										value="<?php echo $row1['Mobile_Work'];?>"
																										<?php else : ?>
																											placeholder="Work"
																										<?php endif ?>
																										>
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
																											<select class="custom-select form-control" name="designation">
																												<?php if($row1 == null) : echo 'selected'; ?>
																												<option selected value="">------Select------</option>
																												<?php else : ?>
																												<option value="">------Select------</option>
																												<?php endif ?>
																												<?php if($row1['Designation'] == 'Floor Manager') : echo 'selected'; ?>
																												<option selected value="Floor Manager">01 Floor Manager</option>
																												<?php else : ?>
																												<option value="Floor Manager">01 Floor Manager</option>
																												<?php endif ?>
																												<?php if($row1['Designation'] == 'Loom Worker') : echo 'selected'; ?>
																												<option selected value="Loom Worker">02 Loom Worker</option>
																												<?php else : ?>
																												<option value="Loom Worker">02 Loom Worker</option>
																												<?php endif ?>

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
																											<select class="custom-select form-control" name="shift">
																												
																												<?php if($row1 == null) : echo 'selected'; ?>
																													<option selected value="">------Select------</option>
																													<?php else : ?>
																													<option value="">------Select------</option>
																												<?php endif ?>
																												  
																												<?php if($row1['Shift'] == 'Day') : echo 'selected'; ?>
																												<option selected value="Day">01 Day</option>
																												<?php else: ?>
																												<option value="Day">01 Day</option>
																												<?php endif ?>
																												 
																												<?php if($row1['Shift'] == 'Night') : echo 'selected'; ?>
																												<option selected value="Night">02 Night</option>
																												<?php else : ?>
																												<option value="Night">02 Night</option>
																												<?php endif ?>
																												
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
																											<select class="custom-select form-control" name="jobStatus">
																												<option selected value="">------Select------</option>
																												
																												<?php if($row1['Status'] == 'Working') : echo 'selected'; ?>
																												<option selected value="Working">01 Working</option>
																												<?php else : ?>
																												<option value="Working">01 Working</option>
																												<?php endif ?>
																												
																												<?php if($row1['Status'] == 'Not Working') : echo 'selected'; ?>
																												<option selected value="Not Working">02 Not Working</option>
																												<?php else : ?>
																												<option value="Not Working">02 Not Working</option>
																												<?php endif ?>
																												
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
																										<input type="date" class="form-control" value="<?php echo $row1['DOJ'];?>" name="dOJ">
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
																										<input type="text" class="form-control" name="basicPay"
																										<?php if ($row1 != null) : ?>
																											value="<?php echo $row1['Basic_Pay'];?>"
																										<?php endif ?>
																										>
																									</div>
																								</div>
																							</div>

																						</div>

																						<br>

																						<button type="submit" class="btn btn-info" id="btnadd" name="addemp">Add Employee</button>
																						<button type="submit" class="btn btn-info" id="btnedit" name="editemp">Update</button>
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

															<script type="text/javascript">
																var getQueryString = function ( field, url ) {
																	var href = url ? url : window.location.href;
																	var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
																	var string = reg.exec(href);
																	return string ? string[1] : null;
																};

																var tab = getQueryString('tab');
																var edit = getQueryString('edit');

																if (tab == '2') {
																	document.getElementById("li1").classList.remove('active');
																	document.getElementById("emplist").classList.remove('active');
																	document.getElementById("li2").classList.add('active');
																	document.getElementById("addemp").classList.add('active');
																}

																if (edit != null) {
																	document.getElementById('btnadd').style.visibility = 'hidden';
																} else {
																	document.getElementById('btnedit').style.visibility = 'hidden';
																}
															</script>

														</body>
														</html>
