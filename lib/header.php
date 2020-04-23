<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="5" >  -->
    <title>Welcome to SNG : Hospital for the ignorant</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="./font/css/all.css"><!-- FontAwesome  -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"><!-- BootStrap  -->


    <script src="./css/jquery.min.js"></script><!-- BootStrap JQuery  -->
    
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="css/main.css"><!-- Main StyleSheet  -->
   
</head>

<body>
    <!-- <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm"> -->
    <!-- <h5 class="my-0 mr-md-auto font-weight-normal"><a href="index.php">StartNG Hospital</a></h5> -->
    <nav class="navbar navbarbg  navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="index.php">SNH</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#portNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="portNav">
            <ul class="navbar-nav ml-auto">
                <?php if (!isset($_SESSION['loggedIn'])) { ?>
                    <li class="nav-item mr-1 active"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item mr-1 active"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item mr-1 active"><a class="btn btn-primary" href="register.php">Register</a></li>
                    <!-- <a class="nav-link" href="forgot.php">Forgot Password</a> -->
                <?php } else { ?>

                    <?php if ($_SESSION['role'] == 'Super Admin (SA)') { ?>
                        <li class="nav-item mr-1 active"><a class="nav-link" href="super-admin.php">Dashboard</a></li>
                    <?php } else if ($_SESSION['role'] == 'Medical Team (MT)') { ?>
                        <li class="nav-item mr-1 active"><a class="nav-link" href="medical-team.php">Dashboard</a></li>
                    <?php } else if ($_SESSION['role'] == 'Patient') { ?>
                        <li class="nav-item mr-1 active"><a class="nav-link" href="patient.php">Dashboard</a></li>
                    <?php } ?>
                    <li class="nav-item mr-1 active"><a class="nav-link" href="reset.php">Reset Password</a></li>
                    <li class="nav-item mr-1 active"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    <?php } ?>

    </nav>