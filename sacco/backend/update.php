<?php
require_once "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstname = trim($_POST["name1"]);
        $secondname = trim($_POST["name2"]);
        $email = trim($_POST["email"]);
        $number = trim($_POST["det"]);

        $insertTotal = "UPDATE customers SET firstname='$firstname',lastname='$secondname', email ='$email' WHERE PhoneNo='$number'";
        $mysqli->query($insertTotal);
        $sql = "SELECT * FROM customers WHERE PhoneNo = '$number'";
        $stmt = $mysqli->query($sql);
            if($stmt->num_rows>0){
                $row = $stmt->fetch_array();
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];   
                $emailaddress = $row['email']; 
                $regDate = $row['regDate'];   
                $phonenumber = $row['PhoneNo'];                                           
                $ourArray = [
                    'firstname'=>$firstname,
                    'secondname'=>$lastname,
                    'emailaddress'=>$emailaddress,
                    'phonenumber'=>$phonenumber,
                    'duration'=> getMonths($regDate)
                ];
                echo json_encode($ourArray);
            }
        // echo($firstname." ".$secondname." ".$email." ".$number);
    // Close connection
    $mysqli->close();
}
function getMonths($arg){
    $date1 = strtotime($arg); 
    $date2 = strtotime(date("Y-m-d H:i:s")); 
    $diff = abs($date2 - $date1); 
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years * 365*60*60*24)
                                / (30*60*60*24));
    $tot = ($years * 12)+($months);
    return $tot;                                
}
?>