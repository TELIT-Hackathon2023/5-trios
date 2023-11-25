<?php
error_reporting(E_ERROR);
session_start();

unset($_SESSION["user"]);
header("location: ./login");
