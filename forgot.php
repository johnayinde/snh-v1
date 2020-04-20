<?php include("lib/header.php");
require_once("functions/alert.php");

?>
<p>Forgot your password</p>


<p>Enter your email address associated to your account</p>

<form action="processForgot.php" method="post">

    <h5>
    <?php print_alert(); ?>
    </h5>
    <p>
        <label>Email</label><br>
        <input <?php
                if (isset($_SESSION['email'])) {
                    echo "value=" . $_SESSION['email'];
                }
                ?> type="text" name="email" placeholder="Email">
    </p>
    <p>
        <input type="submit" value="RESET CODE">
    </p>
</form>


<?php include("lib/footer.php") ?>