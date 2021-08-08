<?php

require_once "connection.php";
date_default_timezone_set('Africa/Nairobi');
  $stkCallbackResponse = file_get_contents('php://input');
  $arr = json_decode($stkCallbackResponse, true);

  $determinant = 0;//$arr["Body"]["stkCallback"]["ResultCode"];
  
  if($determinant=='0'){
        $msisd = 254702277060;//$arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"];

        $today = date("F");
        $month = strtolower($today);
        $date = date("d-m-Y g:i a");
        $currYear = date("Y");
        $amountReceived = 230;//$arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"];
        $transID = "GK6FTU985";//$arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"];

        $sql = "SELECT * FROM customers WHERE PhoneNo='$msisd'";
        if($result = $mysqli->query($sql)){
            if($result->num_rows > 0){
                $row = $result->fetch_array();
                $customerID = $row['NatID'];
                    $idSql = "SELECT * FROM savings WHERE customerID = '$customerID'";
                    if($idResult = $mysqli->query($idSql)){
                        if($idResult->num_rows > 0){
                            $row = $idResult->fetch_array();
                            $currentSavings = $row[$month];
                            $amountToSave = $currentSavings + $amountReceived;
                            $uQuery = "UPDATE savings SET $month='$amountToSave' WHERE customerID='$customerID'";
                            $mysqli->query($uQuery); 

                            $savingTransactionA = "INSERT INTO transactions (customerID, transID, transType, amount, transDate) VALUES (?, ?, ?, ?, ?)";
                            $transStatement = $mysqli->prepare($savingTransactionA);
                                // Bind variables to the prepared statement as parameters
                                $transStatement->bind_param("sssss", $param1, $param2, $param3, $param4, $param5);
                                $param1 = $customerID;
                                $param2 = $transID;
                                $param3 = "DEPOSIT";
                                $param4 = $amountReceived;
                                $param5 = $date;
                                // Attempt to execute the prepared statementphone
                                $transStatement->execute();
                            // Close statement
                            $transStatement->close();
                        }else{
                          $savingSql = "INSERT INTO savings (customerID, $month, currYear) VALUES (?, ?, ?)";
                          $stmt = $mysqli->prepare($savingSql);
                              // Bind variables to the prepared statement as parameters
                              $stmt->bind_param("sss", $param1, $param2, $param3);
                              $param1 = $customerID;
                              $param2 = $amountReceived;
                              $param3 = $currYear;
                              // Attempt to execute the prepared statementphone
                              $stmt->execute();
                              $from = "contact@sacco.terrence-aluda.com";
                              $to = $row['email'];
                              $subject = "DEPOSIT TRANSACTION DETAILS";
                              $message = "Hello ";//.$row['firstname']." ".$row['lastname'].",\n You have successfully deposited Ksh. ".$amountReceived." into your T-Bank Savings account. \nIf you did not initiate this transaction, please reply to this email as soon as possible.\n Regards,\nT-Bank Support.\n";
                              $headers = $from;
                              mail($to, $subject, $message, $headers);
                          // Close statement
                          $stmt->close();

                          $savingTransaction = "INSERT INTO transactions (customerID, transID, transType, amount, transDate) VALUES (?, ?, ?, ?, ?)";
                          $transStatement = $mysqli->prepare($savingTransaction);
                              // Bind variables to the prepared statement as parameters
                              $transStatement->bind_param("sssss", $param1, $param2, $param3, $param4, $param5);
                              $param1 = $customerID;
                              $param2 = $transID;
                              $param3 = "DEPOSIT";
                              $param4 = $amountReceived;
                              $param5 = $date;
                              // Attempt to execute the prepared statementphone
                              $transStatement->execute();

                          // Close statement
                          $transStatement->close();
                        }
                      }
            }
          }else{
            $logFile = "stkPushCallbackResponse.json";
            $log = fopen($logFile, "a");
            fwrite($log, $mysqli->error);
            fclose($log);
          }
  
    }else{
  $logFile = "stkPushCallbackResponse.json";
  $log = fopen($logFile, "a");
  fwrite($log, "Error in transaction");
  fclose($log);
    }

/*
                              $from = 'contact@sacco.terrence-aluda.com';
                              $ourDetails = 'AMOUNT: Ksh.100 \nTRANSACTION ID: xcxcxc \nTIME: ggggg \nCATEGORY: DEPOSIT\n';
                              $to      = 'terryterrence200@gmail.com';
                              $subject = 'DEPOSIT TRANSACTION DETAILS';
                              //$message = 'Hello you you ,\nYou have successfully deposited Ksh. 100 into your JUJA BUSINESS COMMUNITY SACCO Savings account. Here are the details: \n'.$ourDetails.'If you did not initiate this transaction, please reply to this email as soon as possible.\n Regards,\nJBCS Support.\n';
                              $message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>Hello ".$to.",</p>
<div class='d-flex align-items-center justify-content-center vw-100 vh-100' style='padding-bottom: 3vh'>
<div  class='card container' style='min-width: 90vw'>                
    <div class='card-body row'style='min-width: 90vw;'>
    <div class='col-md-12  d-flex align-items-center justify-content-center'>                
                <div class='card-body' style=' max-width: 95vw;'>  
                <div class='mb-1'>
                      <div class='d-flex vw-50' style='text-align: left'>
                        <h5 style='color: rgb(0,128,129)'>AMOUNT:&nbsp;</h5><h6 id='myName' style='color: black'>".$amountReceived."</h6>
                      </div>
                </div>
                <div class='mb-1'>
                      <div class='d-flex vw-50' style='text-align: left'>
                        <h5 style='color: rgb(0,128,129)'>TRANSACTION ID:&nbsp;</h5><h6 id='myName' style='color: black'>".$transID."</h6>
                      </div>
                </div>
                <div class='mb-1'>
                      <div class='d-flex vw-50' style='text-align: left'>
                        <h5 style='color: rgb(0,128,129)'>DATE & TIME:&nbsp;</h5><h6 id='myName' style='color: black'>".$date."</h6>
                      </div>
                </div>
                <div class='mb-1'>
                      <div class='d-flex vw-50' style='text-align: left'>
                        <h5 style='color: rgb(0,128,129)'>CATEGORY:&nbsp;</h5><h6 id='myName' style='color: black'>DEPOSIT</h6>
                      </div>
                </div>                                                                     
        </div>
    </div>
    </div>            
    </div>
</div>    
</div>
</body>
</html>
";
                              ///$headers = $from;
                              $headers = 'MIME-Version: 1.0' . "\r\n";
                              $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
                              
                              // More headers
                              $headers .= 'From: '.$from. "\r\n";
                              mail($to, $subject, $message, $headers);
                              /*
                              $from = 'contact@sacco.terrence-aluda.com';
                              $ourDetails = 'AMOUNT: '.$amountReceived.'\nTRANSACTION ID: '.$transID.'\nTIME: '.$date.'\nCATEGORY: DEPOSIT\n';
                              $to      = $row['email'];
                              $subject = 'DEPOSIT TRANSACTION DETAILS';
                              $message = 'Hello '.$row['firstname'].' '.$row['secondname'].',\n You have successfully deposited Ksh. '.$amountReceived.' into your JUJA BUSINESS COMMUNITY SACCO Savings account. Here are the details: \n'.$ourDetails.'If you did not initiate this transaction, please reply to this email as soon as possible.\n Regards,\nJBCS Support.\n';
                              $headers = $from;

                              mail($to, $subject, $message, $headers);
                              */
?>