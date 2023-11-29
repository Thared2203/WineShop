<!DOCTYPE html>
<html>
<?php
session_start();
include_once("connection.php");

?>

<head>
    
    <title>Wine Shop</title>
    <link rel="stylesheet" href="styles.css">
    <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="header">
<h1>Admin's home page</h1>

</div>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" >Simon Tilley's Wine Shop</a>
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
  <?php
}
?>
        <li class="nav-item">
          <a class="nav-link" href="wine.php">Add Wine</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</style>

<body>

</body>
</html>