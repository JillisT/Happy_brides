<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    require "include/stylesheets.php";
    include "DB/ConnectToDB.php";
    include "loginScripts/registerG.script.php";
    ?>

    <title>Registreren</title>

</head>
<body>
<!-- row start -->
<div class="row">
    <!-- white space rechts -->
    <div class="col-lg-2"></div>

    <!-- body start -->
    <div class="col-lg-8">

        <!-- container body start -->
        <div class="container-fluid">

           <?php
           include "include/NavBar.php";
            ?>

            <!--register table start-->
            <div class="wrapper">
                <h2>Sign Up</h2>
                <p>Please fill this form to create an account.</p>
                <form action="" method="post">
                    <div class="form-group ">
                        <label>Emailadres</label>
                        <input type="text" name="email" class="form-control" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Wachtwoord</label>
                        <input type="password" name="wachtwoord" class="form-control" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Herhaal wachtwoord</label>
                        <input type="password" name="herhaal_wachtwoord" class="form-control" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Lijst code</label>
                        <input type="password" name="lijstID" class="form-control" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                    <p>Heb je al een account? <a href="loginG.php">Log dan hier in</a>.</p>
                </form>
            </div>
            <!--register table end-->

        </div>
        <!-- continer body end -->

    </div>
    <!-- body end -->

    <!-- white space links -->
    <div class="col-lg-2"></div>
</div>
<!-- row end -->
</body>
</html>