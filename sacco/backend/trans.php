<?php
require_once "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $phone = trim($_POST["pn"]);

        $sql = "SELECT * FROM customers WHERE PhoneNo = '$phone'";
        $stmt = $mysqli->query($sql);
            if($stmt->num_rows>0){
                $id_row = $stmt->fetch_array();
                $natID = $id_row['NatID'];                                          
            }
        
        $sql = "SELECT * FROM transactions WHERE customerID = '$natID'";
        $stmt = $mysqli->query($sql);
            if($stmt->num_rows>0){
                while($row = $stmt->fetch_array()){
                $transID = $row['transID'];   
                $transType = $row['transType'];  
                $amount = $row['amount'];
                $transDate = $row['transDate'];    
                ?>
                 <tr style="background-color: #035050">
                    <td class="text-white"><?php echo $transID; ?></td>
                    <td class="text-white" style="text-align: center"><?php echo $transType; ?></td>
                    <td style="text-align: center; color: #0af53a"><?php echo $amount; ?></td>
                    <td class="text-white" style="text-align: center;"><?php echo $transDate; ?></td>
                 </tr>
                
                <?php 
                }                                     
            }else{
                ?>
                <div class="d-flex align-items-center justify-content-center vw-70 vh-70">
                <br><br><br>
                    <h5 class="text-white">No transactions done yet</h5>
                </div>
                <?php
            }
    // Close connection
    $mysqli->close();
}
?>