<?php
session_start();
include '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | Admin</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="login.css">
	<link rel="stylesheet" href="http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="post" action="" class="login100-form validate-form">
					<span class="login100-form-title p-b-48">
						<!-- <i class="zmdi zmdi-font"></i> -->
					<center><img src="../assets/img/2.jpg" width="230"> <center>
					</span>
					<span class="login100-form-title p-b-26">
						<center>SMA ABC<center>
					</span>
					


					<div class="username">
	
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

				
				</form>

									<?php 
									if ($_SERVER['REQUEST_METHOD']=='POST') {
									$pass= sha1($_POST['password']);
									$sqlCek = mysqli_query($con,"SELECT * FROM tb_admin WHERE username='$_POST[username]' AND password='$pass' AND aktif='Y'");
									$jml = mysqli_num_rows($sqlCek);
									$d = mysqli_fetch_array($sqlCek);
									
									if ($jml > 0) {
									$_SESSION['admin']= $d['id_admin'];
									
									
									echo "
									<script type='text/javascript'>
									setTimeout(function () { 
									
									swal('(Administrator) ', 'Login berhasil', {
									icon : 'success',
									buttons: {        			
									confirm: {
									className : 'btn btn-success'
									}
									},
									});    
									},10);  
									window.setTimeout(function(){ 
									window.location.replace('./dashboard.php');
									} ,3000);   
									</script>";
									
									
									
									
									}else{
									echo "
									<script type='text/javascript'>
									setTimeout(function () { 
									
									swal('Sorry!', 'Username / Password Salah', {
									icon : 'error',
									buttons: {        			
									confirm: {
									className : 'btn btn-danger'
									}
									},
									});    
									},10);  
									window.setTimeout(function(){ 
									window.location.replace('index.php');
									} ,3000);   
									</script>";
									}
									}
									?>
			</div>
		</div>
	</div>

</body>
</html>