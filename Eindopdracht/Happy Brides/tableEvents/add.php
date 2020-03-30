<?php
include "../DB/ConnectToDB.php";
session_start();


if (isset($_POST['naam']))
{
    $lijstID = $_SESSION["lijstID"];
    $naam = $_POST['naam'];
    $gekocht = "nee";
    $prio = 1;
//    $id = $_SESSION["ID"];
    


    $sql = "INSERT INTO items(naam, gekocht, prio, lijstID) value(:naam, :gekocht, :prio, :lijstID)";

    if ($stmt = $conn->prepare($sql))
    {
        $stmt->bindParam(":naam", $param_naam, PDO::PARAM_STR);
        $stmt->bindParam(":gekocht", $param_gekocht, PDO::PARAM_STR);
        $stmt->bindParam(":prio", $param_prio, PDO::PARAM_INT);
        $stmt->bindParam(":lijstID", $param_lijstID, PDO::PARAM_STR);
//        $stmt->bindParam(":ID", $param_ID, PDO::PARAM_STR);

        $param_naam = $naam;
        $param_gekocht = $gekocht;
        $param_lijstID = $lijstID;
//        $param_ID = uniqid();
        
        
        $res = "SELECT count(*) FROM items where lijstID = :lijstID";
        if ($result = $conn->prepare($res)) {
            $result->bindParam(":lijstID", $param_lijstID, PDO::PARAM_STR);
            $result->execute();
            $count= $result->fetchColumn();
            $param_prio = $count + 1;
        }



        if ($stmt->execute()) {
            // Redirect to login page
            header("Location: ../wenslijst.php");
        } else {
            echo "Er is iets fout gegaan. Probeer het later nog eens.";
        }
        // Close statement
        unset($stmt);
    }

// Close connection
    unset($pdo);
}
