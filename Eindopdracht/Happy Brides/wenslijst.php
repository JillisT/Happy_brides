<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php
    session_start();
    require "include/stylesheets.php";
    include "DB/ConnectToDB.php";
    include "loginScripts/ifNotLogin.php";
    ?>
    <title>Wenslijst</title>
</head>

<body>
<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="container-fluid">

            <?php
            include "include/NavBar.php";
            include "include/stylesheets.php";
            include "include/showGuestCode.php";
            ?>

            <!-- Lijst start -->
            <hr>
            <div class="table-container">
                <table class="table is-bordered">
                    <tr>
                        <!-- Table Header. -->
                        <th>Voorkeur</th>
                        <th>Item</th>
                        <?php if (isset($_SESSION['BP'])) { ?>
                            <th>Omhoog</th>
                            <th>Omlaag</th>
                            <th>Verwijder</th>
                        <?php } ?>
                        <?php if (isset($_SESSION['gast'])) { ?>
                            <th>Gekocht</th>
                        <?php } ?>
                    </tr>
                    <?php
                    if (isset($_SESSION['BP'])) {
                    ?>

                    <tbody class="row_position">
                    <!-- Hier wordt naar verwezen tijdens de drag & drop. Alleen als het het bruidspaar zelf is  -->
                    <form action="tableEvents/add.php" method="POST">
                        <div class="field">
                            <label class="label">Item</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="Item" id="naam" name="naam">
                            </div>
                        </div>


                        <div class="field">
                            <button class="button is-dark" type="submit">Submit</button>
                        </div>

                    </form>
                    <?php
                    } else {
                    ?>

                    <tbody>
                    <!-- Als het een gast is wordt het een 'standaard' <tbody> waardoor er geen drop & drag mogelijk is  -->

                    <?php
                    }
                    ?>

                    <?php
                    $lijstID = $_SESSION['lijstID'];


                    if (isset($_SESSION['gast'])) {
                        $sql = "SELECT * FROM items WHERE lijstID='$lijstID' AND gekocht='nee' ORDER BY prio ";
                    } else {
                        $sql = "SELECT * FROM items WHERE lijstID='$lijstID' ORDER BY prio ";
                    }
                    $result = $conn->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <!-- TABLE DATA -->

                            <td><?php echo $row["prio"] ?></td>
                            <td><?php echo $row["naam"] ?></td>

                            <?php if (isset($_SESSION["BP"])) { ?>
                                <td><?php if ($row["gekocht"] == 'ja') { ?>
                                    <?php } else { ?>
                                        <a href="tableEvents/omhoog.php?ID=<?php echo $row["ID"]; ?>"
                                           class="button is-danger">Omhoog</a>
                                    <?php } ?>
                                </td>

                                <td><?php if ($row["gekocht"] == 'ja') { ?>
                                    <?php } else { ?>
                                        <a href="tableEvents/omlaag.php?ID=<?php echo $row["ID"]; ?>"
                                           class="button is-danger">Omlaag</a>
                                    <?php } ?>
                                </td>

                                <td><?php if ($row["gekocht"] == 'ja') { ?>
                                        <p>Gekocht</p>
                                    <?php } else { ?>
                                        <a href="tableEvents/delete.php?ID=<?php echo $row["ID"]; ?>"
                                           onclick="return confirm('Weet je het zeker? Je kunt niet meer terug.')"
                                           class="button is-danger">Verwijder</a>
                                    <?php } ?>
                                </td>

                            <?php }
                            if (isset($_SESSION["gast"])) {
                                ?>
                                <td><a href="tableEvents/gekocht.php?ID=<?php echo $row["ID"]; ?>"
                                       onclick="return confirm('Weet je het zeker? Je kunt niet meer terug.')"
                                       class="button is-danger">Heb ik gekocht</a></td>
                            <?php } ?>

                            </tr>
                        <?php }
                    } else {
                    ?>

                    </tbody>
                </table>
            </div>

                <div style="margin-left: 2px;">
                    <?php if (isset($_SESSION['BP'])) { ?>
                        <p>Er zijn nog geen items toegevoegd.</p>
                    <?php } else {
                        ?> <p>Alle items uit de lijst zijn gekozen!</p>
                        <?php
                    }
                } ?>
            </div>
            <br>
            <!-- Lijst end -->

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