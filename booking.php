<?php

session_start();
error_reporting(E_ERROR);
require_once "./classes/Tools.class.php";

$tools = new Tools();
$parking = new Parking();
$user = $_SESSION['user'];
$parking_places = $parking->getPlaces();
$parking_id = $_GET["p_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //$parking_id = $_POST["parking_id"];
    $time_from = $_POST["time_from"];
    $time_till = $_POST["time_till"];
    $user_id = $user['id'];
    $parking->createBooking($time_from, $time_till, $user_id, $parking_id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="style/booking.css">
    <link rel="stylesheet" href="style/header.css">
</head>

<body>
    <?php require_once "./components/header.php" ?>
    <div class="content-container">


        <div class="form-section">
            <form class="login-form" onsubmit="return validateForm()" method="POST">
                <h1 class="heading">Booking: Parking spot n. <?= $parking_id ?></h1>
                <div class="form-group">
                    <!-- <label class="form-label" for="parking_place">Vyber parkovacieho miesta: </label>
                    <select id="parking_place" name="parking_id">
                        <?php foreach ($parking_places as $parking_place) : ?>
                            <option value="<?php echo $parking_place['id'] ?>"> <?php echo "Cislo: " . $parking_place['id'] ?> </option>
                        <?php endforeach; ?>


                    </select> -->
                </div>

                <div class="form-group">
                    <label class="form-label" for="time_from">Select time from:</label>
                    <input class="form-input date" type="datetime-local" name="time_from" id="time_from">

                </div>
                <div class="form-group">
                    <label class="form-label" for="time_till">Select time till:</label>
                    <input class="form-input date" type="datetime-local" name="time_till" id="time_till">

                </div>
                <button class="confirm-btn">Create Reservation</button>


            </form>
        </div>
    </div>
</body>

</html>