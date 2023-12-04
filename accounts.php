<!DOCTYPE html>
<html>
<title>Accounts</title>
<link rel="stylesheet" href="styles.css">
    
</head>
<body>
<div class="header">

<h1>Accounts</h1>

</div>
    
<?php
include_once('connection.php');
session_start();
$stmt = $conn->prepare("SELECT * FROM People WHERE Admin = 0");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $row["PeopleID"]. ', '. $row["Email"]. ', '. $row["Forename"]. " " .$row["Surname"]. ', '. $row["TelephoneNumber"]. ', '. $row["Postcode"]. ', ' . $row["Address"]. ', ' .$row["Balance"]."<br>";
    
}
?>
<a href="ExamineOrder2.php">Back to Orders</a>
<a href="menu2.php">Back to menu</a>
</body>
</html>