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
</div>







<hr>
<div class="container">
  <!-- transaction table -->
  <?php
  $transactions = get_transactions($_SESSION['email']);

  if (count($transactions) < 1) { ?>
    <p style="text-align: center">You have no pending transactions</p>
  <?php } else { ?>
    <table class="table table-hover mt-5">
      <thead class="thead-dark">
        <tr>
          <th scope="col">S/N</th>
          <th scope="col">Amount</th>
          <th scope="col">Date</th>
          <th scope="col">Currency</th>
          <th scope="col">Type</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $transactions = get_transactions($_SESSION['email']);
        for ($i = 0; $i < count($transactions); $i++) {  ?>
          <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?php echo $transactions[$i]->amount ?></td>
            <td><?php echo $transactions[$i]->type ?></td>
            <td><?php echo $transactions[$i]->date ?></td>
            <td><?php echo $transactions[$i]->currency ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>

</div>

<?php include("lib/footer.php"); ?>