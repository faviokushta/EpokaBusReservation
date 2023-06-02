<?php
session_start();
require_once 'functions.php';

$reservations = displayReservations('2', "12:55");

echo "<p>Number of reservations for this route today: " . count($reservations) . "</p>";

echo "<form method='post'>";
echo "<table>";
echo "<tr><th>Reservation ID</th><th>Full Name</th><th>Check</th></tr>";
$checkedReservations = array();
if (isset($_SESSION['checked'])) {
  $checkedReservations = $_SESSION['checked'];
}
foreach ($reservations as $reservation) {
    echo "<tr>";
    echo "<td>" . $reservation['reservationID'] . "</td>";
    echo "<td>" . $reservation['FullName'] . "</td>";
    if (in_array($reservation['reservationID'], $checkedReservations)) {
        echo "<td><input type='checkbox' name='check[]' value='" . $reservation['reservationID'] . "' checked></td>";
      } else {
        echo "<td><input type='checkbox' name='check[]' value='" . $reservation['reservationID'] . "'></td>";
      }      
    echo "</tr>";
}
echo "</table>";
echo "<input type='submit' name='submit' value='Save'>";
echo "</form>";
echo "<a href='adminpage.php'>Go back to Admin Dashboard</a>";
if (isset($_POST['submit'])) {
    if (isset($_POST['check'])) {
        $_SESSION['checked'] = $_POST['check'];
    } else {
        unset($_SESSION['checked']);
    }
}
?>