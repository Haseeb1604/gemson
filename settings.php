<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];
			$upass = $get_user_email['password'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}

if (isset($_REQUEST['uid'])) {
	
	$user2 = mysqli_real_escape_string( $con,$_REQUEST['uid']);
	if($user != $user2){
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

if (isset($_POST['changesettings'])) {
//declere veriable
$email = $_POST['email'];
$opass = $_POST['opass'];
$npass = $_POST['npass'];
$npass1 = $_POST['npass1'];
//triming name
	try {
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');		
		}
			if(isset($opass) && isset($npass) && isset($npass1) && ($opass != "" && $npass != "" && $npass1 != "")){
				if( md5($opass) == $upass){
					if($npass == $npass1){
						$npass = md5($npass);
						mysqli_query($con,"UPDATE user SET password='$npass' WHERE id='$user'");
						$success_message = '
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							Password changed.
						</font></div>';
					}else {
					$success_message = '
						<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
						<font face="bookman">
							New password not matched!
						</font></div>';
					}
				}else {
				$success_message = '
					<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
					<font face="bookman">
						Fillup password field exactly.
					</font></div>';
				}
			}else {
				$success_message = '
					<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
					<font face="bookman">
						Fillup password field exactly.
					</font></div>';
				}

			if($uemail_db != $email) {
				if(mysqli_query($con,"UPDATE user SET  email='$email' WHERE id='$user'")){
					//success message
					$success_message = '
					<div class="signupform_text" style="font-size: 18px; text-align: center;">
					<font face="bookman">
						Settings change successfull.
					</font></div>';
				}
			}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}
?>

<?php include ( "inc/head.inc.php") ?>
<body>
	<?php include ( "inc/navbar.inc.php" ); ?>
	<div class="profile-title mt-4">
		<h1 class="title text-center">Settings</h1>
	</div>
	<?php include ( "inc/message.inc.php" ); ?>
	<div style="margin: 20px auto 0;"  class="row profile">
			<div class="col-lg-2 col-md-2">
				<div class="btn-group-vertical">
					<?php echo '<a href="profile.php?uid='.$user.'" class="btn btn-outline-primary px-5 py-3" >My Orders</a>'; ?>
					<?php echo '<a href="settings.php?uid='.$user.'" class="btn btn-primary px-5 py-3">Settings</a>'; ?>
				</div>
			</div>
			<div class="col-lg-10 col-md-10 row">
				<form method="POST" class="registration col-md-6 col-sm-12">
					<h4>Change Email:</h4>
					<div class="form-floating mb-3">
						<?php echo '<input class="form-control" required type="email" name="email" placeholder="New Email Address" id="email" value="'.$uemail_db.'">'; ?>
						<label for="email">New Email address</label>
					</div>
					<h4>Change Password:</h4>
					<div class="form-floating">
						<input  class="form-control" type="password" name="opass" placeholder="Old Password" id="oldpassword">
						<label for="oldpassword">Old Password</label>
					</div>
					<div class="form-floating">
						<input  class="form-control" type="password" name="npass" placeholder="New Password" id="newpassword">
						<label for="newpassword">New Password</label>
					</div>
					<div class="form-floating">
						<input  class="form-control" type="password" name="npass1" placeholder="Repeat Password" id="newpassword1">
						<label for="newpassword1">Repeat Password</label>
					</div>
					<input class="btn btn-primary mt-3 px-3 py-2" type="submit" name="changesettings" value="Update Settings">
				</form>
				<form method="POST" class="registration col-md-6 col-sm-12">
					<h4>Change Phone:</h4>
					<div class="form-floating mb-3">
						<?php echo '<input class="form-control" required type="tel" name="tel" placeholder="New Phone Number" id="phone" value="'.$umob_db.'">'; ?>
						<label for="phone">New Email address</label>
					</div>
					<h4>Details:</h4>
					<div class="form-floating">
						<input  class="form-control" type="text" name="first_name" placeholder="First Name" id="FirstName">
						<label for="FirstName">First Name</label>
					</div>
					<div class="form-floating">
						<input  class="form-control" type="text" name="last_name" placeholder="Last Name" id="LastName">
						<label for="LastName">Last Name</label>
					</div>
					<div class="form-floating">
						<input  class="form-control" type="text" name="address" placeholder="Address" id="address">
						<label for="address">Address</label>
					</div>
					<input class="btn btn-primary mt-3 px-3 py-2" type="submit" name="changesettings2" value="Update Settings">
				</form>
			</div>
	</div>	
</body>
</html>