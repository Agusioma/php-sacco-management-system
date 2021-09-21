<?php
require_once "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name

    $password = trim($_POST["password"]);
    $phone = trim($_POST["PhoneNo"]);
    $stripped = substr($phone, -9);
    $finalStripped = "254".$stripped;
    $sql = "SELECT * FROM customers WHERE PhoneNo = '$finalStripped' AND password = '$password'";
        $stmt = $mysqli->query($sql);
            if($stmt->num_rows>0){
                header("Location: https://sacco.terrence-aluda.com/sacco/display.html");
            }
}
$mysqli->close();

?>