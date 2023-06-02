<?php
session_start();

require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $routeID = $_POST['route'];
  $date = $_POST['date'];
  $departureTime = $_POST['departure-time'];

  insertReservation($routeID, $date, $departureTime);

  // Redirect to viewReservation.php
  $reservationID = getLatestReservationID(getUserId());
  header("Location: viewReservation.php?reservationID=" . $reservationID);
  exit();
}
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Bus Reservation</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      text-align: center;
    }

    h1 {
      margin-top: 50px;
    }

    p {
      margin-bottom: 20px;
    }

    form {
      display: inline-block;
      text-align: left;
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    select,
    input[type="date"],
    input[type="submit"] {
      padding: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h1>Bus Reservation</h1>
  <?php
function getUserId() {
  if (isset($_SESSION['user_id'])) {
      return $_SESSION['user_id'];
  } else {
      return null;
  }
}
  ?>
  <p>Your ID is <?php echo getUserId(); ?>.</p>
  <form id="reservation-form" method='POST'>
    <label for="route">Route:</label>
    <select name="route" id="route">
      <option value="">Select Route</option>
      <?php
      require_once 'functions.php';
      $routes = getRoutes();
      foreach ($routes as $route) {
        echo '<option value="' . $route['RouteID'] . '">' . $route['RouteName'] . '</option>';
      }
      ?>
    </select>
    <br><br>
    <label for="date">Date:</label>
    <input type="date" name="date" id="date">
    <br><br>
    <label for="departure-time">Departure Time:</label>
    <select name="departure-time" id="departure-time" disabled>
      <option value="">Select Departure Time</option>
    </select>
    <br><br>

    <input type="submit" value="Reserve" id="reserve-button">
  </form>

  <script>
    $(document).ready(function() {
      // Disable the departure time select until a route is selected
      $('#route').change(function() {
        if ($(this).val() !== '') {
          $('#departure-time').removeAttr('disabled');
          updateDepartureTimes($(this).val());
        } else {
          $('#departure-time').attr('disabled', true);
          $('#departure-time').html('<option value="">Select Departure Time</option>');
        }
      });

      // Update the departure time select options when the route is changed
      function updateDepartureTimes(routeID) {
        $.ajax({
          url: 'getDepartureTimes.php',
          type: 'POST',
          data: {
            routeID: routeID
          },
          success: function(response) {
            $('#departure-time').html(response);
          }
        });
      }
    });
  </script>
</body>
</html>