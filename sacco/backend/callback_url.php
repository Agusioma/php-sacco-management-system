<?php
require_once "connection.php";
date_default_timezone_set('Africa/Nairobi');
  $stkCallbackResponse = file_get_contents('php://input');
  $arr = json_decode($stkCallbackResponse, true);

  $determinant = $arr["Body"]["stkCallback"]["ResultCode"];
  
  if($determinant=='0'){
        $msisd = $arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"];

        $today = date("F");
        $month = strtolower($today);
        $date = date("d-m-Y g:i a");
        $currYear = date("Y");
        $amountReceived = $arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"];
        $transID = $arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"];

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
  /*$logFile = "stkPushCallbackResponse.json";
  $log = fopen($logFile, "a");
  fwrite($log, $stkCallbackResponse);
  fclose($log);*/