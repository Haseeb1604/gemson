<div class="">
	<div class="signupform_text"></div>
	<div>
		<form action="" method="POST" class="registration">
			<div class="signup_form" style="    margin-top: 38px;">
				<div>
					<td>
						<input name="mobile" placeholder="Your mobile number" required="required"
							class="email signupbox" type="text" size="30" value="'.$umob_db.'">
					</td>
				</div>
				<div>
					<td>
						<input name="address" id="password-1" required="required" placeholder="Write your full address"
							class="password signupbox " type="text" size="30" value="'.$uadd_db.'">
					</td>
				</div>
				<div>
					<td>
						<select onchange="changeAmount()" name="quantity" required="required" id="productAmount"
							style=" font-size: 20px;
									font-style: italic; margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;"
							class="">';