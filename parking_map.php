<?php


require_once "./classes/Tools.class.php";
$tools = new Tools();
$parking = new Parking();

$parking_places = $parking->getPlaces();
//$tools->debug($parking_places);



?>

<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/parking_map.css">
    <title>Document</title>
</head>

<body>
    <?php require_once "./components/header.php"; ?>
    <div class="grid-container">

        <?php foreach ($parking_places as $place) : ?>
            <a class="parking-link" href="./booking.php?p_id=<?php echo $place['id'] ?>">

                <div class="grid-item <?php echo $place['is_occupied'] ? 'occupied' : 'available'; ?>">

                    <?php echo $place['login']; ?>
                    <?php echo $place['id']; ?>
                    <?php echo $place['licence_plate']; ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>

</html>