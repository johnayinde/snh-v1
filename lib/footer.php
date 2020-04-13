<p>
	<a href="index.php">HOME </a> |
	<?php if (!isset($_SESSION['loggedIn'])) { ?>

		<a href="login.php">LOGIN </a> |
		<a href="register.php">REGISTER </a> |
		<a href="forgot.php">FORGOT</a>
	<?php } else { ?>
		<a href="dashboard.php">Dashboard</a>
		<a href="logout.php">LOGOUT</a>
		
	<?php } ?>

</p>

</body>

</html>