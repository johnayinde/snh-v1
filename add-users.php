<?php
require_once("functions/alert.php");
require_once("functions/users.php");
include("lib/header.php");

if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
}

?>
<strong>Add Users</strong>
<p>All field are required</p>

<form action="processregister.php" method="post">
    <h5>
        <?php print_alert(); ?>
       
    </h5>
    <p>
        <label>First Name</label><br>
        <input 
            <?php
                if (isset($_SESSION['first_name'])) {
                    echo "value=" . $_SESSION['first_name'];
                }
                ?>
             type="text" name="first_name" placeholder="First Name">
    </p>

    <p>
        <label>Last Name</label><br>

        <input <?php
                if (isset($_SESSION['last_name'])) {
                    echo "value=" . $_SESSION['last_name'];
                }
                ?> type="text" name="last_name" placeholder="Last Name">
    </p>

    <p>
        <label>Email</label><br>
        <!-- <?php echo  $_SESSION['emailErr'] ?> -->
        <input <?php
                if (isset($_SESSION['email'])) {
                    echo "value=" . $_SESSION['email'];
                }
                ?> type="text" name="email" placeholder="Email">
    </p>


    <p>
        <label>Password</label><br>
        <input type="password" name="password" placeholder="Password">
    </p>
    <p>
        <label>Gender</label><br>
        <select name="gender">
            <option value="">Select One</option>
            <option <?php
                    if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') {
                        echo "selected";
                    }
                    ?>>Male</option>
            <option <?php
                    if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') {
                        echo "selected";
                    }
                    ?>>Female</option>
        </select>
    </p>
    <hr>

    <p>
        <label>Designation</label><br>
        <select name="designation" id="">
            <option value="">Select one</option>
            <option <?php
                    if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team (MT)') {
                        echo "selected";
                    }
                    ?>>Medical Team (MT)</option>
            <option <?php
                    if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient') {
                        echo "selected";
                    }
                    ?>>Patient</option>
        </select>
    </p>

    <p>
        <label>Department</label><br>
        <input <?php
                if (isset($_SESSION['department'])) {
                    echo "value=" . $_SESSION['department'];
                }
                ?> type="text" name="department" placeholder="Department">
    </p>



    <p>
        <input type="submit" value="REGISTER">
    </p>

</form>


<?php include("lib/footer.php");
?>