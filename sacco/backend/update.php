<?php
require_once "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstname = trim($_POST["name1"]);
        $secondname = trim($_POST["name2"]);
        $email = trim($_POST["email"]);
        $number = trim($_POST["det"]);

        $insertTotal = "UPDATE customers SET firstname='$firstname',lastname='$secondname', email ='$email' WHERE PhoneNo='$number'";
        $mysqli->query($insertTotal);
         echo "Details Saved Successfully";
    // Close connection
    $mysqli->close();
}
?>