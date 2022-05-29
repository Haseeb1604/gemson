<?php include ( "inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con, "SELECT * FROM user WHERE id='$user'");
	$get_user_email = mysqli_fetch_assoc($result);
	$uname_db = $get_user_email['firstName'];
}
?>
<?php include ( "inc/head.inc.php" ); ?>
<body>
	<?php include ( "inc/navbar.inc.php" ); ?>
	<section class="showcase about">
		<div class="container-lg">
			<div class="showcase-content">
				<h1 class="text-1">About Gemsone</h1>
				<h2 class="text-2">Largest Online Gemstones Shopping in Pakistan</h2>
			</div>
		</div>
	</section>
<script> document.querySelector(".nav-item .about").classList.add("active") </script>
<?php include ( "inc/foot.inc.php") ?>