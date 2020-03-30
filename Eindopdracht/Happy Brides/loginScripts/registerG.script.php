<?php
// Aanmaken van values
$email = $wachtwoord = $herhaal_wachtwoord = $lijstID = "";
$email_err = $wachtwoord_err = $herhaal_wachtwoord_err = $lijstID_err = "";

// Wanneer er op aanmelden is gedrukt
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Kijken of er iets in de email veld is ingevoerd
    if (empty(trim($_POST["email"]))) {
        $email_err = "Voer een emailades in.";
    } else {
        // SELECT statement aanmaken
        $sql = "SELECT ID FROM gast WHERE email = :email";

        if ($stmt = $conn->prepare($sql)) {
            // Verbind de ingevoerde tekst met de statement
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "Er bestaat al een account met dit emailadres.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oeps! Er is iets verkeerd gegaan. Probeer het later nog eens.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Kijken of er iets in de lijstID veld is ingevoerd
    if (empty(trim($_POST["lijstID"]))) {
        $lijstID_err = "De gegeven code in.";
    } else {
        // SELECT statement aanmaken
        $sql = "SELECT lijstID FROM koppel WHERE lijstID = :lijstID";

        if ($stmt = $conn->prepare($sql)) {
            // Verbind de ingevoerde tekst met de statement
            $stmt->bindParam(":lijstID", $param_lijstID, PDO::PARAM_STR);

            // Set parameters
            $param_lijstID = trim($_POST["lijstID"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $lijstID = $row["lijstID"];
                        // Validate password
                        if (empty(trim($_POST["wachtwoord"]))) {
                            $wachtwoord_err = "Voer een wachtwoord in.";
                        } elseif (strlen(trim($_POST["wachtwoord"])) < 6) {
                            $wachtwoord_err = "Het wachtwoord moet temniste uit 6 karakters bestaan.";
                        } else {
                            $wachtwoord = trim($_POST["wachtwoord"]);
                        }

                        // Validate confirm password
                        if (empty(trim($_POST["herhaal_wachtwoord"]))) {
                            $herhaal_wachtwoord_err = "Herhaal je wachtwoord.";
                        } else {
                            $herhaal_wachtwoord = trim($_POST["herhaal_wachtwoord"]);
                            if (empty($wachtwoord_err) && ($wachtwoord != $herhaal_wachtwoord)) {
                                $herhaal_wachtwoord_err = "Wachtwoorden zijn niet hetzelfde.";
                            }
                        }
            } else {
                echo "Oeps! Er is iets verkeerd gegaan. Probeer het later nog eens.";
            }
                    // Check input errors before inserting in database
                    if (empty($email_err) && empty($wachtwoord_err) && empty($herhaal_wachtwoord_err) && empty($lijstID_err)) {

                        // Prepare an insert statement
                        $sql = "INSERT INTO gast (email, wachtwoord, lijstID) VALUES (:email, :wachtwoord, :lijstID)";

                        if ($stmt = $conn->prepare($sql)) {
                            // Bind variables to the prepared statement as parameters
                            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                            $stmt->bindParam(":wachtwoord", $param_wachtwoord, PDO::PARAM_STR);
                            $stmt->bindParam(":lijstID", $param_lijstID, PDO::PARAM_STR);

                            // Set parameters
                            $param_email = $email;
                            $param_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT); // Creates a password hash
                            $param_lijstID = $lijstID;

                            // Attempt to execute the prepared statement
                            if ($stmt->execute()) {
                                // Redirect to login page
                                header("location: loginG.php");
                            } else {
                                echo "Er is iets fout gegaan. Probeer het later nog eens.";
                            }

                            // Close statement
                            unset($stmt);
                        }
                    }

                    // Close connection
                    unset($conn);
                }else{
                    echo "Deze code is onjuist";
                }
            } else echo "er ging iets mis";

        }
    }
}