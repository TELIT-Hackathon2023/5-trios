<?php
error_reporting(E_ERROR);
session_start();
require_once "./components/header.php";
require_once "./classes/Tools.class.php";
require_once "./classes/Parking.class.php";

$tools = new Tools();
$parking = new Parking();



// $localhost = $parking->isLocalhost;

// if (isset($_POST["url"])) {
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .error-box {
            color: red;
        }
    </style>
    <!-- <link rel="preload" as="font"> -->
    <!-- <link rel="manifest" href="./manifest.json"> -->

    <meta charset="UTF-8">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/global.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/home.css">
    <script src="./js/burger.js"></script>
    <title>Parking app</title>
</head>

<body>

</body>

</html>



<!-- <?php
        require_once "./components/footer.php";
        ?> -->