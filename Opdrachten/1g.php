<html>
<head>
    <title>Hello World (Student)</title>
</head>
<body>


<form action="1g.php" method="post">
    Getal1: <input type="number" name="Getal1">
    Getal2: <input type="number" name="Getal2">
    <br>

    <button type="submit" name="plus"> + </button>
    <button type="submit" name="min"> - </button>
    <button type="submit" name="keer"> * </button>
    <button type="submit" name="deel"> / </button>


</form>

<br>


<?php

If($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_POST["Getal1"]))
    {
        if (isset($_POST["Getal2"]))
        {
            switch ($name)
            {
                case "red":
                    echo "Your favorite color is red!";
                    break;
                case "blue":
                    echo "Your favorite color is blue!";
                    break;
                case "green":
                    echo "Your favorite color is green!";
                    break;
                default:
                    echo "Your favorite color is neither red, blue, nor green!";
            }
            echo $_POST["Getal1"];
        }
    }
}
?>

</body>
</html>