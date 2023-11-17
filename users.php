<!DOCTYPE html>
<html>
<?php
include_once("connection.php");
$stmt = $conn->prepare("INSERT INTO TblUser 
(PeopleID,Email,Password,Forename,Surname,TelephoneNumber,Postcode,Address,Balance,Admin)
VALUES 
(null,:Email,:Password,:Forename,:Surname,:TelephoneNumber,:Postcode,:Address,:Balance,:Admin)"); 
?>
<!-- This means that all the varuable are set to 0 before the input apart from the PeopleID as this needs to increment every time -->

<head>
    
    <title>Sign up</title>
    <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div class="header">

<h1>Sign up</h1>

</div>

<div class="body">

<form action="addusers.php" method="Post">
  Email:<input type="text" name="Email"><br>
  Password:<input type="text" name="Password"><br>
  Forename:<input type="text" name="Forename"><br>
  Surname:<input type="text" name="Surname"><br>
  TelephoneNumber:<input type="text" name="TelephoneNumber"><br>
  Postcode:<input type="text" name="Postcode"><br>
  Address:<input type="text" name="Address"><br>
  Balance:<input type="text" name="Balance"><br>
  Admin:<input type="radio" name="Admin" value="1" checked> <br>
  Customer:<input type="radio" name="Admin" value="0" checked> <br>


  <input type="submit" value="Sign up">
  
</form>
</div>
<?php
include_once('connection.php');

$stmt = $conn->prepare("SELECT * FROM people");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))


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