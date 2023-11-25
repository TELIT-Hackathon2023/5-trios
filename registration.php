<?php
session_start();
error_reporting(E_ALL);

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "./PHPMailer/src/Exception.php";
require "./PHPMailer/src/PHPMailer.php";
require "./PHPMailer/src/SMTP.php";

require_once "./classes/Parking.class.php";
require_once "./components/header.php";
require_once "./classes/Tools.class.php";
// require_once "./classes/Mailer.class.php";

$tools = new Tools();
$parking = new Parking();

echo "<br>";
$debbuging = $parking->isDebbuging;
$localhost = $parking->isLocalhost;

$db = $parking->db;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $login = $_POST["login"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $licence_plate = $_POST["licence_plate"];
  $mobile_phone = $_POST["mobile_phone"];
  $personal_id = $_POST["personal_id"];

  $errorsLicencePlate = array();
  $errorsMobilePhone = array();
  $errorsEmail = array();
  $errorslname = array();
  $errorsfname = array();


  if (empty($login)) {
    $errorsEmail[] = 'E-mail is required';
  } else if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
    $errorsEmail[] = 'Invalid e-mail address';
  }


  if (empty($login)) {
    $errorsLogin[] = "Email is required";
  }

  if (empty($fname)) {
    $errorsfname[] = "First name is required";
  }
  if (empty($lname)) {
    $errorslname[] = "Last name is required";
  }
  if (empty($licence_plate)) {
    $errorsLicencePlate[] = "Licence plate ID is required";
  }
  if (empty($mobile_phone)) {
    $errorsMobilePhone[] = "Phone number is required";
  }
  if (empty($personal_id)) {
    $errorsPersonalId[] = "Perosnal ID is required";
  }


  // Validate confirm password
  if ($passwordConfirm == NULL) {
    $errorsPasswordConfirm[] = 'Vyžaduje sa potvrdenie hesla';
  } else if ($password !== $passwordConfirm) {
    $errorsPasswordConfirm[] = 'Heslá sa nezhodujú';
  }

  if (empty($errorsEmail) && empty($errorsfname) && empty($errorslname) && empty($errorsfname) && empty($errorsPlateNumber) && empty($errorsMobilePhone)) {
    $userMsg = "Your login creditials: " . $login;
    $userSub = $fname . " " . $lname;


    $password = $tools->generateRandomString(10);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $parking->addUser($fname, $lname, $login, $mobile_phone, $personal_id, $licence_plate, $password_hash);

    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                           //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'trios9371@gmail.com';                     //SMTP username
      $mail->Password   = 'trios201523';                               //SMTP password
      $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('trios9371@gmail.com', 'test');
      $mail->addAddress($login);
      $mail->addReplyTo('trios9371@gmail.com');

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'login creditials';
      $mail->Body    =  "Login: " . $login . "<br>" . "From: " . $password;
      $mail->AltBody = 'login credits';

      $mail->send();
      echo 'Message has been sent';
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


    // Redirect to the login page
    //header('Location: login.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <link rel="stylesheet" href="./style/global.css" async>
  <link rel="stylesheet" href="./style/registration.css" async>
  <title>Registrácia - Parking spots</title>

</head>

<body>
  <div class="form-section">
    <form class="registration-form" id="registration-form" onsubmit="return validateForm()" method="POST">
      <h1 class="heading">Registrácia</h1>

      <label class="form-label" for="fname">Name</label>
      <input class="form-input" type="text" name="fname" id="fname" placeholder="Name" value="<?= $_POST['fname'] ?>">
      <div class="error-box-login"><?php foreach ($errorsfname as $error) {
                                      echo $error . "<br>";
                                    } ?></div>

      <label class="form-label" for="lname">Surname</label>
      <input class="form-input" type="text" name="lname" id="lname" placeholder="Surname">
      <div class="error-box-surname"><?php foreach ($errorslname as $error) {
                                        echo $error . "<br>";
                                      } ?></div>

      <label class="form-label" for="login">Email</label>
      <input class="form-input" type="email" name="login" id="email" placeholder="Email">
      <div class="error-box-email"><?php foreach ($errorsEmail as $error) {
                                      echo $error . "<br>";
                                    } ?></div>

      <label class="form-label" for="mobile_phone">Mobile number</label>
      <input class="form-input" type="tel" name="mobile_phone" id="mobile_phone" placeholder="Phone number">
      <div class="error-box-mobile-phone"><?php foreach ($errorsMobilePhone as $error) {
                                            echo $error . "<br>";
                                          } ?></div>
      <label class="form-label" for="personal_id">Plate number</label>
      <input class="form-input" type="text" name="personal_id" id="personal_id" placeholder="Personal ID">
      <div class="error-box-mobile-phone"><?php foreach ($errorsPersonalId as $error) {
                                            echo $error . "<br>";
                                          } ?></div>


      <label class="form-label" for="plate">Plate number</label>
      <input class="form-input" type="text" name="licence_plate" id="licence_plate" placeholder="Plate number">
      <div class="error-box-mobile-phone"><?php foreach ($errorsLicencePlate as $error) {
                                            echo $error . "<br>";
                                          } ?></div>




      <input type="submit" class="confirm-btn" value="Zaregistrovať sa">


      <p>Ste už zaregistrovaný?<a href="./login"> Prihlásenie</a></p>
    </form>
  </div>

</body>

</html>


<?php

if ($debbunging) {
  $tools->debug($_SESSION, "SESSION");

  $tools->debug($_POST, "POST");
}
?>