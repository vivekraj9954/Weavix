<?php 
session_start();

if (isset($_SESSION['username'])) {
	header('location: dashboard.php');
}


?>

<?php include('server.php') ?>

<html>
<head>
	<title>Weavix Login</title>		
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="icon" type="image/png" href="images/log.png" />

</head>

<body>
	
	<div class>
		<div class="login1" style="background-image:url(images/bg.png);">
			
			<!--<div class="wrap-login100" style="background-color:#326985;">-->
				<div class="login2" style="background-image:url(images/sub.jpg);">

					<img src="images/ad.png" style="margin-bottom:10px">


					<form  method="POST" action="login.php"  >

						<div class="w-inputB">	

							<input class="inputB" type="text" name="adminId" placeholder="  Admin Id">			
							<span class="s-inputB">
								<img src="images/admin.png" style="height:30px; width:30px;">
							</span>	

						</div>


						<div class="w-inputB">	

							<input class="inputB" type="password" name="pass" placeholder="  Admin Password">		
							<span class="s-inputB">
								<img src="images/pass.png" style="height:30px; width:30px;">
							</span>

						</div>

						<div>
							<button class="button" type="submit" name="btn_login">
								LOGIN
							</button>
						</div>

					</form>


				</div>
			</div>
		</div>

		<script type="text/javascript">
			var getQueryString = function ( field, url ) {
				var href = url ? url : window.location.href;
				var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
				var string = reg.exec(href);
				return string ? string[1] : null;
			};

			var error = getQueryString('error');

			if (error == '1') {
				window.alert("Wrong username or password.");
			}
		</script>

	</body>
	</html>