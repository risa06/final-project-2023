<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'smarthome';
$connection = mysqli_connect($host, $user, $pass, $db);
if (mysqli_connect_error()) {
    echo "Can\'t connect to database.";
}

$temperature = mysqli_query($connection,"SELECT temperature FROM datatraining");
$humidity = mysqli_query($connection, "SELECT humidity FROM datatraining");
$light = mysqli_query($connection, "SELECT light FROM datatraining");
$co2 = mysqli_query($connection, "SELECT co2 FROM datatraining");
$occupancy = mysqli_query($connection, "SELECT occupancy FROM datatraining");
$date_time = mysqli_query($connection, "SELECT date_time FROM datatraining");
$date_time2 = mysqli_query($connection, "SELECT date_time FROM datatraining");

$total_records_temperature = mysqli_num_rows($temperature);
$total_records_humidity = mysqli_num_rows($humidity);
$total_records_light = mysqli_num_rows($light);
$total_records_co2 = mysqli_num_rows($co2);
?>