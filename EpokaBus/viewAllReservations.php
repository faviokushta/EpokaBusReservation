<?php
session_start();
require_once 'functions.php';
function getUserId() {
    if (isset($_SESSION['user_id'])) {
        return $_SESSION['user_id'];
    } else {
        return null;
    }
  }
$reservations = getUserReservations(getUserId());

?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservations History</title>
    <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f2f2f2;
      color: #333;
    }
    </style>
</head>
<body>
    <h1>Reservations History</h1>
  
    <?php if (count($reservations) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Route Name</th>
                    <th>Date</th>
                    <th>Time of Departure</th>
                    <th>Cancel Reservation</th>
                    <th>Delete Reservation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?php echo $reservation['ReservationID']; ?></td>
                        <td><?php echo $reservation['RouteName']; ?></td>
                        <td><?php echo $reservation['Date']; ?></td>
                        <td><?php echo $reservation['TimeOfDeparture']; ?></td>
                        <td><a href="cancelReservation.php?ReservationID=<?php echo $reservation['ReservationID']; ?>">Cancel</a></td>
                        <td><a href="deleteReservation.php?ReservationID=<?php echo $reservation['ReservationID']; ?>">Delete from history</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No reservations found.</p>
    <?php endif; ?>
    <p><a href="dashboard.php">Go to Dashboard</a></p>
</body>
</html>