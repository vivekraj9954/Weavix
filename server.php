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
		header('location: login.php?error=1');
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

	# check if the loom is already occupied

	$checkIfLoomExists = "SELECT * FROM loom_status_temp WHERE Loom_No='$loomno'";
	$checkIfEmpExists = "SELECT * FROM loom_status_temp WHERE Emp_Id='$empno'";

	$result = mysqli_query($db, $checkIfLoomExists);
	$result2 = mysqli_query($db, $checkIfEmpExists);

	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		array_push($errors, 'Loom is already occupied by an employee with Employee ID : '.$row['Emp_Id']);
	} else if (mysqli_num_rows($result2) == 1) {
		$row = mysqli_fetch_assoc($result2);
		array_push($errors, 'Employee is already working on Loom No. : '.$row['Loom_No']);
	} else {

		$loomstartquery = "call spLoomStart('$loomno', '$empno', '$clothtype', '$startreading');";

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

	$result = mysqli_query($db, $checkIfLoomDoesNotExists);

	if (mysqli_num_rows($result) == 1) {

		$updateloomquery = "call spLoomStop('$loomtostop', '$stopread');";

		if (mysqli_query($db, $updateloomquery)) {
			array_push($info2, "Loom $loomtostop is stopped");
		} else {
			array_push($errors2, "There was a technical issue. Unable to update the stop record.");
		}

	#get data from temp table
	################################
	$gettempdata = "SELECT * FROM loom_status_temp WHERE Loom_No='$loomtostop';";

	$r1 = mysqli_query($db, $gettempdata);

	$rowtempdata = mysqli_fetch_assoc($r1);

	$empid = $rowtempdata['Emp_Id'];
	$startread = $rowtempdata['Start_Reading'];
	$stopread = $rowtempdata['Stop_Reading'];
	$clothtype = $rowtempdata['Cloth_Type'];
	$shift = $rowtempdata['Shift'];

	$readdiff = $stopread - $startread;

	#update employee_wise_prod
	######################################

	$getempdata = "SELECT * FROM employee_wise_prod WHERE Employee_Id='$empid';";

	$r2 = mysqli_query($db, $getempdata);

	$rowemp = mysqli_fetch_assoc($r2);

	$newcottonprod = $rowemp['Cotton']+$readdiff;
	$newnylonprod = $rowemp['Nylon']+$readdiff;
	$newsilkprod = $rowemp['Silk']+$readdiff;
	$newtotalprod = $rowemp['Total_Production']+$readdiff;
	$newdayprod = $rowemp['Day_Shift']+$readdiff;
	$newnightprod = $rowemp['Night_Shift']+$readdiff;

	$updateEmpProdQuery = "";

	if ($clothtype == 'Cotton') {
		
		if ($shift == 'Day') {
			
			$updateEmpProdQuery = "UPDATE employee_wise_prod SET Cotton='$newcottonprod',Total_Production='$newtotalprod',Day_Shift='$newdayprod' WHERE Employee_Id='$empid';";

		} elseif ($shift == 'Night') {
			$updateEmpProdQuery = "UPDATE employee_wise_prod SET Cotton='$newcottonprod',Total_Production='$newtotalprod',Night_Shift='$newnightprod' WHERE Employee_Id='$empid';";
		}

	} elseif ($clothtype == 'Nylon') {
		
		if ($shift == 'Day') {
			$updateEmpProdQuery = "UPDATE employee_wise_prod SET Nylon='$newnylonprod',Total_Production='$newtotalprod',Day_Shift='$newdayprod' WHERE Employee_Id='$empid';";
		} elseif ($shift == 'Night') {
			$updateEmpProdQuery = "UPDATE employee_wise_prod SET Nylon='$newnylonprod',Total_Production='$newtotalprod',Night_Shift='$newnightprod' WHERE Employee_Id='$empid';";
		}

	} elseif ($clothtype == 'Silk') {
		
		if ($shift == 'Day') {
			$updateEmpProdQuery = "UPDATE employee_wise_prod SET Silk='$newsilkprod',Total_Production='$newtotalprod',Day_Shift='$newdayprod' WHERE Employee_Id='$empid';";
		} elseif ($shift == 'Night') {
			$updateEmpProdQuery = "UPDATE employee_wise_prod SET Silk='$newsilkprod',Total_Production='$newtotalprod',Night_Shift='$newnightprod' WHERE Employee_Id='$empid';";
		}

	}

	$r3 = mysqli_query($db,$updateEmpProdQuery);

	

	#update production_loom
	######################################

	$getloomdata = "SELECT * FROM production_loom WHERE Loom_No='$loomtostop';";

	$r4 = mysqli_query($db, $getloomdata);

	$rowloom = mysqli_fetch_assoc($r4);

	$newcottonprod = $rowloom['Cotton']+$readdiff;
	$newnylonprod = $rowloom['Nylon']+$readdiff;
	$newsilkprod = $rowloom['Silk']+$readdiff;
	$newtotalprod = $rowloom['Production_Total']+$readdiff;
	$newdayprod = $rowloom['Day']+$readdiff;
	$newnightprod = $rowloom['Night']+$readdiff;
	$marking = $_POST['stopread'];

	$updateLoomProdQuery = "";

	if ($clothtype == 'Cotton') {
		
		if ($shift == 'Day') {
			
			$updateLoomProdQuery = "UPDATE production_loom SET Cotton='$newcottonprod',Production_Total='$newtotalprod',Day='$newdayprod', Marking='$marking' WHERE Loom_No='$loomtostop';";

		} elseif ($shift == 'Night') {
			$updateLoomProdQuery = "UPDATE production_loom SET Cotton='$newcottonprod',Production_Total='$newtotalprod',Night='$newnightprod', Marking='$marking' WHERE Loom_No='$loomtostop';";
		}

	} elseif ($clothtype == 'Nylon') {
		
		if ($shift == 'Day') {
			$updateLoomProdQuery = "UPDATE production_loom SET Nylon='$newnylonprod',Production_Total='$newtotalprod',Day='$newdayprod', Marking='$marking' WHERE Loom_No='$loomtostop';";
		} elseif ($shift == 'Night') {
			$updateLoomProdQuery = "UPDATE production_loom SET Nylon='$newnylonprod',Production_Total='$newtotalprod',Night='$newnightprod', Marking='$marking' WHERE Loom_No='$loomtostop';";
		}

	} elseif ($clothtype == 'Silk') {
		
		if ($shift == 'Day') {
			$updateLoomProdQuery = "UPDATE production_loom SET Silk='$newsilkprod',Production_Total='$newtotalprod',Day='$newdayprod', Marking='$marking' WHERE Loom_No='$loomtostop';";
		} elseif ($shift == 'Night') {
			$updateLoomProdQuery = "UPDATE production_loom SET Silk='$newsilkprod',Production_Total='$newtotalprod',Night='$newnightprod', Marking='$marking' WHERE Loom_No='$loomtostop';";
		}

	}

	$r5 = mysqli_query($db,$updateLoomProdQuery);

	if ($r5) {
		array_push($info2, "Data Commited. ");
	} else {
		array_push($errors2, "Sorry there was a technical issue.");
	}

	#delete loom status form loom_status_temp table
	###################################################################

	$deletequery = "DELETE from loom_status_temp where Loom_No='$loomtostop'";

	mysqli_query($db, $deletequery);

	} else {
		array_push($errors2, "The loom is already vacant");
	}

}
?>