<?php

use function PHPSTORM_META\sql_injection_subst;

$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];

var_dump($name, $phone, $email);

$host = "localhost:8080";
$dbname = "message_db";
$name = "root";
$phone = "root";
$email = "root";
$conn = mysqli_connect($host, $name, $phone, $email, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_errno());
}

$sql = "INSERT INTO message (name, phone, email, loaction)
        VALUE (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssss", $name, $phone, $email, $location);

mysqli_stmt_execute($stmt);

echo "Record saved.";
