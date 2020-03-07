<!--

Naam: <input type="text" naam="naam" value="<?php /*echo $naam;*/?>">

Beschrijving: <input type="text" naam="beschrijivng" value="<?php /*echo $beschrijving;*/?>">

prijs: <input type="text" naam="prijs" value="<?php /*echo $prijs;*/?>">

Categorie

Email:

Uitverkocht
-->


<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
// define variables and set to empty values
$naamErr = $emailErr = $beschrijvingErr = $prijsErr = $categorieErr = $uitverkochtErr = "" ;
$naam = $email = $beschrijving = $prijs = $categorie =  "";
$uitverkocht = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["naam"])) {
        $naamErr = "Naam is vereist";
    } else {
        $naam = test_input($_POST["naam"]);
        // check if naam only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$naam)) {
            $naamErr = "Alleen letters en spaties zijn toegestaan";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {//
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["prijs"])) {
        $prijs = "";
    } else {
        $prijs = test_input($_POST["prijs"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$prijs)) {
            $prijsErr = "Invalid URL";
        }
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["categorie"])) {
        $categorieErr = "categorie is required";
    } else {
        $categorie = test_input($_POST["categorie"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Naam: <input type="text" naam="naam" value="<?php echo $naam;?>">
    <span class="error">* <?php echo $naamErr;?></span>
    <br><br>
    Beschrijving: <input type="text" naam="beschrijving" value="<?php echo $naam;?>">
    <span class="error">* <?php echo $naamErr;?></span>
    <br><br>

    Prijs: <input type="text" naam="prijs" value="<?php echo $prijs;?>">
    <span class="error"><?php echo $prijsErr;?></span>
    <br><br>

    Categorie:
    <input type="radio" naam="categorie" <?php if (isset($categorie) && $categorie=="female") echo "checked";?> value="female">Female
    <input type="radio" naam="categorie" <?php if (isset($categorie) && $categorie=="male") echo "checked";?> value="male">Male
    <input type="radio" naam="categorie" <?php if (isset($categorie) && $categorie=="other") echo "checked";?> value="other">Other
    <span class="error">* <?php echo $categorieErr;?></span>
    <br><br>

    Email: <input type="text" naam="beschrijving" value="<?php echo $beschrijving;?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>

    Uitverkocht:
    <input type="radio" naam="uitverkocht" <?php if (isset($uitverkocht) && $uitverkocht=="True") echo "checked";?> value="True">Ja
    <input type="radio" naam="uitverkocht" <?php if (isset($uitverkocht) && $uitverkocht=="False") echo "checked";?> value="False">Nee

    <span class="error">* <?php echo $uitverkochtErr;?></span>
    <br><br>
    <input type="submit" naam="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $naam;
echo "<br>";
echo $beschrijving;
echo "<br>";
echo $prijs;
echo "<br>";
echo $categorie;
echo "<br>";
echo $email;
echo "<br>";
echo $uitverkocht;
?>
<!--Naam: <input type="text" naam="naam" value="--><?php ///*echo $naam;*/?><!--">-->
<!---->
<!--Beschrijving: <input type="text" naam="beschrijivng" value="--><?php ///*echo $beschrijving;*/?><!--">-->
<!---->
<!--prijs: <input type="text" naam="prijs" value="--><?php ///*echo $prijs;*/?><!--">-->
<!---->
<!--Categorie-->
<!---->
<!--Email:-->
<!---->
<!--Uitverkocht-->
