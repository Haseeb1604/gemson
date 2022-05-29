<?php 
		if(isset($success_message)) {echo $success_message;}
			else {
				echo ''?>
<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 26px;">
	<div class="container">
		<div>
			<div>
				<div class="signupform_content">
					<h2>Sign Up Form!</h2>
					<div class="signupform_text"></div>
					<div>
						<form action="" method="POST" class="registration">
							<div class="signup_form">
								<div>
									<td>
										<input name="first_name" id="first_name" placeholder="First Name"
											required="required" class="first_name signupbox" type="text" size="30"
											value="'.$u_fname.'">
									</td>
								</div>
								<div>
									<td>
										<input name="last_name" id="last_name" placeholder="Last Name"
											required="required" class="last_name signupbox" type="text" size="30"
											value="'.$u_lname.'">
									</td>
								</div>
								<div>
									<td>
										<input name="email" placeholder="Enter Your Email" required="required"
											class="email signupbox" type="email" size="30" value="'.$u_email.'">
									</td>
								</div>
								<div>
									<td>
										<input name="mobile" placeholder="Enter Your Mobile" required="required"
											class="email signupbox" type="text" size="30" value="'.$u_mobile.'">
									</td>
								</div>
								<div>
									<td>
										<input name="signupaddress" placeholder="Write Your Full Address"
											required="required" class="email signupbox" type="text" size="30"
											value="'.$u_address.'">
									</td>
								</div>
								<div>
									<td>
										<input name="password" id="password-1" required="required"
											placeholder="Enter New Password" class="password signupbox " type="password"
											size="30" value="'.$u_pass.'">
									</td>
								</div>
								<div>
									<input name="signup" class="uisignupbutton signupbutton" type="submit"
										value="Sign Me Up!">
								</div>
								<div class="signup_error_msg">';

									if (isset($error_message)) {echo $error_message;}


								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>