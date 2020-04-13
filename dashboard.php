<?php include("lib/header.php");

if (!isset($_SESSION['loggedIn'])) {
    # redirect back to header
    header("Location: login.php");
}
?>
<h1>Dashboard</h1>





<div class="col-md 4 pt-4 pl-4 ">
    <p>Welcome <strong> <?php echo $_SESSION['fullname'] ?></strong></p>
    <hr />
    <p>You are user id <strong> <?php echo $_SESSION['loggedIn'] ?></strong></p>
    <hr />
    <p>You are logged in as a <strong> <?php echo $_SESSION['role'] ?></strong></p>
    <hr />
    <p> Date of registration: <strong> <?php echo $_SESSION['date'] ?></strong></p>
    <hr />
    <p> Date and time of last login: <strong> <?php echo $_SESSION['lastLogin'] ?></strong></p>
    <hr />
    <p> Department: <strong> <?php echo $_SESSION['department'] ?></strong></p>


</div>

<?php include("lib/footer.php"); ?>