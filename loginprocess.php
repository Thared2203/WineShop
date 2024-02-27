<?php
// Starting a session to manage user sessions
session_start();

// Including the database connection file
include_once("connection.php");

// Applying htmlspecialchars to all elements of the $_POST array to prevent XSS attacks
array_map("htmlspecialchars", $_POST);

// Preparing a SQL statement to select user data based on the provided forename
$stmt = $conn->prepare("SELECT * FROM People WHERE Forename = :Forename");

// Binding the Forename parameter to the provided value from the POST request
$stmt->bindParam(':Forename', $_POST['Forename']);
$stmt->execute();

// Looping through the results of the SQL query
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Retrieving hashed password from the database
    $hashed = $row['Password'];

    // Retrieving password attempt from the POST request
    $attempt = $_POST['Pword'];

    // Verifying the password attempt against the hashed password using password_verify
    if (password_verify($attempt, $hashed)) {
        // If the password verification is successful:
        
        // Setting session variables for the logged-in user ID and admin status
        $_SESSION['loggedinID'] = $row['PeopleID'];
        $_SESSION['Admin'] = $row['Admin'];

        // Checking if a backURL is set in the session
        if (!isset($_SESSION['backURL'])) {
            // If no backURL is set, default to 'menu.php' as the destination
            $backURL = "menu.php";
        } else {
            // If a backURL is set, use it as the destination
            $backURL = $_SESSION['backURL'];
        }

        // Unsetting the backURL from the session
        unset($_SESSION['backURL']);

        // Redirecting the user to the appropriate destination based on backURL
        header('Location: ' . $backURL);
        exit(); // Exiting after the redirect to prevent further execution
    } else {
        // If the password verification fails, redirect the user back to the login page
        header('Location: login.php');
        exit(); // Exiting after the redirect to prevent further execution
    }
}

// Closing the database connection
$conn = null;
?>