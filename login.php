<?php include("lib/header.php");
require_once("functions/alert.php");


if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
	if ($_SESSION['designation'] == 'Super Admin (SA)') {
		header("Location: super-admin.php");
	} else if ($_SESSION['designation'] == 'Medical Team (MT)') {
		header("Location: medical-team.php");
	} else if ($_SESSION['designation'] == 'Patient') {
		header("Location: patient.php");
	}

}
?>

<h1 class="display-4 text-center text-capitalize">Login page</h1>
<style>
	.container {
		width: 500px;
	}
</style>

<div class="container">
	<form action="processlogin.php" method="post">
		<h5>
			<?php print_alert(); ?>
		</h5>
		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input <?php
							if (isset($_SESSION['email'])) {
								echo "value=" . $_SESSION['email'];
							}
							?> type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>

		<p>
			<a href="forgot.php">Forgot Password</a><br />
			<a href="register.php">Don't have an account? Register</a>
		</p>
	</form>
</div>

<?php include("lib/footer.php") ?>