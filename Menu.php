<!DOCTYPE html>
<html>
<?php
include_once("connection.php");
session_start();
#forwards the admin to the other menu
if(isset ($_SESSION["Admin"]) && $_SESSION["Admin"]==1){
  header('Location:menu2.php');
  exit();
}

?>

<head>
    
  <title>Wine Shop</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  function showresult(str){
    if (str == "") {
        document.getElementById("results").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("results").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","GetWineCategory.php?q="+str,true);
        xmlhttp.send();
    }
  }
  function showresult2(str) {
    if (str == "") {
        document.getElementById("results").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("results").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getWineRegion.php?q="+str,true);
        xmlhttp.send();
    }
  }
</script>
</head>

<body>
<div class="header">

<h1>Buy Fine Wine</h1>
</div>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">Simon Tilley's Wine Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
  <ul class="navbar-nav me-auto">
  <?php

  // Check if the user is logged in
  if (isset($_SESSION['loggedinID'])) {
      // User is logged in show the Log Out button
  ?>
      <li class="nav-item">
          <a class="nav-link" href="logout.php">Log Out</a>
          
      </li>
      <a class="nav-link" href="checkout.php">
      <?php if (isset ($_SESSION["itemsinbasket"])){
   echo ($_SESSION["itemsinbasket"]);
  };

?></a>
      <?php
  } else {
      // User is not logged in
      ?>
      <li class="nav-item">
          <a class="nav-link" href="users.php">Sign Up</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="login.php">Log In</a>
      </li>
    <?php
}
?>
  <li class="nav-item">
    <a class="nav-link" href="ExamineOrder.php">Examine Order</a>
  </li>

</ul>    
    </div>
  </div>
</nav>

<!-- <nav>
<div class="topnav">
  <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search..." name="search">
      
      <button type="submit">Submit</button>
    </form>
  </div>
</div>
</nav> -->
<br>

<nav>
<select name="All" id="category" onchange="showresult(this.value)">
<option value="All">All</option>
<?php 
  include_once('connection.php');
  $stmt = $conn->prepare("SELECT DISTINCT WineCategory FROM Wine Order by WinePrice DESC");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	    {
        echo('<option value="'.$row['WineCategory'].'">'.$row['WineCategory'].'</option>');
      }
?>

</select>

<select name="All" id="region" onchange="showresult2(this.value)">
<option value="All">All</option>
<?php 
  include_once('connection.php');
  $stmt = $conn->prepare("SELECT DISTINCT Country FROM Wine Order by WinePrice DESC");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	    {
        echo('<option value="'.$row['Country'].'">'.$row['Country'].'</option>');
      }
?>

</select>
<a href="checkout.php">Checkout</a>
<?php if (isset ($_SESSION["itemsinbasket"])){
   echo ($_SESSION["itemsinbasket"]);
  };

?>
</nav>

<div id="results" class="container">
  <div class="row row-cols-1 row-cols-md-4">
    <?php 
      include_once('connection.php');
      $stmt = $conn->prepare("SELECT * FROM Wine WHERE WineStock > 0");
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<form action="addtobasket.php" method="post">';
        echo '<div class="col mb-4">';
        echo '<div class="card h-100 d-flex flex-column">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $row["WineName"] . '</h5>';
          echo '<p class="card-text">';
          echo 'Colour: ' . $row["WineCategory"] . '<br>';
          echo 'Description: ' . $row["WineDescription"] . '<br>';
          echo 'Country: ' . $row["Country"] . '<br>';
          echo 'Price: £' . $row["WinePrice"] . '<br>';
          echo 'Stock: ' . $row["WineStock"] . ' bottles available</p>';
          ?>
          <img src="/WineShop/images/<?php echo $row["piccy"]; ?>" class="img-fluid WineImage" alt="Wine Image"><br>
          <?php
          echo '<div class="form-group mt-auto">';
          echo 'Quantity: <input type="number" class="form-control" name="qty" min="0" max="WineStock" value="0"><br>';
          echo '<button type="submit" class="btn btn-primary">Add Wine</button>';
          echo '<input type="hidden" name="WineID" value="' . $row['WineID'] . '">';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</form>';
}
      ?>
    </div>
<div>

</div>
</div>
</div>
    <br>
    <?php

?>
<?php
include_once('connection.php');

$stmt = $conn->prepare("SELECT * FROM wine");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

if (isset($_SESSION["wine"])){
	//shows number in basket if basket exists
	echo ("Basket contains ");
	echo count($_SESSION["WineStock"])-1;
	echo (" items<br>");
	echo ("<a href=viewbasket.php>View basket contents</a>");
}
?>

</body> 
</html>