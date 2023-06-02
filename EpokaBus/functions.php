<?php
require_once 'config.php';

function getRoutes() {
    global $db;
    $routes = array();
    $query = "SELECT * FROM Routes";
    $result = $db->query($query);
    while ($row = $result->fetch_assoc()) {
        $routes[] = $row;
    }
    return $routes;
}

function getDepartureTimes($routeId) {
    global $db;
    $departureTimes = array();
    $stmt = $db->prepare("SELECT DepartureTimes FROM Routes WHERE RouteID = ?");
    $stmt->bind_param('i', $routeId);
    $stmt->execute();
    $stmt->bind_result($departureTimesJson);
    $stmt->fetch();
    $departureTimes = json_decode($departureTimesJson, true);
    return $departureTimes;
}

function insertReservation($routeID, $date, $departureTime) {
    global $db;
    $userID = getUserId();
    $stmt = $db->prepare('INSERT INTO Reservations (UserID, RouteID, Date, TimeOfDeparture) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('iiss', $userID, $routeID, $date, $departureTime);
    $stmt->execute();
    $stmt->close();
  }

  function getLatestReservationID($userID) {
    global $db;
    $stmt = $db->prepare("SELECT ReservationID FROM reservations WHERE UserID = ? ORDER BY ReservationID DESC LIMIT 1");
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $stmt->bind_result($reservationID);
    $stmt->fetch();
    $stmt->close();
    return $reservationID;
}

  function getReservationDetails($reservationID) {
    global $db;
    $stmt = $db->prepare("SELECT r.ReservationID, rt.RouteName, r.Date, r.TimeOfDeparture FROM Reservations r JOIN Routes rt ON r.RouteID = rt.RouteID WHERE r.ReservationID = ?");
    $stmt->bind_param('i', $reservationID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
      $reservation = $result->fetch_assoc();
      return $reservation;
    } else {
      return null;
    }
  }
  
  function getUserReservations($userID) {
    global $db;
    $reservations = array();
    $query = "SELECT r.ReservationID, rt.RouteName, r.Date, r.TimeOfDeparture FROM Reservations r JOIN Routes rt ON r.RouteID = rt.RouteID WHERE r.UserID = ? ORDER BY r.ReservationID DESC";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
    return $reservations;
}

  function cancelReservation($reservationID) {
    global $db;
    $stmt = $db->prepare("DELETE FROM Reservations WHERE ReservationID = ?");
    $stmt->bind_param('i', $reservationID);
    $stmt->execute();
    $stmt->close();
  }

  function displayReservations($routeID, $timeOfDeparture) {
    global $db;

    // Get today's date in YYYY-MM-DD format
    $today = date('Y-m-d');

    // Define SQL query with placeholders
    $query = "SELECT r.reservationID, u.FullName 
              FROM Reservations r 
              JOIN Users u ON r.UserID = u.UserID 
              WHERE r.date = ? 
              AND r.routeID = ? 
              AND r.timeOfDeparture = ?";

    // Prepare statement and bind parameters
    $stmt = $db->prepare($query);
    $stmt->bind_param("sss", $today, $routeID, $timeOfDeparture);
    $stmt->execute();
    // Get result set and store reservations in array
    $reservations = array();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
    // Close statement
    $stmt->close();
    return $reservations;
}
?>