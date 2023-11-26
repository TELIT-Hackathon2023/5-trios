<?php
session_start();

require_once "./classes/Parking.class.php";

$user = $_SESSION['user'];
$parking = new Parking();

$bookings = $parking->getBookingsByUserId($user['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/my-bookings.css">
    <title>My bookings</title>
</head>

<body>
    <?php require_once "./components/header.php" ?>
    <div class="table-div-heading">
        <h1>My bookings</h1>
    </div>
    <div class="content-container">
        <div class="bookings">
            <?php foreach ($bookings as $booking) : ?>
                <div class="booking">
                    <h2>Spot n. <?= $booking['place_id'] ?></h2>
                    <p>Time from:<?= date('d.m.Y H:i', strtotime($booking['time_from'])) ?></p>
                    <p>Time till:<?= date('d.m.Y H:i', strtotime($booking['time_till'])) ?></p>
                    <a href="./update_booking.php?b_id=<?= $booking['id'] ?>">Edit booking</a>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>