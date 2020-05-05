<?php include("lib/header.php");
require_once("functions/alert.php");


if (!isset($_SESSION['loggedIn'])) {
	# redirect back to header
	header("Location: login.php");
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

		<div class="form-group">
		<label>Payment Option</label><br>
            <select class="form-control" name="payment_option">
                <option  value="">Select one</option>
                <option <?php

                        if (isset($_SESSION['payment_option']) && $_SESSION['payment_option'] == "card") {
                            echo "selected";
                        }

                        ?> value="card">Card Payment</option>
                <option <?php

                        if (isset($_SESSION['payment_option']) && $_SESSION['payment_option'] == 'account') {
                            echo "selected";
                        }
                        ?> value="account">Account Payment</option>

            </select>
		</div>

		<button type="submit" class="btn btn-primary" name="pay">PAY</button>

	
	</form>
</div>

<?php include("lib/footer.php") ?>