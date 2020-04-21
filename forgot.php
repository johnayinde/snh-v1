<?php include("lib/header.php");
require_once("functions/alert.php");

?>


<div class="container">
	<form action="processForgot.php" method="post">

		<h5>
			<?php print_alert(); ?>
		</h5>
		<h1 class="display-4 text-center text-capitalize">Forgot your password</h1>
		<p>Enter your email address associated to your account</p>
		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input <?php
							if (isset($_SESSION['email'])) {
								echo "value=" . $_SESSION['email'];
							}
							?> type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>


<?php include("lib/footer.php") ?>