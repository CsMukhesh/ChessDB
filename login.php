<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the data (you may want to add more validation)

    // Check the credentials against the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if ($password == $row['password']) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];

            // Redirect to a dashboard or home page
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        // User not found, show alert and redirect
        echo '<script>alert("User not found. Please sign up."); window.location.href = "sign-up.php";</script>';
        exit(); // Terminate the script execution
    }
}

$conn->close();
?>
