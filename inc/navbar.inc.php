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

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="line line1"></div>
            <div class="line line2"></div>
            <div class="line line3"></div>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link home" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link about" href="about.php">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a href="gems/saree.php" class="dropdown-item">Saree</a>
                        </li>
                        <li><a href="gems/ornament.php" class="dropdown-item">Ornament</a>
                        </li>
                        <li><a href="gems/watch.php" class="dropdown-item">Watch</a>
                        </li>
                        <li><a href="gems/perfume.php" class="dropdown-item">Perfume</a>
                        </li>
                        <li><a href="gems/hijab.php" class="dropdown-item">Hijab</a>
                        </li>
                        <li><a href="gems/tshirt.php" class="dropdown-item">T-Shirt</a>
                        </li>
                        <li><a href="gems/footwear.php" class="dropdown-item">FootWear</a>
                        </li>
                        <li><a href="gems/toilatry.php" class="dropdown-item">Toilatry</a>
                        </li>
                        <li><a href="gems/view_product.php" class="dropdown-item">View Product</a>
                        </li>
                    </ul>
                </li>
            </ul>
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
    </div>
</nav>