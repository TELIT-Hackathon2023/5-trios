<?php
session_start();
error_reporting(E_ERROR);
require_once "./components/header.php";
require_once "./classes/Parking.class.php";
require_once "./classes/Tools.class.php";

unset($_SESSION["resetPassEmail"]);

$parking = new Parking();
$tools = new Tools();

$localhost = $parking->isLocalhost;

$db = $parking->db;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $errorsLogin = array();
    $errorsPass = array();


    if ($login == "") {
        $errorsLogin[] = 'E-mail je povinný';
    } elseif (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $errorsLogin[] = 'Neplatný formát e-mailu';
    }
    if ($password == "") {
        $errorsPass[] = 'Heslo je povinné';
    }

    // if (empty($errorsLogin) && empty($errorsPass)) {
    //     $user = $parking->getUserByEmail($login);


    //     if ($user != NULL) {
    //         if (password_verify($password, $user["passwordHash"])) {
    //             $parking->updateUsersUrlCodeLen($user['login']);
    //             $_SESSION["user"] = $user;
    //             //header("Location: loginsuccess.php");
    //         } else {
    //             $errorsPass[] = "Nesprávny e-mail alebo heslo";
    //         }
    //     } else {
    //         $errorsPass[] =  'Nesprávny e-mail alebo heslo';
    //     }
    // }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Log in to your Parking.sk account to start shortening your URLs and tracking their performance.">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="810277182068-isr3am82erucdf9nptm0opqq176ap40e.apps.googleusercontent.com">
    <!-- <link rel="stylesheet" href="style/registration-form.css"> -->
    <!-- <link rel="stylesheet" href="style/global.css"> -->
    <link rel="stylesheet" href="style/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">

    <title>Parking - prihlásenie</title>
</head>

<body>
    <div class="content-container">


        <?php if (!$_SESSION["user"]) : ?>
            <div class="form-section">
                <form class="login-form" onsubmit="return validateForm()" method="POST">
                    <h1 class="heading">Prihlásenie</h1>
                    <div class="form-group">
                        <label class="form-label" for="login">Email</label>
                        <input class="form-input" type="email" name="login" id="login" placeholder="Enter your email" value="<?= $user['login'] ?>">
                        <div class="error-box-mail"><?php foreach ($errorsLogin as $error) {
                                                        echo $error . "<br>";
                                                    } ?></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Heslo</label>
                        <input class="form-input" type="password" name="password" id="password" placeholder="Zadajte vaše heslo">
                        <div class="error-box-pass"><?php foreach ($errorsPass as $error) {
                                                        echo $error . "<br>";
                                                    } ?></div>
                    </div>
                    <a class="pass-change-btn" href="./resetPass.php">Zabudli ste heslo?</a>
                    <button class="confirm-btn">Prihlásiť sa</button>


                    <p>Nemáte vytvorený účet? <a href="./registration">Registrovať</a></p>
                </form>
            </div>
        <?php elseif ($_SESSION["user"]) : ?>
            <?php header("Location: ./"); ?>
            <h1>Si prihlaseny ako <?php echo $_SESSION["user"]["login"] ?></h1>
            <a class="logout" href="./logout.script.php">Od</a>
        <?php endif; ?>
        <div class="info-section">
        </div>
    </div>
</body>

</html>


<script>
    function validateForm() {
        var email = document.getElementById("login").value;
        var password = document.getElementById("password").value;
        var emailValid = true;
        var passwordValid = true;

        // Validate email
        if (!email) {
            // Email is empty
            document.getElementById("login").style.borderColor = "red";
            document.querySelector(".error-box-mail").innerHTML = "E-mail je povinný";
            emailValid = false;
        } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
            // Email is invalid
            document.getElementById("login").style.borderColor = "red";
            document.querySelector(".error-box-mail").innerHTML = "E-mail má nesprávny formát";
            emailValid = false;
        } else {
            // Email is valid
            document.getElementById("login").style.borderColor = "";
            document.querySelector(".error-box-mail").innerHTML = "";
        }

        // Validate password
        if (!password) {
            // Password is empty
            document.getElementById("password").style.borderColor = "red";
            document.querySelector(".error-box-pass").innerHTML = "Heslo je povinné";
            passwordValid = false;
        } else {
            // Password is valid
            document.getElementById("password").style.borderColor = "";
            document.querySelector(".error-box-pass").innerHTML = "";
        }

        return emailValid && passwordValid;
    }
</script>
<?php
if ($debbunging) {
    $tools->debug($_SESSION, "SESSION");

    $tools->debug($_POST, "POST");
}
?>