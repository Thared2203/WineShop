<?php
session_start();

if(isset($_SESSION['wine']))
{
    unset($_SESSION['wine']);
}

if(isset($_SESSION['basket']))
{
    unset($_SESSION['basket']);
}
header('Location:Menu.php');
?>