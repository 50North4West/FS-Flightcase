<?php

  /*  function for sending emails - to send an email use:
  /
  /   $email = sendMail($addresses, $subject, $htmlBody, $altBody);
  /   function will return true or false
  /
  /   addresses should be an associative array with format
  /   $addresses = array("joebloggs@gmail.com" => "Joe Bloggs", "fredsmith@gmail.com" => "Fred Smith");
  */

  //import PHPMailer classes into the global namespace
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  function sendMail($addresses, $subject, $htmlBody, $altBody) {

    try {
      //load the PHPMailer files
      require_once APPROOT.'/externalLibs/PHPMailer/src/PHPMailer.php';
      require_once APPROOT.'/externalLibs/PHPMailer/src/SMTP.php';
      require_once APPROOT.'/externalLibs/PHPMailer/src/Exception.php';

      //instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      //mail settings - defined in config
      $mail->isSMTP();                                    // Send using SMTP
      $mail->Host       = EMAILSMTPHOST;                  // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                           // Enable SMTP authentication
      $mail->Username   = EMAILUSERNAME;                  // SMTP username
      $mail->Password   = EMAILPASSWORD;                  // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = EMAILPORT;                      // TCP port to connect to

      //set from and too addresses
      $mail->setFrom(EMAILSETFROMADDRESS, EMAILSETFROMNAME);          // From address

      //loop through the $addresses and add the address
      foreach ($addresses as $emailAddress => $name) {
        $mail->addAddress($emailAddress, $name);
      }

      //set the content of the email
      $mail->isHTML(true);                                // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $htmlBody;
      $mail->AltBody = $altBody;

      //send the email
      $mail->send();
      return true;

    } catch (Exception $e) {
      return false;
    }

  }
