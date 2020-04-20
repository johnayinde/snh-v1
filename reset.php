<?php include("lib/header.php");
require_once("functions/alert.php");
require_once("functions/users.php");



if(!is_user_loggedIn() && !is_token_set()){

    $_SESSION["error"] = "You are not authorized to view that page";
    redirect_to("login.php");
}


?>
<p>Reset your password</p>


<p>Reset password associated to your account: [email]</p>

<form action="processreset.php" method="post">

    <h5>
    <?php print_alert(); ?>
    </h5>

    <?php if(!is_user_loggedIn()) { ?>
        <input <?php
                if (isset(($_SESSION['token']))) {
                    echo "value='" . $_SESSION['token'] . "'";
                } else {
                    echo "value='" . $_GET['token'] . "'";
                }
                ?> type="hidden" name="token">

    <?php } ?>
    <p>
        <label>Email</label><br>
        <input <?php
                if (isset(($_SESSION['email']))) {
                    echo "value=" . $_SESSION['email'];
                }
                ?> type=" text" name="email" placeholder="Email">
    </p>
    <p>
        <label>Enter New password</label><br>
        <input type="password" name="password" placeholder="Password">
    </p>
    <p>
        <input type="submit" value="RESET PASSWORD">
    </p>
</form>


<?php include("lib/footer.php") ?>