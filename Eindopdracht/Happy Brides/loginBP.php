<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    session_start();
    include "include/stylesheets.php";
    include "DB/ConnectToDB.php";
    include "loginScripts/loginBP.script.php";
    ?>

    <title>Login voor het bruidspaar</title>

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
            <!--login table start-->
            <div class="wrapper">
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Emailadres</label>
                        <input type="text" name="email" class="form-control" value="">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Wachtwoord</label>
                        <input type="password" name="wachtwoord" class="form-control">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                    <p>Heb je nog geen account? <a href="registerBP.php">Maak er hier een aan</a>.</p>
                    <p>Ben je een gast? <a href="registerG.php"> Log dan hier in</a> of <a href="loginG.php.php">maak een gast account aan</a>.</p>
                </form>
            </div>
            <!--login table end-->

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