<?php include ( "inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}

if (isset($_REQUEST['keywords'])) {

	$epid = mysqli_real_escape_string( $con,$_REQUEST['keywords']);
	if($epid != "" && ctype_alnum($epid)){
		
	}else {
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

$search_value = "";
$search_value = trim($_GET['keywords']);

?>

<?php include ("./inc/head.inc.php") ?>
<body>
	<?php include ( "inc/navbar.inc.php" ); ?>
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
	<div>
		<?php 
			if (isset($_GET['keywords']) && $_GET['keywords'] != ""){
				$search_value = trim($_GET['keywords']);
				$getposts = mysqli_query($con,"SELECT * FROM products WHERE pName like '%$search_value%'  ORDER BY id DESC") or die(mysql_error());
					if ( $total = mysqli_num_rows($getposts)) {
					echo '<div style="text-align: center;"> '.$total.' Products Found... </div><br>';
					echo "<div class='d-flex flex-wrap-reverse flex-row-reverse justify-content-evenly'>";
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						
						echo '
							<div class="search-product">
								<a href="gems/view_product.php?pid='.$id.'">
									<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
								</a>
								<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: Rs '.$price.' </div>
							</div>
						';
						}
					echo "</div>";	
				}else {
				echo "Nothing Found!";
			}
			}else {
				echo "Input Someting...";
			}
			
		?>
			
		</div>
	</div>
</body>
</html>