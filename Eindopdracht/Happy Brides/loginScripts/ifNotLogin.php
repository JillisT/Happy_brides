<?php
if(!isset($_SESSION["loggedin"]) && empty($_SESSION["loggedin"])){
    header("location: index.php");
}