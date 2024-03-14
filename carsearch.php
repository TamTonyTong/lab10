<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Creating Web Applications Lab 10">
    <meta name="keywords" content="PHP, MySql">
    <title>Retrieving records to HTML</title>
</head>

<body>
    <h1>Search Car Result - Lab10</h1>
    <?php
    require_once("settings.php");
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    $sql_db = "cars";
    $query = "select make, model, price FROM cars ORDER BY make, model";

    $make = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST["carmake"])));
    $model = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST["carmodel"])));
    $price = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST["price"])));
    $yom = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST["yom"])));
    $query = "SELECT * FROM cars WHERE make LIKE '$make' AND model LIKE '$model' AND price LIKE '$price' AND yom LIKE '$yom'";
    $result = mysqli_query($conn, $query);
    //If the result return more than 0 rows which mean it has successfuly query the database
    //or else it will display the error msg.
    if ($result and mysqli_num_rows($result) > 0) {
        echo "<table border=\"1\">\n";
        echo "<tr>\n "
            . "<th scope= \"col\">Make</th>\n "
            . "<th scope= \"col\">Model</th>\n "
            . "<th scope= \"col\">Price</th>\n"
            . "<th scope= \"col\">YOM</th>\n"
            . "</tr>\n";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>\n ";
            echo "<td>", $row["make"], "</td>\n ";
            echo "<td>", $row["model"], "</td>\n ";
            echo "<td>", $row["price"], "</td>\n ";
            echo "<td>", $row["yom"], "</td>\n ";
            echo "</tr>\n ";
            echo "</table>";
        }
    } else {
        echo "<p>Something is wrong with ", $query, "</p>";
    }
