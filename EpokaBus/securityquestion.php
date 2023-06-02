<?php
include("config.php");

// Retrieve the user's security question
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $query = "SELECT SecurityQuestion FROM Users WHERE SchoolEmail = '$email'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $security_question = $row['SecurityQuestion'];
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "Email not specified.";
    exit();
}

// Check if the user has submitted the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $answer = $_POST['answer'];

    // Check if the answer matches the user's security question answer
    $query = "SELECT SecurityAnswer FROM Users WHERE SchoolEmail = '$email'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $security_answer = $row['SecurityAnswer'];

        if ($security_answer === $answer) {
            // If the answer matches, redirect the user to the change password page
            header("Location: changepassword.php?email=$email");
            exit();
        } else {
            echo "Incorrect answer.";
        }
    } else {
        echo "User not found.";
    }
}
?>

<form method="post">
    <label for="question"><?php echo $security_question; ?></label>
    <input type="text" id="answer" name="answer" required>
    <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
    <button type="submit">Submit</button>
</form>