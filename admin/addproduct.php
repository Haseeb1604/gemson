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
$pname = "";
$price = "";
$available = "";
$category = "";
$type = "";
$item = "";
$pCode = "";
$descri = "";

if (isset($_POST['signup'])) {
//declere veriable
$pname = $_POST['pname'];
$price = $_POST['price'];
$available = $_POST['available'];
$category = $_POST['category'];
$type = $_POST['type'];
$item = $_POST['item'];
$pCode = $_POST['code'];
$descri = $_POST['descri'];
//triming name
$_POST['pname'] = trim($_POST['pname']);

//finding file extention
$profile_pic_name = @$_FILES['profilepic']['name'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 1000000)) {

	$item = $item;
	if (file_exists("../image/product/$item")) {
		//nothing
	}else {
		mkdir("../image/product/$item");
	}
	
	
	$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

	if (file_exists("../image/product/$item/".$filename)) {
		echo @$_FILES["profilepic"]["name"]."Already exists";
	}else {
		if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "../image/product/$item/".$filename)){
			$photos = $filename;
			$result = mysqli_query($con,"INSERT INTO products(pName,price,description,available,category,type,item,pCode,picture) VALUES ('$_POST[pname]','$_POST[price]','$_POST[descri]','$_POST[available]','$_POST[category]','$_POST[type]','$_POST[item]','$_POST[code]','$photos')");
				header("Location: allproducts.php");
		}else {
			echo "Something Worng on upload!!!";
		}
		//echo "Uploaded and stored in: userdata/profile_pics/$item/".@$_FILES["profilepic"]["name"];
		
		
	}
	}
	else {
		$error_message = 'Add picture!';
	}
}
$search_value = "";

?>

<?php include ( "inc/head.inc.php")?>

<body class="bg-dark text-white">
	<?php include ( "inc/navbar.inc.php") ?>

	<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 20px;">
		<?php include ( "inc/message.inc.php") ?>
		<div class="container">
			<div>
				<div>
					<div class="signupform_content">
						<h2>Add Product Form!</h2>
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration" enctype="multipart/form-data">
								<div class="signup_form">
									<div>

										<input name="pname" id="first_name" placeholder="Product Name"
											required="required" class="first_name signupbox" type="text" size="30"
											value=<?=$pname?>>

									</div>
									<div>

										<input name="price" id="last_name" placeholder="Price" required="required"
											class="last_name signupbox" type="text" size="30" value=<?=$price?>>

									</div>
									<div>

										<input name="available" placeholder="Available Quantity" required="required"
											class="email signupbox" type="text" size="30" value=<?=$available?>>

									</div>
									<div>

										<input name="descri" id="first_name" placeholder="Description"
											required="required" class="first_name signupbox" type="text" size="30"
											value=<?=$descri?>>

									</div>
									<div>

										<select name="category" required="required"
											style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;"
											class="">
											<option selected value="gems">gents</option>
										</select>

									</div>
									<div>
										<select name="type" required="required"
											style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;"
											class="">
											<option selected value="wearing">wearing</option>
											<option value="other">Other</option>
										</select>
									</div>
									<div>

										<select name="item" required="required"
											style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;"
											class="">
											<option selected value="Diamonds">Diamonds</option>
											<option value="Imitation">Imitation</option>
											<option value="Inorganic">Inorganic Gems</option>
											<option value="organic">Organic</option>
										</select>

									</div>
									<div>

										<input name="code" id="password-1" required="required" placeholder="Code"
											class="password signupbox " type="text" size="30" value=<?=$pCode?>>

									</div>
									<div>

										<input name="profilepic" class="password signupbox" type="file" value="Add Pic">

									</div>
									<div>
										<input name="signup" class="uisignupbutton signupbutton" type="submit"
											value="Add Product">
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php include ( "inc/foot.inc.php" )?>