<?php
  // Sending mail

  $subject = "Appointment payment recieved";
  $message = "A payment has been Recieved for your appointment at SNH ";
  $headers = "From: no-reply@sng.com" . "\r\n" .
	 "CC: somebodyelse@example.com";

  mail($email, $subject, $message, $headers);

header("Location: patient.php");
