<?php include("lib/header.php");
require_once("functions/alert.php");


if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
    # redirect back to header
    header("Location: dashboard.php");

}
?>

<h1>Login page</h1>



<form action="processlogin.php" method="post">
    <h5>
        <?php print_alert(); ?>
    </h5>
   
    <p>
        <label>Email</label><br>
        <input
        <?php
            if (isset($_SESSION['email'])) {
                echo "value=" . $_SESSION['email'];
            }
        ?>
        type="text" name="email" placeholder="Email">
    </p>


    <p>
        <label>Password</label><br>
        <input  type="password" name="password" placeholder="Password">
    </p>
    
    <p>
        <input type="submit" value="LOGIN">
    </p>

</form>


<?php include("lib/footer.php") ?> 