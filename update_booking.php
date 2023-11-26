<?php
require_once "./classes/Parking.class.php";
session_start();

$user = $_SESSION['user'];

$user_id = $user['id'];
$parking = new Parking();



$booking_id = $_GET["b_id"];



$booking = $parking->getBookingById($booking_id);

// $time_from = $booking["time_from"];
// $time_till = $booking["time_till"];
// $place_id = $booking["place_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST)) {
        $place_id = $_POST["place_id"];
        $time_from = $_POST["time_from"];
        $time_till = $_POST["time_till"];

        $parking->updateBooking($time_from, $time_till, $user_id, $place_id, $booking_id);
        $booking = $parking->getBookingById($booking_id);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/booking.css">
    <link rel="stylesheet" href="style/login.css">
    <title>Document</title>
</head>

<body>
    <div class="content-container">
        <h1>Edit Booking</h1>
        <form id="update-form" action="" method="POST">
            <div class="form-group">
                <label for="time_from">Time from:</label>
                <input class="" type="datetime-local" id="time_from" name="time_from" value="<?php echo $booking["time_from"]; ?>">
                <div class="error-box"></div>
            </div>
            <div class="form-group">
                <label for="time_till">Time till:</label>
                <input type="datetime-local" id="time_till" name="time_till" value="<?php echo $booking["time_till"]; ?>">
            </div>
            <div class="form-group">
                <label for="place_id">Parking place</label>
                <input class="" type="number" id="place_id" name="place_id" value="<?php echo $booking["place_id"] ?>">
                <div class="error-box"></div>
            </div>


            <div class="buttons-box">
                <input type="submit" value="Uložiť" name="updateBooking">

                <a class="url-delete-btn" href="" onclick="return confirm('By clicking OK, you will cancel the reservation. \nContinue?');">Cancel reservation</a>

            </div>

        </form>
    </div>
</body>

</html>