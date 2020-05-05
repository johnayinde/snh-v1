<?php
session_start();
require_once('functions/users.php');

/**
 * validation begin
 */









/**
 *  validation ends
 */




if (isset($_GET['txref'])) {
  $ref = $_GET['txref'];

  $amount = "5000"; //Correct Amount from Server
  $currency = "NGN"; //Correct Currency from Server

  $query = array(
    "SECKEY" => "FLWSECK_TEST-9fd8cb0880ea1125ee187d5156597684-X",
    "txref" => $ref
  );

  $data_string = json_encode($query);

  $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

  $response = curl_exec($ch);

  $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $header = substr($response, 0, $header_size);
  $body = substr($response, $header_size);

  curl_close($ch);

  $resp = json_decode($response, true);

  $paymentStatus = $resp['data']['status'];
  $chargeResponsecode = $resp['data']['chargecode'];
  $chargeAmount = $resp['data']['amount'];
  $chargeCurrency = $resp['data']['currency'];
  $paymenttype = $resp['data']['paymenttype'];
  $full_Name = $_SESSION['full_Name'];
  $email = $_SESSION['email'];
  
  $transObj = [
    'full_Name' => $full_Name,
    'email' => $email,
    'currency' =>  $chargeCurrency,
    'amount' => $chargeAmount,
    'status' => $paymentStatus,
    'type' => $paymenttype,
    'Ref' => $ref,
    'date' => date("d/m/y")
  ];

  if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
    //  update database for payment made for admin to see who paid
    // user see success payment also on email
    // user get list of transation history
    // medical team see who made payment

    add_transaction($transObj);
    
    // Sending mail

    $subject = "Appointment payment recieved";
    $message = "A payment has been Recieved for your appointment at SNH ";
    $headers = "From: no-reply@sng.com" . "\r\n" .
      "CC: somebodyelse@example.com";

    $try = mail($email, $subject, $message, $headers);
    $_SESSION['message'] = "Payment Made Successfully ";


    header("Location: patient.php");
    die();

  } else {

    // header("Location: failed.php");
  }
}