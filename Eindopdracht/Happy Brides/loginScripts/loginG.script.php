<?php
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: wenslijst.php");
    exit;
}

// Define variables and initialize with empty values
$email = $wachtwoord = "";
$email_err = $wachtwoord_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Vul een emailadres in.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["wachtwoord"]))){
        $wachtwoord_err = "Voer uw wachtwoord in.";
    } else{
        $wachtwoord = trim($_POST["wachtwoord"]);
    }

    // Validate credentials
    if(empty($email_err) && empty($wachtwoord_err)){
        // Prepare a select statement
        $sql = "SELECT ID, email, wachtwoord, lijstID FROM gast WHERE email = :email";

        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["ID"];
                        $email = $row["email"];
                        $hashed_wachtwoord = $row["wachtwoord"];
                        $lijstID = $row["lijstID"];
                        if(password_verify($wachtwoord, $hashed_wachtwoord)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["gast"] = true;
                            $_SESSION["ID"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["lijstID"] = $lijstID;

                            // Redirect user to welcome page
                            header("location: wenslijst.php");
                        } else{
                            // Display an error message if password is not valid
                            $wachtwoord_err = "Het wachtwoord of emailadres is onjuist.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $email_err = "Dit email is niet in gebruik.";
                }
            } else{
                echo "Er is iets fout gegaan. Probeer het later nog eens.";
            }

            // Close statement
            unset($stmt);
        }
    }
    // Close connection
    unset($conn);
}