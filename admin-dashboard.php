<?php include("lib/header.php");

if (!isset($_SESSION['loggedIn'])) {
	# redirect back to header
	header("Location: login.php");
}
?>
<h1>Admin Dashboard</h1>

<a href="add-users.php">Add Users </a>




<?php include("lib/footer.php"); ?>