<?php include("lib/header.php");
require_once("functions/alert.php");


if (!isset($_SESSION['loggedIn'])) {
    # redirect back to header
    header("Location: login.php");
}
?>

<div class="container">
    <h5>
        <?php print_alert(); ?>
    </h5>
    <h1>Patient Dashboard</h1>

    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight ">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Welcome <strong> <?php echo $_SESSION['fullname'] ?></strong></li>
                <li class="list-group-item">Date of registration: <span style="text-decoration:underline"><?php echo $_SESSION['date'] ?></span></li>
                <li class="list-group-item">You are logged in as a <strong> <?php echo $_SESSION['role'] ?></strong></li>
                <li class="list-group-item"> Department: <strong> <?php echo $_SESSION['department'] ?></strong></li>
                <li class="list-group-item"> last login: <strong> <?php echo $_SESSION['lastLogin'] ?></strong></li>
            </ul>
        </div>
        <div class="p-2 bd-highlight">
            <a href="paybill.php" role="button" class="btn btn-primary btn-md btn-block text-uppercase font-weight-bold">Pay Bill</a>
            <a href="book-appointment.php" role="button" class="btn btn-secondary btn-md btn-block text-uppercase font-weight-bold">Book Appointment</a>
        </div>
    </div>
</div>



<?php include("lib/footer.php"); ?>