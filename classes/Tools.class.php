<?php
session_start();
require_once "Parking.class.php";
class Tools
{
    const noDataSelected = false;
    const numbers = "0123456789";
    const lowerLetters = "abcdefghijklmnopqrstuvwxyz";
    const upperLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    function debug($data, $title = ""): void
    {
        echo "<strong>$title</strong> <br>";
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    function generateRandomString($length): string
    {
        $parking = new Parking();
        $characters = self::numbers . self::lowerLetters;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
