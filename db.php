<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$password = "";
$database = "prumo_tech";

$db = mysqli_connect($host, $user, $password , $database) or die($db);
mysqli_set_charset($db, "utf8mb4");