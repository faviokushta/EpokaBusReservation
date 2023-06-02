<?php
  include("config.php");
  session_start();

  

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT * FROM Admins WHERE Username = '$email' and Password = '$password'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if($count == 1) {
      $_SESSION['adminID'] = $row['AdminID'];
      header("location: adminpage.php");
      exit();
    } else {
      $error = "Your Email or Password is invalid";
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
</head>
<body>
  <h2>Admin Login</h2>
  <?php
    if(isset($error)) {
      echo "<div>" . $error . "</div>";
    }
  ?>
  <form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Log In</button>
  </form>
  <a href="userlogin.php">Go to user log in</a>
</body>
</html>