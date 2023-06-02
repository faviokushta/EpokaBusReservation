<?php
  include("config.php");
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $question = mysqli_real_escape_string($db, $_POST['securityQuestion']);
    $answer = mysqli_real_escape_string($db, $_POST['answer']);
    
    // Check if email is already used
    $check_email_query = "SELECT * FROM Users WHERE SchoolEmail = '$email'";
    $check_email_result = mysqli_query($db, $check_email_query);
    if(mysqli_num_rows($check_email_result) > 0) {
      $error = "This email is already used.";
    }

    // Check if email is from Epoka domain
    if(!preg_match("/@epoka\.edu\.al$/", $email)) {
      $error = "You must use your Epoka email address.";
    }

    // Check if password meets requirements
    if(!preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,}$/", $password)) {
      $error = "Password must have at least 8 characters including a capital letter, a number, and a symbol.";
    }

    if(empty($error)) {
      $insert_query = "INSERT INTO Users (FullName, SchoolEmail, Password, SecurityQuestion, SecurityAnswer) 
                       VALUES ('$name', '$email', '$password', '$question', '$answer')";
      mysqli_query($db, $insert_query);
      header("location: userlogin.php");
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Epoka Bus Reservation System - Create User Account</title>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f2f2f2;
      color: #333;
    }
    </style>
</head>
<body>
  <h1>Create User Account</h1>
  <?php if(isset($error)) { ?>
    <div><?php echo $error; ?></div>
  <?php } ?>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="name">Full Name:</label>
    <input type="text" name="name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <label for="securityQuestion">Security Question:</label>
      <select id="securityQuestion" name="securityQuestion" required>
        <option value="">Please select a security question</option>
        <option value="What is your favorite song?">What is your favorite song?</option>
        <option value="What is your favorite movie?">What is your favorite movie?</option>
        <option value="What is your favorite book?">What is your favorite book?</option>
      </select>

    <label for="answer">Security Answer:</label>
    <input type="text" name="answer" required><br>

    <input type="submit" value="Create Account">
  </form>
  <p>Already have an account? <a href="userlogin.php">Log in here</a>.</p>
</body>
</html>