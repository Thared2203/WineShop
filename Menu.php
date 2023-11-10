<!DOCTYPE html>
<html>
<?php
include_once("connection.php");
session_start();
if(isset ($_SESSION["Admin"]) && $_SESSION["Admin"]==1){
  header('Location:menu2.php');
}

?>

<head>
    
  <title>Wine Shop</title>
  <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  function showresult(str) {
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
        <?php
        if(isset($_SESSION['loggedin']))
        {
        ?>
          <li class="nav-item">
          <a class="nav-link" href="login.php">Log in</a>
        </li>
        <?php
        }
        ?>
        <?php
        if(!isset($_SESSION['loggedin']));
        {
        ?>
          <li class="nav-item">
          <a class="nav-link" href="logout.php">Log out</a>
        </li>
        <?php
        }
        ?>
        
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

<select name="All" id="category" onchange="showresult(this.value)">
<option value="All">All</option>
<?php 
  include_once('connection.php');
  $stmt = $conn->prepare("SELECT DISTINCT WineCategory FROM Wine Order by WinePrice DESC");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	    {
        echo('<option value="'.$row['WineCategory'].'">'.$row['WineCategory'].'</option>');
      }?>


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


<!--<select name="Wine Price">
  <option value="HightoLow">HightoLow</option>-->
  <?php
  //$stmt = $conn->prepare("SELECT * from wine Order by WinePrice DESC" );
  ?>
  <!--<option value="LowtoHigh">LowtoHigh</option>-->
  <?php
  //$stmt = $conn->prepare("SELECT * from wine Order by WinePrice ASC" );
  ?>
</select>
</nav>


<body>
<div id="results">
  <?php 
  include_once('connection.php');
  $stmt = $conn->prepare("SELECT * FROM Wine");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	    {//uses a hidden input which contains the ID of the wine selected
			echo'<form action="addtobasket.php" method="post">';
			echo('The name of the wine is '.$row["WineName"].'. The type of the wine is '.$row["WineCategory"].'. '.$row["WineDescription"].'. This wine is from '.$row["Country"].'. It costs £'.$row["WinePrice"].'. There is a maximum of '.$row["WineStock"].' bottles to be sold.'.' How many do you want to buy '."<input type='number' name='qty' min='0' max='100' value='0'>
      <input type='submit' value='Add Wine'><input type='hidden' name='WineID' value=".$row['WineID']."><br><br></form>"); }?>
	    </div>

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
  
<a href="checkout.php" >Checkout</a>

</body> 
</html>