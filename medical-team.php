<?php include("lib/header.php");

require_once("functions/alert.php");
require_once("functions/users.php");


if (!isset($_SESSION['loggedIn'])) {
  # redirect back to header
  header("Location: login.php");
}
?>

<div class="container">
  <h5>
    <?php print_alert(); ?>
  </h5>
  <h1>Medical Team Dashboard</h1>

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
  </div>
</div>







<hr>
<div class="container">
<!-- appointment table -->
  <?php
  $appointments = get_appointment($_SESSION['department']);

  if (count($appointments) < 1) { ?>
    <p style="text-align: center">You have no pending appointments</p>
  <?php } else { ?>
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">Patient Name</th>
          <th scope="col">Appointment Date</th>
          <th scope="col">Time</th>
          <th scope="col">Nature of Appointment</th>
          <th scope="col">Initial Complaint</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $appointments = get_appointment($_SESSION['department']);
        for ($i = 0; $i < count($appointments); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $appointments[$i]->full_name ?></td>
            <td><?php echo $appointments[$i]->appointment_date ?></td>
            <td><?php echo $appointments[$i]->appointment_time ?></td>
            <td><?php echo $appointments[$i]->appointment_nature ?></td>
            <td><?php echo $appointments[$i]->initial_complaint ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>

  <!-- transaction table -->


  <?php
  $transactions = get_transactions($_SESSION['email']);

  if (count($transactions) < 1) { ?>
    <p style="text-align: center">You have no pending appointments</p>
  <?php } else { ?>
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">Patient Name</th>
          <th scope="col">Amount</th>
          <th scope="col">Date</th>
          <th scope="col">Currency</th>
          <th scope="col">Email</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $transactions = get_appointment($_SESSION['email']);
        for ($i = 0; $i < count($appointments); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $transactions[$i]->full_Name ?></td>
            <td><?php echo $transactions[$i]->amount ?></td>
            <td><?php echo $transactions[$i]->date ?></td>
            <td><?php echo $transactions[$i]->currency ?></td>
            <td><?php echo $transactions[$i]->email ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>

</div>

<?php include("lib/footer.php"); ?>