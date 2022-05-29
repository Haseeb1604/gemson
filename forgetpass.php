<?php include ( "inc/head.inc.php" ); ?>

<body>
	<?php include ( "inc/navbar.inc.php") ?>
	<div class="container px-5 mt-5">
		<div class="container w-50 mx-auto">
			<h2 class="px-5 mb-3">Find Account!</h2>
			<form method="POST" class="px-5">
				<!-- Email input -->
				<div class="form-outline mb-3">
					<input type="text" name="username" class="form-control" placeholder="Write Gemson Email..." required autofocus>
				</div>
				<input class="form-control btn btn-primary" type="submit" name="searchId" id="senddata"
						value="Search">
			</form>
		</div>
	</div>
<?php include ( "inc/foot.inc.php" ) ?>