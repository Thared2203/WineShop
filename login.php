<!DOCTYPE html>
<html>

<head>
    <title> Wine Shop </title>
    <!-- Linking to an external stylesheet -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Header section -->
    <div class="header">
        <h1>Login</h1>
    </div>

    <!-- Login form -->
    <div>
        <!-- Instruction for users -->
        <p>Please enter your credentials to login</p>

        <!-- Form for user login, action points to 'loginprocess.php' for processing -->
        <form action="loginprocess.php" method="POST">
            <!-- Input field for user's forename -->
            <!-- Users only need to remember their forename and password for login -->
            <input type="text" placeholder="Forename" name="Forename"><br>
            <!-- Input field for user's password -->
            <input type="password" placeholder="password" name="Pword"><br>
            <!-- Submit button to initiate login -->
            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>  