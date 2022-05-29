<?php include ( "inc/connect.inc.php" ); ?>
<?php 

if (isset($_REQUEST['poid'])) {
	
	$poid = mysqli_real_escape_string( $con,$_REQUEST['poid']);
}else {
	header('location: index.php');
}
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
	header("location: login.php?ono=".$poid."");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}


$getposts = mysqli_query($con,"SELECT * FROM products WHERE id ='$poid'") or die(mysql_error());
					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						$category = $row['category'];
						$available =$row['available'];
					}	

//order

if (isset($_POST['order'])) {
//declere veriable
$mbl = $_POST['mobile'];
$addr = $_POST['address'];
$quan = $_POST['quantity'];
//triming name
	try {
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['address'])) {
			throw new Exception('Address can not be empty');
			
		}
		if(empty($_POST['quantity'])) {
			throw new Exception('Address can not be empty');
			
		}

		
		// Check if email already exists
		
		
						$d = date("Y-m-d"); //Year - Month - Day
						$timestamp = time();
						$date = strtotime("+7 day", $timestamp);
						$date = date('Y-m-d', $date);
						
						// send email
						$msg = "
						Assalamu Alaikum...
						Your Order successfull. Very soon we will send you a verification call.
						
						";
						//if (@mail($uemail_db,"eBuyBD Product Order",$msg, "From:eBuyBD <no-reply@ebuybd.xyz>")) {
							
						if(mysqli_query($con,"INSERT INTO orders (uid,pid,quantity,oplace,mobile,odate,ddate) VALUES ('$user','$poid',$quan,'$_POST[address]','$_POST[mobile]','$d','$date')")){

							//success message
						$success_message = '
						<div class="signupform_content"><h2><font face="bookman">Your order successfull!</font></h2>
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							We send you a verification <br> call very soon.
						</font></div></div>';
						}else{
							$error_message = 'Something goes wrong!';
						}
						//}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>

<?php include ( "inc/head.inc.php") ?>

<body>
	<?php include ( "inc/navbar.inc.php") ?>
	<div class="container mt-4 mx-auto d-flex justify-content-evenly">
		<div>
			<h2 style="padding-bottom: 20px;">Order Form</h2>
			<form method="POST">
				
				<div class="form-floating mb-2">
					<input name="mobile" placeholder="Your mobile number" class="form-control" id="mobile" type="tel" value=<?= $umob_db?>  required>
					<label for="mobile">Mobile Number</label>
				</div>

				<div class="form-floating mb-2">
					<input name="address" id="address" placeholder="Write your full address" class="form-control" type="text" value=<?=$uadd_db?>  required >
					<label for="address">Address</label>
				</div>

				<div class="mb-2">
					<select onchange="changeAmount()" name="quantity" required id="productAmount" 
					 class="form-control">
					<?php for ($i=1; $i<=$available; $i++) { 
							echo '<option  value="'.$i.'">Quantity: '.$i.'</option>';}?>
					</select>
				</div>
				<div class="form-check d-flex justify-content-center mb-3">
					<input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required />
					<label class="form-check-label" for="form2Example3">
						I agree all statements in <a href="#!">Terms & Conditions</a>
					</label>
				</div>
				<div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
					<button type="submit" name="order" class="btn btn-primary btn-lg">Confirm Order</button>
				</div>
			</form>
		</div>
		<div>
			<?php
				echo '
				<div class="home-product-card">
					<a href="'.$category.'/view_product.php?pid='.$id.'">
						<img src="image/product/'.$item.'/'.$picture.'" class="home-product-img">
					</a>
					<div style="text-align: center; padding: 0 0 6px 0;"> 
					<span style="font-size: 15px;">'.$pName.'</span>
					<br> Price: Rs<span id="amountText">'.$price.'</span> 
					<span id="aHiddenText" style="display:none">'.$price.'</span></div>
				</div>
				';
			?>
		</div>
	</div>
	<script type="text/javascript">
		function changeAmount() {
			var v = document.getElementById("aHiddenText").innerHTML;
			document.getElementById("amountText").innerHTML = v;
			var sBox = document.getElementById("productAmount");
			var y = sBox.value;
			var x = document.getElementById("amountText").innerHTML;
			var y = parseInt(y);
			var x = parseInt(x);
			document.getElementById("amountText").innerHTML = x + "x" + y + " = " + x * y;
		}
	</script>
</body>

</html>