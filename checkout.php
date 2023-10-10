<?php
session_start(); 
if (!isset($_SESSION['loggedinID']))
{   
   $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>
<title>Checkout</title>
    
</head>
<body>
   <h1>Checkout</h1>
   <?php
   //uses view basket to save writing again
   include("viewbasket.php");
   ?>
</body>
</html>