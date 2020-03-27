<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<script>

<?php

include("Navbar.html");
include "connectToDatabaseAndClose.php";

session_start();

$servername = "localhost";
$username = "student";
$password = "student";
$dbname = "wens";
$connectionString = "mysql:host=$servername;dbname=$dbname";



$id = $_SESSION["id"];

//Invoeren kado
$description = $_POST["description"] ?? false;
$done = $_POST["done"] ?? false;
if($done === "on")
{
    $done = true;
}

if($description !== false)
    {
    $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
    if($description === false) {
        echo "Error in description";
        die();
    }


    $conn = null;
    try {
        $conn = new PDO($connectionString, $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO wens.gift(Naam,gekocht,id) VALUES (?, FALSE , ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $description, PDO::PARAM_STR);
//        $stmt->bindParam(2, $gekocht, PDO::PARAM_BOOL);
        $stmt->bindParam(2, $id, PDO::PARAM_INT);

        $stmt->execute();

        //chain
        //$conn->prepare($sql)->execute([$description]);

//        echo "Het kado is toegevoegd";
    } catch (PDOException $ex) {
        echo "PDOException:  $ex";
    } finally {
        if(isset($conn)) {
            $conn = null;
        }
    }
}

//delete
//$del = $_POST["del"] ?? false;
//$done = $_POST["done"] ?? false;
$KadoId = $_POST["KadoID"] ?? false;

//if($done === "on")
//{
//    $done = true;
//}
//
//if($del!== false)
//{
//    $del = filter_var($_POST["del"], FILTER_SANITIZE_STRING);
//    if($del === false)
//    {
//        echo "Error in del";
//        die();
//    }
//
//echo "yes";
//    $conn = null;
//    try {
//        $conn = new PDO($connectionString, $username, $password);
//
//        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//        $sql = "delete from wens.gift where KadoId = :KadoId";
//
//        $stmt = $conn->prepare($sql);
//        $stmt->bindParam(1, $KadoId, PDO::PARAM_STR);
////        $stmt->bindParam(2, $gekocht, PDO::PARAM_BOOL);
////        $stmt->bindParam(2, $id, PDO::PARAM_INT);
//
//        $stmt->execute();
//
//        //chain
//        //$conn->prepare($sql)->execute([$del]);
//
////        echo "Het kado is toegevoegd";
//    } catch (PDOException $ex) {
//        echo "PDOException:  $ex";
//    } finally {
//        if(isset($conn)) {
//            $conn = null;
//        }
//    }
//}
//else if($del == false)
//    {
//    echo "invalid input!";
//    }

try
{
    $conn = new PDO($connectionString, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $action = $_POST["ACTION"];
        
        
        if ($action === "del")
        {
            if (!empty($_POST["KadoId"]))
            {
                echo "1";
                $Id = filter_var($_POST["KadoId"], FILTER_VALIDATE_INT);
                //$todoId = (int)$_POST["todoId"]; //cast is done by filter_var to correct type, if successful
                
                if ($Id === false)
                {
                    //add item to array $errors
                    $errors[] = "invalid KadoId";
                } else
                {
                    $sqlDelete = "DELETE FROM wens.gift WHERE KadoId = :KadoId";
                    
                    $stmtDelete = $conn->prepare($sqlDelete);
                    $stmtDelete->bindValue(":KadoId", $Id, PDO::PARAM_INT);
                    
                    if ($stmtDelete->execute())
                    {
                        if ($stmtDelete->rowCount() == 1)
                        {
                            echo "Record deleted successful";
                        } else
                        {
                            echo "Record not deleted";
                        }
                    } //else is error thrown (PDOException)
                }
            }
            else
            {
                //add item to array $errors
                $errors[] = "todoId is empty";
            }
        }
        
    }
}
catch (PDOException $ex)
{
    echo "PDOException:  $ex";
    die();
}
finally
{
    if($conn != null)
    {
        $conn = null;
    }
}
$sqlselect = "SELECT Naam, KadoId FROM wens.gift WHERE id = $id";
$stmtSelect = $pdo->prepare($sqlselect);
//$stmtSelect->execute();
//$rows = $stmtSelect->fetchAll();



?>

</script>

<body>


<div class="container">
  <h2>Wens lijst</h2>
  <p>Maak hier je lijst aan:</p>
    
    <form method="post">
        <input name="description" type="text">
         <button name="AddKado" type="submit">Voeg kado toe</button>
    </form>


  <table class="table table-hover">
    <thead>
      <tr>
        <th>Wens</th>
        <th>Verander</th>
      </tr>
    </thead>
    <tbody>
    <?
    if (!empty($stmtSelect))
    {
        $stmtSelect->execute();
        $rows = $stmtSelect->fetchAll();
        foreach ($rows as $row) { ?>
        
                '<tr id="KadoId">'
                '<td>' . $row["Naam"] .'</td>' .
                '<td> ' .
                '<form method="post"> ' .
                '<input type="hidden" name="todoId" value="<?= $row["TodoId"] ?>">' .
                '<button type="submit" name="ACTION"  class="btn btn-success btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span> </button>' .
                '<button type="submit" name="ACTION" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> </button>' .
                '<button type="submit" name="ACTION" value="del" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-trash" ></span> </button>' . '</td>' .
                '</form>' ;
                     <? } ?>
                     <? } ?>


</div>

</body>
</html>
