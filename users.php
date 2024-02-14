<!-- The following code is an HTML form for user sign-up with embedded PHP code for database interaction. -->

<!DOCTYPE html>
<html>

<?php
// Including the database connection file
include_once("connection.php");

// Preparing SQL statement for inserting user data into the database table 'TblUser'
$stmt = $conn->prepare("INSERT INTO TblUser 
(PeopleID, Email, Password, Forename, Surname, TelephoneNumber, Postcode, Address, Balance, Admin)
VALUES 
(null, :Email, :Password, :Forename, :Surname, :TelephoneNumber, :Postcode, :Address, :Balance, :Admin)");
?>

<head>
    <title>Sign up</title>
    <link rel="stylesheet" href="styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!-- Header section -->
    <div class="header">
        <h1>Sign up</h1>
    </div>

    <!-- Body section containing the sign-up form -->
    <div class="body">
        <form action="addusers.php" method="Post">
            Email: <input type="text" name="Email"><br>
            Password: <input type="text" name="Password"><br>
            Forename: <input type="text" name="Forename"><br>
            Surname: <input type="text" name="Surname"><br>
            TelephoneNumber: <input type="text" name="TelephoneNumber"><br>
            Postcode: <input type="text" name="Postcode"><br>
            Address: <input type="text" name="Address"><br>
            Balance: <input type="text" name="Balance"><br>
            Admin: <input type="radio" name="Admin" value="1" checked> <br>
            Customer: <input type="radio" name="Admin" value="0"> <br>
            <!-- Submit button for the form -->
            <input type="submit" value="Sign up">
        </form>
    </div>

    <?php
    // Including the database connection file
    include_once('connection.php');

    // Retrieving data from the 'people' table
    $stmt = $conn->prepare("SELECT * FROM people");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Currently, this loop doesn't seem to serve a specific purpose
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include_once('connection.php');

        // Process your form data here

        // Redirect to Menu.php after processing the form
        header("Location: Menu.php");
    }
    ?>
</body>

</html>