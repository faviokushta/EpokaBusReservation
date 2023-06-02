<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - Epoka Bus Reservation</title>
  <link rel="stylesheet" type="text/css" href="styles2.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
</head>
<body>
<div class="container">
<img src="logo.png" alt="Logo" class="logo">
  <h1>Welcome to Epoka Bus Reservation!</h1>
<form>
<label for="announcement">Announcement:</label><br>
<textarea id="announcement" rows="4" cols="50" readonly><?php echo file_get_contents("announcement.txt"); ?></textarea>
</form>
  <p>Please select an option to proceed:</p>
  <ul>
    <li><a href="reservation.php">Reserve a Seat</a></li>
    <li><a href="viewAllReservations.php">View/Cancel your Reservations</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="userlogout.php">Log Out</a></li>
  </ul>
</div>
</body>
</html>
