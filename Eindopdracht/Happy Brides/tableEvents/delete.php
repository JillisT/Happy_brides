<?php
include "../DB/ConnectToDB.php";
session_start();
if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
}

$sql = $conn->prepare("SELECT prio FROM items WHERE ID = :ID");
$sql->bindParam(":ID", $param_ID, PDO::PARAM_STR);
$param_ID = trim($_GET["ID"]);
if ($sql->execute()) {
    while ($row = $sql -> fetch(PDO::FETCH_ASSOC)) {
        $prio_original = $row['prio'];
        $sql2 = $conn->prepare("UPDATE items SET prio = prio-1 where prio > $prio_original AND lijstID = :lijstID");
        $sql2->bindParam(":lijstID", $param_lijstID, PDO::PARAM_STR);
        $param_lijstID = $_SESSION["lijstID"];
        $sql2->execute();
    }
}else echo "error";



$stmt = $conn->prepare("DELETE FROM items WHERE ID = :ID");

$stmt->bindParam(":ID", $param_ID, PDO::PARAM_STR);
$param_ID = trim($_GET["ID"]);

$stmt->execute();

$sql = "Select * from items";

$result = $conn->prepare($sql);
$result->execute();
header("Location: ../wenslijst.php");