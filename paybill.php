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

	// header("Location: dashboard.php");

}
?>

<h1 class="display-4 text-center text-capitalize">Make Payment</h1>
<style>
	.container {
		width: 500px;
	}
</style>

<div class="container">
	<form action="processpayment.php" method="post">
		<h5>
			<?php print_alert(); ?>
		</h5>

		<div class=" form-group">
			<label>Full Name</label><br>
			<input <?php
						if (isset($_SESSION['full_Name'])) {
							echo "value=" . $_SESSION['full_Name'];
						}
						?> type="text" class="form-control" name="full_Name" placeholder="Full Name">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input <?php
						if (isset($_SESSION['email'])) {
							echo "value=" . $_SESSION['email'];
						}
						?> type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Amount</label>
			<input type="number" name="amount" value="5000" readonly class="form-control" id="exampleInputPassword1" placeholder="Amount">
		</div>

		<button type="submit" class="btn btn-primary" name="pay">PAY</button>

	
	</form>
</div>

<?php include("lib/footer.php") ?>