<?php
session_start();

require_once('functions/token.php');




// 
if (isset($_POST['pay'])) {

	$full_Name = $_POST['full_Name'];
	$email =  $_POST['email'];
	$amount =  $_POST['amount'];
	$payment_option =  $_POST['payment_option'];
	
	
}

$_SESSION['full_Name'] = $full_Name;
$_SESSION['email'] = $email;
$_SESSION['amount'] = $amount;

$_SESSION['currency'] = $currency;
$_SESSION['txref'] = $token;
$_SESSION['email'] = $email;



$curl = curl_init();

$customer_email = $email;
$amount =  $amount;
$currency = "NGN";

$token = generate_token();


$txref = $token; // ensure you generate unique references per transaction.
$PBFPubKey = "FLWPUBK_TEST-e28318e00f3408899ba03b4a681046e1-X"; // get your public key from the dashboard.
$redirect_url = "https://localhost/snh-v1/success.php/";


curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode([
		'amount' => $amount,
		'customer_email' => $customer_email,
		'currency' => $currency,
		'txref' => $txref,
		'PBFPubKey' => $PBFPubKey,
		'redirect_url' => $redirect_url,
		'payment_options' => $payment_option,
	]),
	CURLOPT_HTTPHEADER => [
		"content-type: application/json",
		"cache-control: no-cache"
	],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
	// there was an error contacting the rave API
	die('Curl returned error: ' . $err);
}

$transaction = json_decode($response);

if (!$transaction->data && !$transaction->data->link) {
	// there was an error from the API
	print_r('API returned error: ' . $transaction->message);
}

// uncomment out this line if you want to redirect the user to the payment page
//print_r($transaction->data->message);


// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $transaction->data->link);
