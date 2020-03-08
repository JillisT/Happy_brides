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
//controle ingevult
$kadoErr =  "";
$error = true;

if($_SERVER["REQUEST_METHOD"] === "POST")
    {
    $error = false;

    if(empty($_POST["name"]))
    {
        $kadoErr = "Vul een naam voor een kado in";
        $error = true;
    }
    else
    {
        $kado = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    }
    }

//Data uit database halen en in het tabel zetten
$host = "localhost";
$databaseName = "Wenslijst";
$connectionString = "mysql:host=$host;dbname=$databaseName";
$username = "student";     //root is default in most cases
$password = "student";     //root is default in most cases

$conn = null;

try {
    $conn = new PDO($connectionString, $username, $password);

    //enables exception mode, exception is throw when an error occurs
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successful";
} catch (PDOException $ex) {
    echo "PDOException:  $ex";
} finally {
    if($conn != null) {
        //$conn->close();
        $conn = null;
    }
}

$sql = "SELECT Naam FROM Wenslijst.Kados";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
//    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
//        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["firstname"] . " " . $row["lastname"] . "</td></tr>";
        echo "<tr><td>" . $row["Naam"];
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();


?>

</script>

<body>


  
<div class="container">
  <h2>Wens lijst</h2>
  <p>Maak hier je lijst aan:</p>

    <form method="post">
        Kado: <input type="text" name="kado">* <?php echo $kadoErr ?>
        <button type="submit">Submit</button>
    </form>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Wens</th>
        <th>Verander</th>
      </tr>
    </thead>
    <tbody>
       <tr id="1">
           <td> <input type="text" id="w1" name="wens" value="1" ><br> </td>
           <td> 
             <button type="button" id="up1" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span> </button>
             <button type="button" id="down1" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> </button>
             <button type="button" id="del1" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-trash" ></span> </button>
           </td>
          <!-- The Modal -->
        <div class="modal" id="myModal1">
        <div class="modal-dialog">
       <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Verwijderen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Weet je zeker dat je dit item wil verwijderen?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button id="delm1" type="button" class="btn btn-success" data-dismiss="modal">Ja</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Nee</button>
        </div>
        
    <div>    
        <tr id="2">
           <td> <input type="text" id="w2" name="wens" value="2" ><br> </td>
           <td> 
             <button type="button" id="up2" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span> </button>
             <button type="button" id="down2" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> </button>
             <button type="button" id="del2" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-trash" ></span> </button>
           </td>
        <!-- The Modal -->
        <div class="modal" id="myModal2">
        <div class="modal-dialog">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Verwijderen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Weet je zeker dat je dit item wil verwijderen?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button id="delm2" type="button" class="btn btn-success" data-dismiss="modal">Ja</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Nee</button>
     </div>
      <tr id="3">
           <td> <input type="text" id="w3" name="wens" value="3" ><br> </td>
           <td> 
             <button type="button" id="up3" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span> </button>
             <button type="button" id="down3" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> </button>
             <button type="button" id="del3" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal3"><span class="glyphicon glyphicon-trash" ></span> </button>
           </td>
        <!-- The Modal -->
        <div class="modal" id="myModal3">
        <div class="modal-dialog">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Verwijderen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Weet je zeker dat je dit item wil verwijderen?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button id="delm3" type="button" class="btn btn-success" data-dismiss="modal">Ja</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Nee</button>
        </div>
        
        <div>    
          <tr id="4">
             <td> <input type="text" id="w4" name="wens" value="4" ><br> </td>
             <td> 
               <button type="button" id="up4" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span> </button>
               <button type="button" id="down4" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> </button>
               <button type="button" id="del4" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal4"><span class="glyphicon glyphicon-trash" ></span> </button>
             </td>
          <!-- The Modal -->
          <div class="modal" id="myModal4">
          <div class="modal-dialog">
          <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Verwijderen</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            Weet je zeker dat je dit item wil verwijderen?
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <button id="delm4" type="button" class="btn btn-success" data-dismiss="modal">Ja</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Nee</button>
       </div>
       <div>    
        <tr id="5">
           <td> <input type="text" id="w5" name="wens" value="5" ><br> </td>
           <td> 
             <button type="button" id="up5" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span> </button>
             <button type="button" id="down5" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> </button>
             <button type="button" id="del5" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal5"><span class="glyphicon glyphicon-trash" ></span> </button>
           </td>
        <!-- The Modal -->
        <div class="modal" id="myModal5">
        <div class="modal-dialog">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Verwijderen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Weet je zeker dat je dit item wil verwijderen?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button id="delm5" type="button" class="btn btn-success" data-dismiss="modal">Ja</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Nee</button>
     </div>
     <div>    
      <tr id="6">
         <td> <input type="text" id="w6" name="wens" value="6" ><br> </td>
         <td> 
           <button type="button" id="up6" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span> </button>
           <button type="button" id="down6" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> </button>
           <button type="button" id="del6" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal6"><span class="glyphicon glyphicon-trash" ></span> </button>
         </td>
      <!-- The Modal -->
      <div class="modal" id="myModal">
      <div class="modal-dialog">
      <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Verwijderen</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        Weet je zeker dat je dit item wil verwijderen?
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button id="delm6" type="button" class="btn btn-success" data-dismiss="modal">Ja</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Nee</button>
   </div>
   <div>    
    <tr id="7">
       <td> <input type="text" id="w7" name="wens" value="7" ><br> </td>
       <td> 
         <button type="button" id="up7" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span> </button>
         <button type="button" id="down7" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-circle-arrow-down"></span> </button>
         <button type="button" id="del7" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal7"><span class="glyphicon glyphicon-trash" ></span> </button>
       </td>
    <!-- The Modal -->
    <div class="modal" id="myModal7">
    <div class="modal-dialog">
    <div class="modal-content">
  
    <!-- Modal Header -->
    <div class="modal-header">
      <h4 class="modal-title">Verwijderen</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    
    <!-- Modal body -->
    <div class="modal-body">
      Weet je zeker dat je dit item wil verwijderen?
    </div>
    
    <!-- Modal footer -->
    <div class="modal-footer">
      <button id="delm7" type="button" class="btn btn-success" data-dismiss="modal">Ja</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Nee</button>
 </div>
 

    </tbody>
  </table>

  <input type="text" class="hidden" id="temp" name="wens"  color="white">

</div>

</body>
</html>
