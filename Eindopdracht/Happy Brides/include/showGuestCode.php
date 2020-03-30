<?php

if(isset($_SESSION["BP"]) && $_SESSION["BP"] === true){
?>
    <h5>Deel de lijst code met jullie gasten:
    <?php
    echo $_SESSION["lijstID"];
    }
?>
</h5>
