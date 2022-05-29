<?php 
if (!isset($_SESSION['user_login'])) {
	$user = "";
}else {
	$user = $_SESSION['user_login'];
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Gemsone</a>

        <form class="d-flex newsearch me-auto" id="newsearch" method="get" action="./search.php">
            <input type="text" class="srcinput" name="keywords" size="21" maxlength="120" placeholder="Search Here...">
            <input type="submit" value="search" class="srcbtn">
        </form>
        <div class="btn-group justify-content-center ms-3 " role="group">
                <div class="loginBtn">
                    <?php 
                    if ($user!="") {
							echo '<a class="btn" href="profile.php?uid='.$user.'">Profile</a>';
						}
						else {
							echo '<a class="btn" href="login.php">LOG IN</a>';
						}
					 ?>
                </div>
                <div class="SignupBtn">
                    <?php  
                    if ($user!="") {
							echo '<a class="btn" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a class="btn" href="signin.php">SIGN IN</a>';
						}
					 ?>
                </div>
            </div>
    </div>
</nav>
<nav class="navbar-bottom navbar navbar-dark bg-dark justify-content-center">
    <ul class="d-flex">
        <li class="nav-link"><a href="index.php">Home</a></li>
        <li class="nav-link"><a href="addproduct.php">Add Product</a></li>
        <li class="nav-link"><a href="allproducts.php">All Products</a></li>
        <li class="nav-link"><a href="orders.php">Orders</a></li>
    </ul>
</nav>