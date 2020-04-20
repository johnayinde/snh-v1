<?php include("lib/header.php");

require_once("functions/alert.php");
require_once("functions/users.php");


if (!isset($_SESSION['loggedIn'])) {
    # redirect back to header
    header("Location: login.php");
}
?>
<h5>
    <?php print_alert(); ?>
</h5>
<h1>Medical Team Dashboard</h1>


<p>Welcome <strong> <?php echo $_SESSION['fullname'] ?></strong></p>
<p>Date of registration: <span style="text-decoration:underline"><?php echo $_SESSION['date'] ?></span></p>
<p>You are logged in as a <strong> <?php echo $_SESSION['role'] ?></strong></p>
<p> Department: <strong> <?php echo $_SESSION['department'] ?></strong></p>
<p> last login: <strong> <?php echo $_SESSION['lastLogin'] ?></strong></p>

<hr>
<?php

  $appointments = get_appointment($_SESSION['department']);

  if (count($appointments) < 1) { ?>
    <p style="text-align: center">You have no pending appointments</p>
  <?php } else { ?>
    <table class="medical_table">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Patient Name</th>
          <th>Appointment Date</th>
          <th>Time</th>
          <th>Nature of Appointment</th>
          <th>Initial Complaint</th>
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
</div>

<?php include("lib/footer.php"); ?>
