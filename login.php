<!DOCTYPE html>
<html>

<head>
<title> Wine Shop </title>
<link rel="stylesheet" href="styles.css">

</head>

<body>
<div class="header">

<h1>Login</h1>

</div>

    <div>
        <p>Please enter your credentials to login</p>       
        <form action="loginprocess.php" method= "POST">
        <!-- When the person has signed in the only thing they need to remeber 
        is their forename and password. This allows a quick and easy way to log in -->
        <input type="text" placeholder="Forename" name="Forename"><br>
        <input type="password" placeholder="password" name="Pword"><br>
        <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>   