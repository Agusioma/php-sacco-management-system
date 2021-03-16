<?php

  /* Urls */
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';


  /* Required Variables */
  $consumerKey = 'AGGijdlTiicmpGzZ7surz7MAGhvMEZMT';        # Fill with your app Consumer Key
  $consumerSecret = 'tgi6NbzjqWWaHBmn';     # Fill with your app Secret
  $headers = ['Content-Type:application/json; charset=utf8'];
  
  /* from the test credentials provided on you developers account */
  $InitiatorName = 'mpesa';      # Initiator
  $SecurityCredential = 'B9leCbAEAmd96BZ2igohIDUeaFVDPFIF4Ch7/gXiZdslT7WfHpQVSM3nZmeKYgiqbpaAIFo9pYjoeaA+pd1IpRl0Hgauv8/G1FqGQGlCXdj1USzCQnhrVAtlh8+Y3YAtBAbUKTfs42RPFwJMZsuFVHjjAiG3iJAgS4gsulU47+Su9Nv7o1k7KNScrSu+3+6wghT84Gi84tEvT1P1XBs9FJDsQbcrjebggf0Qg14kMtauwGjCNA/TKGEV8tTnW0AzhGhOx2TAgeP43uvA1ccWB0eQdz+jlntQRc4WcRtzpdc7A4cOaOwTkO6QO0IlB3X2xF6MyKiFq6PIHqLiEZJXKQ=='; 
  $CommandID = 'BusinessPayment';          # choose between SalaryPayment, BusinessPayment, PromotionPayment 
  $Amount = '1';
  $PartyA = '174379';             # shortcode 1
  $PartyB = '254757153404';             # Phone number you're sending money to
  $Remarks = 'Withdrawal';      # Remarks ** can not be empty
  $QueueTimeOutURL = 'https://sacco.terrence-aluda.com/B2CResultURL.php';    # your QueueTimeOutURL
  $ResultURL = 'https://sacco.terrence-aluda.com/B2CResultURL.php';          # your ResultURL
  $Occasion = 'Withdrawal';           # Occasion

  /* Obtain Access Token */
  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;
  curl_close($curl);

  /* Main B2C Request to the API */
  $b2cHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $b2c_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $b2cHeader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'InitiatorName' => $InitiatorName,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $ResultURL,
    'Occasion' => $Occasion
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  echo $curl_response;
?>
