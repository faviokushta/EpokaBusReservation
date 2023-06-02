<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Password rules
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        echo 'Password should be at least 8 characters in length and should include at least one uppercase letter, one lowercase letter, one number, and one special character.';
    } else {
        // Update the user's password in the database
        $query = "UPDATE Users SET Password='$password' WHERE SchoolEmail='$email'";
        $result = mysqli_query($db, $query);

        if ($result) {
            // Password successfully updated, redirect to login page
            header("Location: userlogin.php");
            exit();
        } else {
            echo "Error updating password.";
        }
    }
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    echo "Email not specified.";
    exit();
}
?>

<form method="post">
    <label for="password">New Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <button type="submit">Submit</button>
</form>