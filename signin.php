<?php include ( "inc/connect.inc.php" ); ?>
<?php
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}

$u_fname = "";
$u_lname = "";
$u_email = "";
$u_mobile = "";
$u_address = "";
$u_pass = "";

if (isset($_POST['signup'])) {
//declere veriable
$u_fname = $_POST['first_name'];
$u_lname = $_POST['last_name'];
$u_email = $_POST['email'];
$u_mobile = $_POST['mobile'];
$u_address = $_POST['signupaddress'];
$u_pass = $_POST['password'];
//triming name
$_POST['first_name'] = trim($_POST['first_name']);
$_POST['last_name'] = trim($_POST['last_name']);
	try {
		if(empty($_POST['first_name'])) {
			throw new Exception('Fullname can not be empty');
		}
		if (is_numeric($_POST['first_name'][0])) {
			throw new Exception('Please write your correct name!');
		}
		if(empty($_POST['last_name'])) {
			throw new Exception('Lastname can not be empty');
		}
		if (is_numeric($_POST['last_name'][0])) {
			throw new Exception('lastname first character must be a letter!');
		}
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
			
		}
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['password'])) {
			throw new Exception('Password can not be empty');
			
		}
		if(empty($_POST['signupaddress'])) {
			throw new Exception('Address can not be empty');
			
		}
		// Check if email already exists
		$check = 0;
		$e_check = mysqli_query($con,"SELECT email FROM `user` WHERE email='$u_email'");
		$email_check = mysqli_num_rows($e_check);
		if (strlen($_POST['first_name']) >2 && strlen($_POST['first_name']) <16 ) {
			if ($check == 0 ) {
				if ($email_check == 0) {
					if (strlen($_POST['password']) >1 ) {
						$d = date("Y-m-d"); //Year - Month - Day
						$_POST['first_name'] = ucwords($_POST['first_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['email'] = mb_convert_case($u_email, MB_CASE_LOWER, "UTF-8");
						$_POST['password'] = md5($_POST['password']);
						$confirmCode   = substr( rand() * 900000 + 100000, 0, 6 );
						// send email
						$msg = "
						Assalamu Alaikum...
						
						Your activation code: ".$confirmCode."
						Signup email: ".$_POST['email']."
						
						";
						if (@mail($_POST['email'],"Gemson Activation Code",$msg, "From:haseeb <no-reply@gemson.com>")) {
							
						$result = mysql_query("INSERT INTO user (firstName,lastName,email,mobile,address,password,confirmCode) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[mobile]','$_POST[signupaddress]','$_POST[password]','$confirmCode')");
						
						//success message
						$success_message = '
						<div class="signupform_content"><h2><font face="bookman">Registration successfull!</font></h2>
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							Email: '.$u_email.'<br>
							Activation code sent to your email. <br>
							Your activation code: '.$confirmCode.'
						</font></div></div>';
						}else {
							throw new Exception('Email is not valid!');
						}
						
						
					}else {
						throw new Exception('Make strong password!');
					}
				}else {
					throw new Exception('Email already taken!');
				}
			}else {
				throw new Exception('Username already taken!');
			}
		}else {
			throw new Exception('Firstname must be 2-15 characters!');
		}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>
<?php include ( "inc/head.inc.php" ); ?>

<body>
	<?php include ( "inc/navbar.inc.php" ); ?>

	<section>
		<div class="container pb-5">
		<?php include ( "inc/message.inc.php" ); ?>
			<div class="row d-flex align-items-center justify-content-center h-100">
				<div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
					
					<p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-4">Sign up</p>
					
					<form class="mx-1 mx-md-4 registration" method="POST">
						<div class="d-flex flex-row align-items-center mb-2">
							<div class="form-floating me-1">
								<input type="text" name="first_name" class="form-control" id="fName" placeholder="First Name" required>
								<label for="fName">First Name</label>
							</div>
							<div class="form-floating ms-1">
								<input type="text" name="last_name" class="form-control" id="lName" placeholder="First Name" required>
								<label for="lName">Last Name</label>
							</div>
						</div>

						<div class="form-floating mb-2">
							<input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
							<label for="email">Email address</label>
						</div>

						<div class="form-floating mb-2">
							<input type="tel" name="mobile" class="form-control" id="phone" placeholder="phone" required>
							<label for="phone">Phone Number</label>
						</div>

						<div class="form-floating mb-2">
							<input type="texting" name="signupaddress" class="form-control" id="signupaddress" placeholder="Address" required>
							<label for="signupaddress">Address</label>
						</div>

						<div class="form-floating mb-2">
							<input type="password" name="password" class="form-control" id="password" placeholder="password" required>
							<label for="password">Password</label>
						</div>

						<div class="form-check d-flex justify-content-center mb-3">
							<input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required />
							<label class="form-check-label" for="form2Example3">
								I agree all statements in <a href="#!">Terms of service</a>
							</label>
						</div>

						<div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
							<button type="submit" name="signup" class="btn btn-primary btn-lg">Register</button>
						</div>
					</form>
				</div>
				<div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
					<img src="./image/signup.webp" class="img-fluid" height="100%" alt="Signup Image">
				</div>
			</div>
		</div>
	</section>
	<?php include ( "inc/foot.inc.php" );?>