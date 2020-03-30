<?php
if(isset($_SESSION["loggedin"])){
    ?>
    <!-- als er is ingelogd -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
        <a class="navbar-brand" href="index.php" >Happy Brides</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wenslijst.php">wenslijst</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="include/logout.php">log uit</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
} else {
    session_destroy();
    ?>

    <!-- als er NIET is ingelogd -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
        <a class="navbar-brand" href="index.php">Happy Brides</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gast.php">Lijst bekijken</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item" href="loginBP.php">Bruidspaar</a>
                        <a class="dropdown-item" href="loginG.php">Gast</a>
                    </div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account aanmaken
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item" href="registerBP.php">Bruidspaar</a>
                        <a class="dropdown-item" href="registerG.php">Gast</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <?php
}