<?php
include "../DB/ConnectToDB.php";
session_start();
$sql = $conn->prepare("SELECT prio FROM items WHERE ID = :ID");
$sql->bindParam(":ID", $param_ID, PDO::PARAM_STR);
$param_ID = trim($_GET["ID"]);
$param_lijstID = $_SESSION["lijstID"];

$res = "SELECT count(*) FROM items where lijstID = :lijstID";
if ($result = $conn->prepare($res)) {
    $result->bindParam(":lijstID", $param_lijstID, PDO::PARAM_STR);
    $result->execute();
    $count= $result->fetchColumn();
}

if ($sql->execute()) {
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $prio_original = $row['prio'];
        if($prio_original < $count) {
            $stmt = $conn->prepare("UPDATE items SET prio = prio+1 where prio = $prio_original AND lijstID = :lijstID");
            $stmt->bindParam(":lijstID", $param_lijstID, PDO::PARAM_STR);
            $stmt->execute();
            $new_prio = $prio_original + 1;
            $stmt2 = $conn->prepare("UPDATE items SET prio = prio-1 where prio = $new_prio AND ID != $param_ID AND lijstID = :lijstID");
            $stmt2->bindParam(":lijstID", $param_lijstID, PDO::PARAM_STR);
            $stmt2->execute();
        }else header("Location: ../wenslijst.php");
    }
}

header("Location: ../wenslijst.php");