<?php include_once('lib/header.php');
require_once('functions/alert.php');
require_once('functions/users.php');

if (!isset($_SESSION['loggedIn'])) {
  // redirect to dashboard
  header("Location: login.php");
}
?>
<a href="super-admin.php" class="btn btn-primary ml-3 mt-3">Go back</a>

<h3 class="display-4 text-center text-capitalize">Patients List</h3>
<div class="container">
  <?php

  $patient = get_patients();
  if (count($patient) < 1) { ?>
    <p>StartNG hospital currently has no registered patient</p>
  <?php } else { ?>
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Gender</th>
          <th scope="col">Department</th>
          <th scope="col">Registration Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $patient = get_patients();
        for ($i = 0; $i < count($patient); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $patient[$i]->first_name ?></td>
            <td><?php echo $patient[$i]->last_name; ?></td>
            <td><?php echo $patient[$i]->email ?></td>
            <td><?php echo $patient[$i]->gender ?></td>
            <td><?php echo $patient[$i]->department ?></td>
            <td><?php echo $patient[$i]->lastLoginDate ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div>



<?php include_once('lib/footer.php'); ?>