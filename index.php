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
	<section class="showcase home">
		<div class="container-lg">
			<div class="showcase-content">
				<h1 class="text-1">Welcome To Gemsone</h1>
				<h2 class="text-2">Largest Online Gemstones Shopping in Pakistan</h2>
			</div>
		</div>
	</section>
	<div class="home-prodlist mt-5">
		<div>
			<h3 style="text-align: center; mt-4">Products Category</h3>
		</div>
		<div style="padding: 20px 30px; width: 85%; margin: 0 auto;" class="d-flex justify-content-evenly flex-wrap">
			<div class="home-product-card">
				<a href="gems/saree.php">
					<img src="./image/product/saree/new-designer-fancy-look-attractive-saree-2-original.jpg" class="home-product-img">
				</a>
			</div>
			<div class="home-product-card"><a href="gems/perfume.php">
					<img src="./image/product/perfume/Most-Popular-Perfumes-for-women10.png" class="home-product-img">
				</a>
			</div>
			<div class="home-product-card"><a href="gems/hijab.php">
					<img src="./image/product/saree/hijab 1.png" class="home-product-img"></a>
			</div>
			<div class="home-product-card"><a href="gems/toilatry.php">
					<img src="./image/product/beauty/toiletries.png" class="home-product-img"></a>
			</div>
			<div class="home-product-card"><a href="gems/footwear.php">
					<img src="./image/product/footwear/footwear1.png" class="home-product-img"></a>
			</div>
			<div class="home-product-card"><a href="gems/tshirt.php">
					<img src="./image/product/saree/tshirts1.png" class="home-product-img"></a>
			</div>
			<div class="home-product-card"><a href="gems/watch.php">
					<img src="./image/product/watch/watches1.png" class="home-product-img"></a>
			</div>
			<div class="home-product-card"><a href="gems/ornament.php">
					<img src="./image/product/ornament/earrings1.png" class="home-product-img"></a>
			</div>
		</div>

<script>
			document.querySelector(".nav-item .home").classList.add("active")
		</script>
<?php include ( "inc/foot.inc.php") ?>