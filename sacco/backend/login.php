<?php
require_once "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $emailaddress = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $sql = "SELECT * FROM customers WHERE email = '$emailaddress' AND password = '$password'";
        $stmt = $mysqli->query($sql);
            if($stmt->num_rows>0){
                $row = $stmt->fetch_array();
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];   
                $emailaddress = $row['email'];  
                $phonenumber = $row['PhoneNo'];                                           
                $ourArray = [
                    'firstname'=>$firstname,
                    'secondname'=>$lastname,
                    'emailaddress'=>$emailaddress,
                    'phonenumber'=>$phonenumber
                ];
                echo json_encode($ourArray);
            }else{
                echo("Access Denied");
            }
    // Close connection
    $mysqli->close();
}
?>