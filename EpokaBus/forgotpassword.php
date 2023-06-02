<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = "SELECT * FROM Users WHERE SchoolEmail = '$email'";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Get the user's security question
        $security_question = $user['SecurityQuestion'];

        // Redirect to the security question page
        header("Location: securityquestion.php?email=$email&security_question=$security_question");
        exit();
    } else {
        echo "Email not found.";
    }
}
?>
<style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f2f2f2;
      color: #333;
    }
    </style>
<form method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Submit</button>
</form>