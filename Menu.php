<!DOCTYPE html>
<html>
<?php
include_once("connection.php");

?>

<head>
    
    <title>Wine Shop</title>
    <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">Simon Tilley's Wine Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="users.php">Sign Up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Log in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Log out</a>
        </li>
</ul>
      <form class="d-flex">
          
        <input class="form-control me-2" type="text" placeholder="Search">
        <button class="btn btn-primary" type="button">Search</button>
      </form>
    </div>
  </div>
</nav>
<div class="header">

<h1>Buy Fine Wine</h1>

</div>
<nav>
<div class="topnav">
  <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search..." name="search">
      <button type="submit">Submit</button>
    </form>
  </div>
</div>
</nav>


<nav>
<select name="Wine Colour">
  <option value="WineColour">WineCategory</option>
  <option value="Red">Red</option>
  <option value="Pink">Pink</option>
  <option value="White">White</option>
  <option value="Fortified">Fortified</option>
  <option value="Sparkling">Sparkling</option>
</select>


<select name="Wine Region">
  <option value="WineRegion">WineRegion</option>
  <option value="France">France</option>
  <option value="Italy">Italy</option>
  <option value="USA">USA</option>
  <option value="Chile">Chile</option>
  <option value="Portugal">Portugal</option>
  <option value="England">England</option>
</select>


<select name="Wine Price">
  <option value="Price">Price</option>
  <option value="HightoLow">HightoLow</option>
  <option value="LowtoHigh">LowtoHigh</option>
</select>
</nav>

<body>
    
<?php
include_once('connection.php');

$stmt = $conn->prepare("SELECT * FROM wine");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

include_once('connection.php');

if (isset($_SESSION["wine"])){
	//shows number in basket if basket exists
	echo ("Basket contains ");
	echo count($_SESSION["wine"])-1;
	echo (" items<br>");
	echo ("<a href=viewbasket.php>View basket contents</a>");
}

	$stmt = $conn->prepare("SELECT * FROM Wine");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	    {//uses a hidden input which contains the ID of the wine selected
			echo'<form action="addtobasket.php" method="post">';
			echo('The name of the wine is '.$row["WineName"].'. The type of the wine is '.$row["WineCategory"].'. '.$row["WineDescription"].'. This wine is from '.$row["Country"].'. It costs £'.$row["WinePrice"].'. There is a maximum of '.$row["WineStock"].' bottles to be sold.'.' How many do you want to buy '."<input type='number' name='qty' min='0' max='100' value='0'>
      <input type='submit' value='Add Wine'><input type='hidden' name='WineID' value=".$row['WineID']."><br></form>");
	    }

?>   
<a href="checkout.php">Checkout</a>
</body> 
</html>