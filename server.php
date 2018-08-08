<?php

session_start();

$errors = array();
$errors2 = array();
$info = array();


$db = mysqli_connect("192.168.0.174", "Vivek", "9qsuYWgPaAdrJRv7", "weavix", "3306");

# usermanagement.php code

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
	$designation = $_POST['empFirstName'];
	$shift = $_POST['empFirstName'];
	$status = $_POST['empFirstName'];
	$doj = $_POST['empFirstName'];
	$basicpay = $_POST['empFirstName'];

	$queryinsertemp = "INSERT INTO `emp_info` (`Emp_Id`, `First_Name`, `Middle_Name`, `Last_Name`, `DOB`, `Gender`, `Father_name`, `Street`, `City`, `State`, `Pin`, `Email`, `Mobile_Work`, `Mobile_Home`, `Designation`, `Shift`, `Status`, `DOJ`, `Basic_Pay`) VALUES (NULL, '$firstname', '$middlename', '$lastname', '$dob', '$gender', '$fathername', '$street', '$city', '$state', '$pin', '$email', '$mobwork', '$mobhome', '$designation', '$shift', '$status', '$doj', '$basicpay');";

	$result = mysqli_query($db, $queryinsertemp);

	if ($result) {
		array_push($info, "Employee Added Successfully..!");
	}

}

# login page code

if (isset($_POST['btn_login'])) {
	# code for login admin

	$username = $_POST['adminId'];
	$password = $_POST['pass'];

	$query = "SELECT * FROM UserLogin WHERE user_Name='$username' AND pass_word='$password'";
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

if (isset($_POST['startloombtn'])) {

	$loomno = $_POST['loomno'];
	$empno = $_POST['empno'];
	$clothtype = $_POST['clothtype'];
	$starttime = $_POST['starttime'];
	$startreading = $_POST['startreading'];
	$shift = $_POST['shift'];

	# check if the loom is already occupied

	$checkIfLoomExists = "SELECT * FROM loom_status_temp WHERE Loom_No='$loomno'";

	$result = mysqli_query($db, $checkIfLoomExists);

	if(mysqli_num_rows($result) == 1){
		array_push($errors, "Loom is already occupied.");
	} else {

		$loomstartquery = "INSERT INTO `loom_status_temp` (`Loom_No`, `Emp_Id`, `Cloth_Type`, `Start_Time`, `Start_Reading`, `Stop_Time`, `Stop_Reading`, `Shift`) VALUES ('$loomno', '$empno', '$clothtype', '$starttime', '$startreading', NULL, NULL, '$shift');";

		mysqli_query($db, $loomstartquery);
	}
}

#loom stop code

if (isset($_POST['loomstopbtn'])) {
	
	$loomtostop = $_POST['loomnostop'];
	$stopread = $_POST['stopread'];
	$stoptime = $_POST['stoptime'];

	#check if the loom is vacant

	$checkIfLoomDoesNotExists = "SELECT * FROM loom_status_temp WHERE Loom_No='$loomtostop'";

	$result = mysqli_query($db, $checkIfLoomDoesNotExists);

	if (mysqli_num_rows($result) == 1) {

		$updateloomquery = "UPDATE loom_status_temp SET Stop_Time='$stoptime' ,Stop_Reading='$stopread' WHERE `Loom_No`='$loomtostop'";

		mysqli_query($db, $updateloomquery);

		
	} else {
		array_push($errors2, "The loom is already vacant");
	}

}



?>