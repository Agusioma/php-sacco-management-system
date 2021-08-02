<?php
require_once "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $emailaddress = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);
        $sql = "SELECT * FROM customers WHERE email = '$emailaddress' AND PhoneNo = '$phone'";
        $stmt = $mysqli->query($sql);
            //if($stmt->num_rows){
                $row = $stmt->fetch_array();
                $NatID = $row['NatID'];
                $sumSql = "SELECT customerID, SUM(january) jan, SUM(february) feb, SUM(march) mar, SUM(april) apr, SUM(may) may, SUM(june) jun, SUM(july) jul, SUM(august) aug, SUM(september) sept, SUM(october) oct, SUM(november) nov, SUM(december) decb FROM savings WHERE customerID = '$NatID' GROUP BY customerID";
                $sumStmt = $mysqli->query($sumSql);
                $sumRow = $sumStmt->fetch_array();
                $totalSav = $sumRow['jan'] + $sumRow['feb'] + $sumRow['mar'] + $sumRow['apr'] + $sumRow['may'] + $sumRow['jun'] + $sumRow['jul'] + $sumRow['aug'] + $sumRow['sept'] + $sumRow['oct'] + $sumRow['nov'] + $sumRow['decb'];
                echo $totalSav;
            /*}else{
                echo(" ".$stmt);
            }*/
    // Close connection
    $mysqli->close();
}
?>