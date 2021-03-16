<?php
	$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
	$tokenUrl = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

	$consumerKey = 'ZDQ2HRlEglcqwijP5SDCYFVAh2KM9bXj'; //Fill with your app Consumer Key
	$consumerSecret = 'nOxTzXoBC2nx8Y9M'; // Fill with your app Secret

	$headers = ['Content-Type:application/json; charset=utf8'];

	$tokenCurl = curl_init($tokenUrl);
	curl_setopt($tokenCurl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($tokenCurl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($tokenCurl, CURLOPT_HEADER, FALSE);
	curl_setopt($tokenCurl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
	$result = curl_exec($tokenCurl);
	$status = curl_getinfo($tokenCurl, CURLINFO_HTTP_CODE);
	$result = json_decode($result);

	$access_token = $result->access_token;
	curl_close($tokenCurl);
 // check the mpesa_accesstoken.php file for this. No need to writing a new file here, just combine the code as in the tutorial.
	$shortCode = '174379'; // provide the short code obtained from your test credentials

	/* This two files are provided in the project. */
	$confirmationUrl = 'https://sacco.terrence-aluda.com/confirmation_url.php'; // path to your confirmation url. can be IP address that is publicly accessible or a url
	$validationUrl = 'https://sacco.terrence-aluda.com/validation_url.php'; // path to your validation url. can be IP address that is publicly accessible or a url



	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


	$curl_post_data = array(
	  //Fill in the request parameters with valid values
	  'ShortCode' => $shortCode,
	  'ResponseType' => 'Confirmed',
	  'ConfirmationURL' => $confirmationUrl,
	  'ValidationURL' => $validationUrl
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	print_r($curl_response);

	echo $curl_response;
?>
