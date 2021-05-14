<?php
require_once "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    date_default_timezone_set('Africa/Nairobi');
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["PhoneNo"]);
    $natID = trim($_POST["NatID"]);
    $password = trim($_POST["password"]);
    $stripped = substr($phone, -9);
    $finalStripped = "254".$stripped;

    /*$ourArray = [
        'name'=>$firstname,
        'lname'=>$lastname
    ];
    echo json_encode($ourArray);*/

    $sql = "INSERT INTO customers (firstname, lastname, email, PhoneNo, regDate, password, NatID) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssssss", $param1, $param2, $param3, $param4, $param5, $param6, $param7);
        
        // Set parameters
        $param1 = $firstname;
        $param2 = $lastname;
        $param3 = $email;
        $param4 = $finalStripped;
        $param5 = date("Y-m-d H:i:s");
        $param6 = $password;
        $param7 = $natID;
        
        // Attempt to execute the prepared statementphone
        if($stmt->execute()){
        echo("Registration successful");
        }else{
            echo("An unexpected error occurred");
        }
     
    // Close statement
    $stmt->close();
}
$mysqli->close();
?>