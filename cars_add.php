<?php
require_once("settings.php");
$conn=mysqli_connect($host,$user,$pwd, $sql_db);
$sql_table = "cars";
$query="select make, model, price FROM cars ORDER BY make, model";

$make = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST["carmake"])));
$model = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST["carmodel"])));
$price = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST["price"])));
$yom = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST["yom"])));

$query="insert into $sql_table(make,model,price,yom) values('$make','$model','$price','$yom')";
$result=mysqli_query($conn,$query);
if (!$result){
    echo "<p class=\"Wrong\">Something is wrong with ", $query, "</p>";
}else{
    echo "<p class=\"ok\">Successfully added New Car record</p>";
}
mysqli_close($conn);