<!DOCTYPE html>
<html>
<?php
include_once("connection.php");
$stmt = $conn->prepare("INSERT INTO TblUser (UserID,Gender,Surname,Forename,Password,House,Year,Role)VALUES (null,:gender,:surname,:forename,:password,:house,:year,:role)");
?>

<head>
    
    <title>Tuck Shop</title>
    <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div class="header">

<h1>Menu</h1>
</div>
<div class="body">
<a href="login.php"> login</a>
<a href="users.php"> Sign up</a>
</div>
</body>
</html>