<?php
require_once("functions/alert.php");
require_once("functions/users.php");
include("lib/header.php");

if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
} ?>
<a href="super-admin.php" class="btn btn-primary ml-3 mt-3">Go back</a>



<div class="container ">
    <h1 class="display-4 text-center text-capitalize">Add Users</h1>
    <p class="display-5 text-capitalize text-center">All field are required</p>
</div>

<div class="container form-container">
    <form action="processregister.php" method="post" ">
                <h5>
                    <?php print_alert(); ?>
                </h5>
                <div class=" form-group">
        <label>First Name</label><br>
        <input <?php
                if (isset($_SESSION['first_name'])) {
                    echo "value=" . $_SESSION['first_name'];
                }
                ?> type="text" class="form-control" name="first_name" placeholder="First Name">


        <div class="form-group">
            <label>Last Name</label><br>

            <input <?php
                    if (isset($_SESSION['last_name'])) {
                        echo "value=" . $_SESSION['last_name'];
                    }
                    ?> type="text" class="form-control" name="last_name" placeholder="Last Name">
        </div>

        <div class="form-group">
            <label>Email</label><br>
            <!-- <?php echo  $_SESSION['emailErr'] ?> -->
            <input <?php
                    if (isset($_SESSION['email'])) {
                        echo "value=" . $_SESSION['email'];
                    }
                    ?> type="text" class="form-control" name="email" placeholder="Email">
        </div>


        <div class="form-group">
            <label>Password</label><br>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label>Gender</label><br>
            <select name="gender" class="form-control">
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
        </div>
        <hr>

        <div class="form-group">
            <label>Designation</label><br>
            <select name="designation" class="form-control">
                <option value="">Select one</option>
                <option <?php
                        if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team (MT)') {
                            echo "selected";
                        }
                        ?>>Medical Team (MT)</option>

                <option <?php
                        if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Super Admin (SA)') {
                            echo "selected";
                        }
                        ?>>Super Admin (SA)</option>

                <option <?php
                        if (isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient') {
                            echo "selected";
                        }
                        ?>>Patient</option>
            </select>
        </div>

        <div class="form-group">
            <label>Department</label><br>
            <input <?php
                    if (isset($_SESSION['department'])) {
                        echo "value=" . $_SESSION['department'];
                    }
                    ?> type="text" class="form-control" name="department" placeholder="Department">
        </div>

        <input class="btn btn-primary btn-block" type="submit" value="ADD USER">


    </form>
</div>


<?php include("lib/footer.php");
?>