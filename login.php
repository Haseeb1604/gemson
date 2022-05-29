<?php include ( "inc/connect.inc.php" ); ?>
<?php session_start(); ?>
<?php
if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}
$emails = "";
$passs = "";

if (isset($_POST['login'])) {
	if (isset($_POST['email']) && isset($_POST['password'])) {
		// escapes special characters in a string for use in an SQL query
		$user_login = mysqli_real_escape_string($con,$_POST['email']);
		// Convert Email to lowercase
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
		// escapes special characters in a string for use in an SQL query
		$password_login = mysqli_real_escape_string($con, $_POST['password']);		
		$num = 0;
		// Encrypt using md5
		$password_login_md5 = md5($password_login);

		$result = mysqli_query($con, "SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_md5' AND activation='yes'");
		
		// Rows count
		$num = mysqli_num_rows($result);
		if ($num>0) {
			$get_user_email = mysqli_fetch_assoc($result);
			$get_user_uname_db = $get_user_email['id'];

			$_SESSION['user_login'] = $get_user_uname_db;
			setcookie('user_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			
			if (isset($_REQUEST['ono'])) {
				$ono = mysqli_real_escape_string($con,$_REQUEST['ono']);
				header("location: orderform.php?poid=".$ono."");
			}else {
				header('location: index.php');
			}
			exit();
		}
		else {
			$result1 = mysqli_query($con, "SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_md5' AND activation='no'");
			$num1 = mysqli_num_rows($result1);
			if ($num1>0) {
				$get_user_email1 = mysqli_fetch_assoc($result1);
				$get_user_uname_db1 = $get_user_email1['id'];
				$emails = $user_login;
				$activacc ='';
			}else {
				$emails = $user_login;
				$passs = $password_login;
				$error_message = '<br><br>
					<div class="maincontent_text" style="text-align: center; font-size: 18px;">
					<font face="bookman">Email or Password incorrect.<br>
					</font></div>';
			}
			
		}
	}

}
$acemails = "";
$acccode = "";
if(isset($_POST['activate'])){
	if(isset($_POST['actcode'])){
		
		$user_login = mysqli_real_escape_string($con,$_POST['acemail']);
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
		$user_acccode = mysqli_real_escape_string($con,$_POST['actcode']);
		$result2 = mysqli_query($con, "SELECT * FROM user WHERE (email='$user_login') AND confirmCode='$user_acccode'");
		$num3 = mysqli_num_rows($result2);
		echo $user_login;
		if ($num3>0) {
			$get_user_email = mysqli_fetch_assoc($result2);
			$get_user_uname_db = $get_user_email['id'];
			$_SESSION['user_login'] = $get_user_uname_db;
			setcookie('user_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			mysqli_query($con, "UPDATE user SET confirmCode='0', activation='yes' WHERE email='$user_login'");
			if (isset($_REQUEST['ono'])) {
				$ono = mysqli_real_escape_string($con,$_REQUEST['ono']);
				header("location: orderform.php?poid=".$ono."");
			}else {
				header('location: index.php');
			}
			exit();
		}else {
			$emails = $user_login;
			$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Code not matched!<br>
				</font></div>';
		}
	}else {
		$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Activation code not matched!<br>
				</font></div>';
	}

}

?>
<?php include ( "inc/head.inc.php")?>
<body>
<?php include ( "inc/navbar.inc.php" ); ?>
<section>
	<div class="container py-5 h-100">
		<?php include ( "inc/message.inc.php" ); ?>
		<div class="row d-flex align-items-center justify-content-center h-100">
			<div class="col-md-8 col-lg-7 col-xl-6">
				<img src="./image/login.svg" class="img-fluid" alt="Phone image">
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
					<input class="form-check-input" name="remember" type="checkbox" value="" id="remember" checked />
					<label class="form-check-label" for="form1Example3"> Remember me </label>
					</div>
					<a href="#!">Forgot password?</a>
				</div>

				<!-- Submit button -->
				<button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Sign in</button>
			</form>
			</div>
		</div>
	</div>
</section>

<?php include ( "inc/foot.inc.php" ); ?>
