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
	<section class="container card py-5 px-5 my-5 ">
		<h2>Who we're</h2>
		<p>
		Gemson is specialist in all types of Gemstones. Extensive choice of classic to contemporary rings in all precious metals, including all types of gemstones. Perfect for gifts, we are stockists of Pakistani Mens Rings, Pakistani Gemstones, Thai Gemstones, Pearl Jewellery, beads, bracelet, necklaces, rings, earrings and cufflinks. We also deal in all Gemstone – Rough and Faceted. We are Retail Company based in Pakistan.
		</p>
	</section>
<script> document.querySelector(".nav-item .about").classList.add("active") </script>
<?php include ( "inc/foot.inc.php") ?>