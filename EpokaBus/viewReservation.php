<?php
session_start();
require_once 'functions.php';

$reservationID = $_GET['reservationID'];
$reservation = getReservationDetails($reservationID);
?>
<html>
<head>
    <title>View Reservation</title>
</head>
<body>
    <h1>View Reservation</h1>
    <p>Your reservation details are:</p>
    <ul>
        <li>Reservation ID: <?php echo $reservation['ReservationID']; ?></li>
        <li>Route Name: <?php echo $reservation['RouteName']; ?></li>
        <li>Date: <?php echo $reservation['Date']; ?></li>
        <li>Time of Departure: <?php echo $reservation['TimeOfDeparture']; ?></li>
    </ul>
    <p><a href="dashboard.php">Go to Dashboard</a></p>
</body>
</html>