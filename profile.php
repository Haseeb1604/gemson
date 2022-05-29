<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con, "SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}

if (isset($_REQUEST['uid'])) {
	
	$user2 = mysqli_real_escape_string($con, $_REQUEST['uid']);
	if($user != $user2){
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

$search_value = "";
?>
<?php include ( "inc/head.inc.php" ); ?>

<body style="background-image: #eee;">
	<?php include ( "inc/navbar.inc.php") ?>
	<div class="profile-title big-title mt-4">
		<h1 class="title text-center">Orders</h1>
	</div>
	<?php include ( "inc/message.inc.php" ); ?>
	<div style="margin: 20px auto 0;"  class="row profile">
			<div class="col-lg-2 col-md-2">
				<div class="btn-group-vertical">
					<?php echo '<a href="profile.php?uid='.$user.'" class="btn btn-primary px-5 py-3" >My Orders</a>'; ?>
					<?php echo '<a href="settings.php?uid='.$user.'" class="btn btn-outline-primary px-5 py-3">Settings</a>'; ?>
				</div>
			</div>
			<div class="col-lg-10 col-md-10">
				<table class="table table-responsive-sm">
					<thead class="table-dark">
						<tr style="font-weight: bold;">
							<th>Product Name</th>
							<th>Price</th>
							<th>Total Product</th>
							<th>Order Date</th>
							<th>Delevery Date</th>
							<th>Delevery Place</th>
							<th>Delevery Status</th>
							<th>View</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						<?php include ( "inc/connect.inc.php");
								$query = "SELECT * FROM orders WHERE uid='$user' ORDER BY id DESC";
								$run = mysqli_query($con, $query);
								while ($row=mysqli_fetch_assoc($run)) {
									$pid = $row['pid'];
									$quantity = $row['quantity'];
									$oplace = $row['oplace'];
									$mobile = $row['mobile'];
									$odate = $row['odate'];
									$ddate = $row['ddate'];
									$dstatus = $row['dstatus'];
									
									//get product info
									$query1 = "SELECT * FROM products WHERE id='$pid'";
									$run1 = mysqli_query($con, $query1);
									$row1=mysqli_fetch_assoc($run1);
									$pId = $row1['id'];
									$pName = substr($row1['pName'], 0,50);
									$price = $row1['price'];
									$picture = $row1['picture'];
									$item = $row1['item'];
									$category = $row1['category'];
									?>
						<th><?php echo $pName; ?></th>
						<th><?php echo $price; ?></th>
						<th><?php echo $quantity; ?></th>
						<th><?php echo $odate; ?></th>
						<th><?php echo $ddate; ?></th>
						<th><?php echo $oplace; ?></th>
						<th><?php echo $dstatus; ?></th>
						<th><?php echo '<div class="home-prodlist-img"><a href="'.$category.'/view_product.php?pid='.$pId.'">
												<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
												</a>
											</div>' ?></th>
					</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
	</div>
	<?php include ( "inc/foot.inc.php") ?>