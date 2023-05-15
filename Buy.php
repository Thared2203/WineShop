<!DOCTYPE html>
<html>
<?php
include_once("connection.php");
$stmt = $conn->prepare("INSERT INTO baskets (OrderID, WineID, Quantity)VALUES (null,:WineID,:Quantity)");
?>

<head>

    <title>Buy Wine</title>
    <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div class="header">

<h1>Buy new Wine</h1>

</div>
<nav>
<div class="topnav">
  <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">Submit</button>
    </form>
  </div>
</div>
<nav>
<select name="Wine Colour">
  <option value="WineColour">WineColour</option>
  <option value="Red">Red</option>
  <option value="Pink">Pink</option>
  <option value="White">White</option>
  <option value="Fortified">Fortified</option>
  <option value="Sparkling">Sparkling</option>
</select>


<select name="Wine Region">
  <option value="WineRegion">WineRegion</option>
  <option value="France">France</option>
  <option value="Italy">France</option>
  <option value="USA">Frane</option>
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

<?php
include_once('connection.php');

$stmt = $conn->prepare("SELECT * FROM baskets");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo($row["OrderID"].' '.$row["WineID"].' '.$row["Quantity"]."<br>");
}
?>
</body>
</html>