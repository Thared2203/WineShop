<!DOCTYPE html>
<html>

<head>

<title> Login </title>
</head>

<body>
    <div class="header">            
    <h1>Login</h1><br>
    </div>
    <div class="body">
            <p>Please enter your credentials to login</p>       
            <form action="loginprocess.php" method= "POST">
            <input type="text" placeholder="Forename" name="Forename"><br>
            <input type="password" placeholder="password" name="Pword"><br>
            <input type="submit" value="Login">
</div>
    
            </form>
</body>
            <style>


body {

margin: 0;

}

/* Style the header  – this creates a style for header*/

.header {

background-color:lightBlue;
;

padding: 20px;

text-align: center;

}

.body {
background-color:lightSeaGreen;

padding: 20px;

}

</style>