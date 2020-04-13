<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php
        session_start();
        if(!isset($_SESSION["loggedin"])){
            header("location: index.php");
        }
        require "include/stylesheets.php";
        include "DataBase/connectToDatabase.php";
    ?>
    <title>SLB'er</title>
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
//                require "include/NavBar.php";
//                include "Datascripts/dashselect.php";
               ?>

            </td>
            <h3 class="mt-5"><b>Overzicht aanvragen</b></h3>
            <div class="col-sm-12 col-md-12">
<!--                                <div class="card" style="height: 400px;">-->
                <div class="row">
                    <div class="col-sm-2 col-md-12">
                        <br>
                        <table>
                            <?php
                                $ID = $_SESSION['ID'];
                                
                                    $sql = "SELECT naam_student FROM slb WHERE id='$ID' ";
                                
        
                                    $result = $conn->query($sql);
        
                                    if ($result->rowCount() > 0)
                                {
                                while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                {
                                
                                ?>
                                     <!-- TABLE DATA -->
    
                                    <td><?php echo $row["naam_student"] ?></td>

                            <tr>
                                <td><b>Persoonsgegevens:</b></td>
                            <tr>
                                <td style="width: 200px">Naam:</td>

                                <td><?php echo $studentnummer;?></td>
                            </tr>
                            <?php } } ?>
                        </table>
                    </div>
                    <div class="col-sm-2 col-md-12 d-flex flex-row-reverse">
<!--                        --><?php
//                            if (!empty($num)) {
//                                ?>
<!--                                <form action="include/aanvraagVerwijderen.script.php" method="post">-->
<!--                                    <button class="btn btn-primary"-->
<!--                                            style="margin-top: 10px; margin-right: 30px; margin-left: 10px;"-->
<!--                                            type="submit">Aanvraag verwijderen-->
<!--                                    </button>-->
<!--                                </form>-->
<!--                                --><?php
//                            }else{
//                                ?>
<!--                                <form action="include/aanvraagAanmaken.script.php" method="post">-->
<!--                                    <button class="btn btn-primary"-->
<!--                                            style="margin-top: 10px; margin-right: 30px; margin-left: 10px;"-->
<!--                                            type="submit">Nieuwe aanvraag-->
<!--                                    </button>-->
<!--                                </form>-->
<!--                                <div class="align-self-end">Nog geen aanvraag gedaan.</div>-->
<!--                                --><?php
//                            }
//                        ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container body end -->

    <!-- white space links -->
    <div class="col-lg-2"></div>
</div>
</div>
<!-- row end -->

</body>
</html>
