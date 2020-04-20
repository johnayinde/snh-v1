<?php
require_once("functions/alert.php");
include("lib/header.php");

if (!isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
	# redirect back to header
	header("Location: login.php");
}
?>
<style>
	.form-heading {
		font-size: 2.25em ;
	}
</style>
<div class="container ">
	<h1 class="display-4 text-center text-capitalize form-heading">Book An Appointment</h1>
	<p class="display-5 text-capitalize">All field are required</p>
</div>
<div class="container form-container">
	<form action="process-appointment.php" method="post">
		<p class="register_error">
			<?php print_alert(); ?>
		</p>
		<div class="form-group column">
			<label for="date" class="">Date</label>
			<input <?php
					if (isset($_SESSION['appointment_date'])) {
						echo "value=" . $_SESSION['appointment_date'];
					}
					?> class="form-control" type="date" id="date" name="appointment_date">
		</div>

		<div class="form-group column">
			<label for="time" class="col-12 col-form-label appointment_label">Time</label>
			<input <?php
					if (isset($_SESSION['appointment_time'])) {
						echo "value=" . $_SESSION['appointment_time'];
					}
					?> class="form-control" type="time" id="timet" name="appointment_time">
		</div>
		<div class="form-group column">
			<label for="nature" class="col-12 col-form-label">Nature of Appointment</label>
			<input <?php
					if (isset($_SESSION['appointment_nature'])) {
						echo "value=" . $_SESSION['appointment_nature'];
					}
					?> class="form-control" type="text" id="nature" name="appointment_nature">
		</div>
		<div class="form-group column">
			<label for="dept" class="col-12 col-form-label">Which department do you want to book an appointment?</label>
			<input <?php
					if (isset($_SESSION['appointment_department'])) {
						echo "value=" . $_SESSION['appointment_department'];
					}
					?> class="form-control" type="text" id="dept" name="appointment_department">
		</div>
		<div class="form-group column">
			<label for="complaint">Initial Complaint</label>
			<textarea <?php
						if (isset($_SESSION['initial_complaint'])) {
							echo "value=" . $_SESSION['initial_complaint'];
						}
						?> class="form-control" id="complaint" rows="6" name="initial_complaint"></textarea>
		</div>
		<button class="btn btn-sm btn-primary  text-uppercase font-weight-bold" type="submit">Book Appointment</button>
	</form>
</div>
<?php

include("lib/footer.php");
?>