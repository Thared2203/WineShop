<!DOCTYPE html>
<html>
<?php
// Including the database connection file
include_once("connection.php");
// Starting the session
session_start();

# Redirecting the admin to another menu if logged in as admin
if(isset($_SESSION["Admin"]) && $_SESSION["Admin"] == 1){
  header('Location:menu2.php');
  exit();
}

?>

<head>
    
  <title>Wine Shop</title>
  <!-- Linking external stylesheet -->
  <link rel="stylesheet" type="text/css" href="styles.css">
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- JavaScript functions for AJAX requests -->
  <script>
    // Function to show results based on wine category
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
    // Function to show results based on wine region
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
<!-- Header section -->
<div class="header">
  <h1>Buy Fine Wine</h1>
</div>

<!-- Navigation bar -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">Simon Tilley's Wine Shop</a>
    <!-- Navbar toggle button for mobile view -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <?php
        // Check if the user is logged in
        if (isset($_SESSION['loggedinID'])) {
        ?>
          <!-- Show Log Out button if user is logged in -->
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a>
          </li>
          <!-- Show the number of items in the basket -->
          <a class="nav-link" href="checkout.php">
            <?php 
            if (isset($_SESSION["itemsinbasket"])){
              echo ($_SESSION["itemsinbasket"]);
            };
            ?>
          </a>
        <?php
        } else {
        ?>
          <!-- Show Sign Up and Log In links if user is not logged in -->
          <li class="nav-item">
            <a class="nav-link" href="users.php">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Log In</a>
          </li>
        <?php
        }
        ?>
        <!-- Link to examine order -->
        <li class="nav-item">
          <a class="nav-link" href="ExamineOrder.php">Examine Order</a>
        </li>
      </ul>    
    </div>
  </div>
</nav>

<br>
<nav>
  <!-- Dropdown for wine category -->
  <select name="All" id="category" onchange="showresult(this.value)">
    <option value="All">All</option>
    <?php 
    // Fetching distinct wine categories from the database
    include_once('connection.php');
    $stmt = $conn->prepare("SELECT DISTINCT WineCategory FROM Wine ORDER BY WinePrice DESC");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo('<option value="'.$row['WineCategory'].'">'.$row['WineCategory'].'</option>');
    }
    ?>
  </select>

  <!-- Dropdown for wine region -->
  <select name="All" id="region" onchange="showresult2(this.value)">
    <option value="All">All</option>
    <?php 
    // Fetching distinct countries from the database
    include_once('connection.php');
    $stmt = $conn->prepare("SELECT DISTINCT Country FROM Wine ORDER BY WinePrice DESC");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo('<option value="'.$row['Country'].'">'.$row['Country'].'</option>');
    }
    ?>
  </select>
  <!-- Link to checkout page -->
  <a href="checkout.php">Checkout</a>
  <!-- Display the number of items in the basket -->
  <?php 
  if (isset($_SESSION["itemsinbasket"])){
    echo ($_SESSION["itemsinbasket"]);
  };
  ?>
</nav>

<!-- Results section -->
<div id="results" class="container">
  <div class="row row-cols-1 row-cols-md-4">
    <?php 
    // Fetching wines with stock greater than 0
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
      <!-- Display wine image -->
      <img src="/WineShop/images/<?php echo $row["piccy"]; ?>" class="img-fluid WineImage" alt="Wine Image"><br>
      <?php
      echo '<div class="form-group mt-auto">';
      echo 'Quantity: <input type="number" class="form-control" name="qty" min="0" max="100"' . $row["WineStock"] . '" value="0"><br>';
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
</div>

<!-- Display the basket content -->
<?php
$stmt = $conn->prepare("SELECT * FROM wine");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

if (isset($_SESSION["wine"])){
  // Display the number of items in the basket
  echo ("Basket contains ");
  echo count($_SESSION["WineStock"]) - 1;
  echo (" items<br>");
  // Link to view basket contents
  echo ("<a href=viewbasket.php>View basket contents</a>");
}
?>

</body> 
</html>