<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['admin_login'];
	$result = mysqli_query($con,"SELECT * FROM admin WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
$search_value = "";
?>
<?php include ( "inc/head.inc.php" ) ?>
<body>
	<?php include ( "inc/navbar.inc.php") ?>
	<div class="showcase">
		<div class="container-lg">
			<div class="showcase-content">
				<h1 class="text-1">Welcome To Admin Panel</h1>
				<h2 class="text-2">You have all permition to do!</h2>
			</div>
		</div>
	</div>
<?php include ( "inc/foot.inc.php" )?>