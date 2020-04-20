<p>
	<a href="index.php">HOME </a> |
	<?php if (!isset($_SESSION['loggedIn'])) { ?>

		<a href="login.php">LOGIN </a> |
		<a href="register.php">REGISTER </a> |
	<?php } else { ?>

		<?php if ($_SESSION['role'] == 'Super Admin (SA)') { ?>
			<a href="super-admin.php">Dashboard</a>|
		<?php } else if ($_SESSION['role'] == 'Medical Team (MT)') { ?>
			<a href="medical-team.php">Dashboard</a> |
		<?php } else if ($_SESSION['role'] == 'Patient') { ?>
			<a href="patient.php">Dashboard</a>|
		<?php } ?>
		<a href="reset.php">Reset Password</a> |
			<a href="logout.php">Logout</a>
		<?php } ?>

</p>
<script src="./css/bootstrap.min.js"></script><!-- BootStrap JavaScript  -->

</body>

</html>