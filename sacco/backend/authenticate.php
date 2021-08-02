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
                $row = $stmt->fetch_array();
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];   
                $emailaddress = $row['email'];  
                $phonenumber = $row['PhoneNo'];
                $regDate = $row['regDate'];
                $custID = $row['NatID'];
                $ourArray = [
                    'firstname'=>$firstname,
                    'secondname'=>$lastname,
                    'emailaddress'=>$emailaddress,
                    'phonenumber'=>$phonenumber,
                    'regDate' => $regDate,
                    'custID' => $custID,
                    'custDuration' => getDuration($regDate),
                    'duration'=> getMonths($regDate)
                ];
                echo json_encode($ourArray);
            }else{
                echo("Access Denied");
            }
}
$mysqli->close();

function getMonths($arg){ 
    $date1 = strtotime($arg); 
    $date2 = strtotime(date("Y-m-d H:i:s")); 
    $diff = abs($date2 - $date1);
    $years = floor($diff / (365*60*60*24)); 
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $tot = ($years * 12)+($months);
    return $tot;                                
}

function getDuration($param){
    $date3 = strtotime($param); 
    $date4 = strtotime(date("Y-m-d H:i:s")); 
    $diff2 = abs($date4 - $date3);
    $years2 = floor($diff2 / (365*60*60*24)); 
    $months2 = floor(($diff2 - $years2 * 365*60*60*24) / (30*60*60*24)); 
    $days2 = floor(($diff2 - $years2 * 365*60*60*24 - $months2*30*60*60*24)/ (60*60*24));
    return $years2." years ". $months2." months and ".$days2." days"; 
    //return $years;
}
?>