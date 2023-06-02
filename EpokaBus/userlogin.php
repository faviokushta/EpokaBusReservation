<?php
include("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  
  $query = "SELECT * FROM Users WHERE SchoolEmail = '$email'";
  $result = mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($result);
  
  if($row) {
    if($password == $row['Password']) {
      session_start();
      $_SESSION['user_id'] = $row['UserID'];
      $_SESSION['user_name'] = $row['FullName'];
      session_regenerate_id();
      header("Location: dashboard.php");
      exit();
    } else {
      $error = "Invalid email or password.";
    }
  } else {
    $error = "Invalid email or password.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Epoka Bus Reservation</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
    </style>
</head>  
<body>
<div class="container">
    <img class="logo" src="logo.png" alt="Logo">
  <h1>User Login</h1>
  <?php if(isset($error)) { ?>
    <div><?php echo $error; ?></div>
  <?php } ?>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Log In">
  </form>
  <p>Don't have an account? <a href="createuser.php">Create one here</a>.</p>
  <p>Forgot password? <a href="forgotpassword.php">Change it here</a>.</p>
  </div>
</body>
</html> 