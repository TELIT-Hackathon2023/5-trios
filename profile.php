<?php
error_reporting(E_ERROR);
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /login");
}
require_once "./classes/Parking.class.php";


$parking = new Parking();

$user = $_SESSION['user'];
$fname = $user['fname'];
$lname = $user['lname'];
$email = $user['login'];
$mobile_phone = $user['mobile_phone'];
$licence_plate = $user['licence_plate'];

$name = $fname . " " . $lname;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = $user['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobile_phone =  $_POST['mobile_phone'];
    $licence_plate =  $_POST['licence_plate'];

    $stmt = $parking->db->prepare("UPDATE users SET fname=:fname, lname=:lname, mobile_phone=:mobile_phone, licence_plate=:licence_plate WHERE login=:login");
    $stmt->bindParam(":fname", $fname);
    $stmt->bindParam(":lname", $lname);
    $stmt->bindParam(":login", $email);
    $stmt->bindParam(":mobile_phone", $mobile_phone);
    $stmt->bindParam(":licence_plate", $licence_plate);
    $stmt->execute();

    $user = $parking->getUserByEmail($email);
    $_SESSION['user'] = $user;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .content-container {
            min-height: 80vh;
        }
    </style>
    <meta name="description" content="Update your personal information on our URL shortener site. Change your name and last name to keep your profile up-to-date and relevant. Easy to use interface for managing your personal details.">
    <link rel="shortcut icon" type="image/x-icon" href="media/favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/profile.css">
    <title>Parking - profile</title>
</head>

<body>
    <?php require_once "./components/header.php"; ?>
    <div class="content-container">

        <div class="profile">
            <form action="" id="profile-form" method="POST">
                <label for="fname">First name: </label>
                <input type="text" name="fname" value="<?php echo $fname ?>">

                <label for="lname">Last name: </label>
                <input type="text" name="lname" value="<?php echo $lname ?>">



                <label for="mobile_phone">Phone number: </label>
                <input type="text" name="mobile_phone" value="<?php echo $mobile_phone ?>">

                <label for="licence_plate">Licence plate: </label>
                <input type="text" name="licence_plate" value="<?php echo $licence_plate ?>">


                <label for="login">Email: </label>
                <input type="text" name="login" value="<?php echo $email ?>" disabled> <br>


                <input type="submit" value="Upraviť">
            </form>
        </div>
    </div>
    <?php require_once "./components/footer.php" ?>
</body>

</html>