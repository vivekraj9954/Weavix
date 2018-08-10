<?php

$errors = array();
$errors2 = array();
$info = array();
$info2 = array();

$row1 = array();


$db = mysqli_connect("localhost", "root", "", "weavix");


################################################################
# usermanagement.php code
################################################################

# Add emp data
#####################################

if (isset($_POST['addemp'])) {

	$firstname = $_POST['empFirstName'];
	$middlename = $_POST['empMiddleName'];
	$lastname = $_POST['empLastName'];
	$dob = $_POST['dOB'];
	$gender = $_POST['gender'];
	$fathername = $_POST['fatherName'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$pin = $_POST['pin'];
	$email = $_POST['emailId'];
	$mobwork = $_POST['mobileHome'];
	$mobhome = $_POST['mobileWork'];
	$designation = $_POST['designation'];
	$shift = $_POST['shift'];
	$status = $_POST['jobStatus'];
	$doj = $_POST['dOJ'];
	$basicpay = $_POST['basicPay'];

	$queryinsertemp = "INSERT INTO `emp_info` (`Emp_Id`, `First_Name`, `Middle_Name`, `Last_Name`, `DOB`, `Gender`, `Father_name`, `Street`, `City`, `State`, `Pin`, `Email`, `Mobile_Work`, `Mobile_Home`, `Designation`, `Shift`, `Status`, `DOJ`, `Basic_Pay`) VALUES (NULL, '$firstname', '$middlename', '$lastname', '$dob', '$gender', '$fathername', '$street', '$city', '$state', '$pin', '$email', '$mobwork', '$mobhome', '$designation', '$shift', '$status', '$doj', '$basicpay');";

	$result = mysqli_query($db, $queryinsertemp);

	if ($result) {
		array_push($info, "Employee Added Successfully..!");
	} else {
		array_push($errors, "Could not add employee due to some technical issues.");
	}

}

#edit emp code
#################################

if (isset($_POST['editemp'])) {
	$empid = $_POST['empId'];
	$firstname = $_POST['empFirstName'];
	$middlename = $_POST['empMiddleName'];
	$lastname = $_POST['empLastName'];
	$dob = $_POST['dOB'];
	$gender = $_POST['gender'];
	$fathername = $_POST['fatherName'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$pin = $_POST['pin'];
	$email = $_POST['emailId'];
	$mobwork = $_POST['mobileHome'];
	$mobhome = $_POST['mobileWork'];
	$designation = $_POST['designation'];
	$shift = $_POST['shift'];
	$status = $_POST['jobStatus'];
	$doj = $_POST['dOJ'];
	$basicpay = $_POST['basicPay'];

	$queryUpdateEmp = "call speditempinfo ('$empid', '$firstname', '$middlename', '$lastname', '$dob', '$gender', '$fathername', '$street', '$city', '$state', '$pin', '$email', '$mobwork', '$mobhome', '$designation', '$shift', '$status', '$doj', '$basicpay');";

	$result = mysqli_query($db, $queryUpdateEmp);

	if ($result) {
		array_push($info, "Updated Successfully..!");
	} else {
		array_push($errors, "Could not update due to some technical issues.");
	}
}

#delete emp
#############################

if (isset($_GET['delete'])) {
	
	$idtodelete = $_GET['delete'];

	$queryDeleteEmp = "DELETE FROM emp_info WHERE Emp_Id = '$idtodelete';";

	$resultempdeleted = mysqli_query($db, $queryDeleteEmp);
	if ($resultempdeleted) {
		array_push($info2, "Record deleted.");
	} else {
		array_push($errors2, "Could not delete due to some technical issue.");
	}

}

########################################################
# login page code
########################################################

if (isset($_POST['btn_login'])) {
	# code for login admin

	$username = $_POST['adminId'];
	$password = $_POST['pass'];

	$query = "SELECT * FROM userlogin WHERE user_Name='$username' AND pass_word='$password'";
	$results = mysqli_query($db, $query);

	if (mysqli_num_rows($results) == 1) {
		$_SESSION['username'] = $username;
		header('location: dashboard.php');
	}else {
		array_push($errors, "Wrong username/password combination");
	}
}

####################
# production code
####################

# Loom Start code
##################################

if (isset($_POST['startloombtn'])) {

	$loomno = $_POST['loomno'];
	$empno = $_POST['empno'];
	$clothtype = $_POST['clothtype'];
	$startreading = $_POST['startreading'];
	$shift = $_POST['shift'];

	# check if the loom is already occupied

	$checkIfLoomExists = "SELECT * FROM loom_status_temp WHERE Loom_No='$loomno'";

	$result = mysqli_query($db, $checkIfLoomExists);

	if(mysqli_num_rows($result) == 1){
		array_push($errors, "Loom is already occupied.");
	} else {

		$loomstartquery = "call spLoomStart('$loomno', '$empno', '$clothtype', '$startreading', '$shift');";

		$resultinsert = mysqli_query($db, $loomstartquery);
		if ($resultinsert) {
			array_push($info, 'Loom '.$loomno.' started');
		} else {
			array_push($errors, "Could not update data due to some technical issues.");
		}

	}
}

#loom stop code
##########################################

if (isset($_POST['loomstopbtn'])) {
	
	$loomtostop = $_POST['loomnostop'];
	$stopread = $_POST['stopread'];

	#check if the loom is vacant

	$checkIfLoomDoesNotExists = "SELECT * FROM loom_status_temp WHERE Loom_No='$loomtostop'";



	$deleteLoomFromLoomTempTable = "DELETE FROM loom_status_temp WHERE Loom_No = '$loomtostop'";

	$result = mysqli_query($db, $checkIfLoomDoesNotExists);

	if (mysqli_num_rows($result) == 1) {

		$updateloomquery = "call spLoomStop('$loomtostop', '$stopread');";

		if (mysqli_query($db, $updateloomquery)) {
			array_push($info2, "Loom $loomtostop is stopped");
		} else {
			array_push($errors2, "There was a technical issue. Unable to update the stop record.");
		}

		
	} else {
		array_push($errors2, "The loom is already vacant");
	}

}








?>