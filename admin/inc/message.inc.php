<?php if (isset($error_message) && $error_message !=""){
			echo '<div class="mt-2 alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
			<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
				<use xlink:href="#exclamation-triangle-fill"/>
			</svg>
			'.$error_message.'
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
		} elseif (isset($success_message) && $success_message!=""){
			echo '<div class="mt-2 alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
			<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
				<use xlink:href="#check-circle-fill"/>
			</svg>
			'.$success_message.'
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
		} ?>