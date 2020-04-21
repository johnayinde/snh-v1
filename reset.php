<?php include("lib/header.php");
require_once("functions/alert.php");
require_once("functions/users.php");



if (!is_user_loggedIn() && !is_token_set()) {

    $_SESSION["error"] = "You are not authorized to view that page";
    redirect_to("login.php");
}


?>





<?php include("lib/footer.php") ?>


<div class="container">
    <form action="processlogin.php" method="post">
        <h5>
            <?php print_alert(); ?>

        </h5>
        <h1 class="display-4 text-center text-capitalize">Reset your password</h1>
        <p>Reset password associated to your account: [email]</p>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input <?php
                    if (isset($_SESSION['email'])) {
                        echo "value=" . $_SESSION['email'];
                    }
                    ?> type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Enter New password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter New password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

       
    </form>
</div>