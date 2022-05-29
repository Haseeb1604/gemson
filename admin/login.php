<?php include ( "../inc/connect.inc.php" ); ?>

<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
}
else {
	header("location: index.php");
}

if (isset($_POST['login'])) {
	if (isset($_POST['email']) && isset($_POST['password'])) {
		$user_login = mysqli_real_escape_string( $con,$_POST['email']);
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
		$password_login = mysqli_real_escape_string( $con,$_POST['password']);		
		$num = 0;
		$password_login_md5 = md5($password_login);
		$result = mysqli_query($con,"SELECT * FROM admin WHERE (email='$user_login') AND password='$password_login_md5'");
		$num = mysqli_num_rows($result);
		$get_user_email = mysqli_fetch_assoc($result);
			$get_user_uname_db = $get_user_email['id'];
		if ($num>0) {
			$_SESSION['admin_login'] = $get_user_uname_db;
			setcookie('admin_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			header('location: index.php');
			exit();
		}
		else {
			$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Username or Password incorrect.<br>
				</font></div>';	
		}
	}

}

$search_value = "";

?>
<?php include ( "inc/head.inc.php" )?>

<body>
	<?php include ( "inc/navbar.inc.php") ?>
	<section class="mb-3">
		<div class="container py-5 h-100">
			<?php include ( "../inc/message.inc.php" ); ?>
			<div class="row d-flex align-items-center justify-content-center h-100">
				<div class="col-md-8 col-lg-7 col-xl-6">
					<img src="../image/login.svg" class="img-fluid" alt="Phone image">
				</div>
				<div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
					<form method="POST">
						<!-- Email input -->
						<div class="form-outline mb-4">
							<input type="email" name="email" id="email" class="form-control form-control-lg" />
							<label class="form-label" for="form1Example13">Email address</label>
						</div>

						<!-- Password input -->
						<div class="form-outline mb-4">
							<input type="password" name="password" id="password" class="form-control form-control-lg" />
							<label class="form-label" for="form1Example23">Password</label>
						</div>

						<div class="d-flex justify-content-between align-items-center mb-4">
							<!-- Checkbox -->
							<div class="form-check">
								<input class="form-check-input" name="remember" type="checkbox" value="" id="remember"
									checked />
								<label class="form-check-label" for="form1Example3"> Remember me </label>
							</div>
							<a href="#!">Forgot password?</a>
						</div>

						<!-- Login button -->
						<button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Sign in</button>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php include ( "../inc/foot.inc.php" );?>