<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<!--===============================================================================================-->
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/login_util.css">
	<link rel="stylesheet" type="text/css" href="css/login_main.css">
	<!--===============================================================================================-->
</head>

<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image:url(images/bgg.png);">
			
			<div class="wrap-login100" style="background-image:url(images/sub.png);
			box-shadow:0 0 15px 15px rgba(0,0,0, 0.6); ">
			
			<img src="images/ad.png" style="margin-left:10px">
			
			<form class="login100-form validate-form" method="POST" action="login.php"  >
				<span class="login100-form-title">
					<!--<img src="images/ad.png"> -->
				</span>

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input class="input100" type="text" name="adminId" placeholder="  Admin Id">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<img src="images/admin.png" style="height:30px; width:30px;">
					</span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Password is required">
					<input class="input100" type="password" name="pass" placeholder="  Admin Password">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<img src="images/pass.png" style="height:30px; width:30px;">
					</span>
				</div>
				
				<div class="container-login100-form-btn">
					<button class="login100-form-btn" type="submit" name="btn_login">
						Login
					</button>
				</div>
				<?php  if (count($errors) > 0) : ?>
					<div class="error">
						<?php foreach ($errors as $error) : ?>
							<p><?php echo $error ?></p>
						<?php endforeach ?>
					</div>
				<?php  endif ?>

				<div class="text-center p-t-12">
					<span class="txt1">
						Forgot
					</span>
					<a class="txt2" href="#">
						Username / Password?
					</a>
				</div>
				
			</form>
		</div>
	</div>
</div>

</body>
</html>