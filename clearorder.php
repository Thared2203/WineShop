<?php
session_start();

if(isset($_SESSION['tuck']))
{
    unset($_SESSION['tuck']);
}
header('Location:addtobasket.php');
?>