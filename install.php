<?php
include_once("connection.php");

//creates table called Peoples
$hashed_password = password_hash("password", PASSWORD_DEFAULT);  //increases security
$stmt = $conn->prepare("DROP TABLE IF EXISTS People;
CREATE TABLE People 
(PeopleID Int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Email VARCHAR(50) NOT NULL,
Password VARCHAR(500) NOT NULL,
Forename VARCHAR(20) NOT NULL,
Surname VARCHAR(30) NOT NULL,
TelephoneNumber VARCHAR(11) NOT NULL,
Postcode VARCHAR(8) NOT NULL,
Address VARCHAR(50) NOT NULL,
Admin Int(1) Not Null,
Balance Decimal(8,2) Not Null)");
$stmt->execute();
$stmt->closeCursor();

// Create table called Wine
$stmt = $conn->prepare("DROP TABLE IF EXISTS Wine;
CREATE TABLE Wine 
(WineID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
WineName VARCHAR(100) NOT NULL,
WineCategory VARCHAR(20) NOT NULL,
WineDescription VARCHAR(500) NOT NULL,
WinePrice DECIMAL(6,2) NOT NULL,
WineStock INT NOT NULL,
Country VARCHAR(15) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

// Create table called Review
$stmt = $conn->prepare("DROP TABLE IF EXISTS Review;
CREATE TABLE Review 
(ReviewID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
WineID INT NOT NULL,
PeopleID INT NOT NULL,
Stars VARCHAR(20) NOT NULL,
Review VARCHAR(30) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

// Create table called Orders
$stmt = $conn->prepare("DROP TABLE IF EXISTS Orders;
CREATE TABLE Orders
(OrderID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
PeopleID INT NOT NULL,
OrderDate DATE NOT NULL,
Packed INT NOT NULL,
OnRoute INT NOT NULL,
Delivered INT NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

// Create table called Baskets
$stmt = $conn->prepare("DROP TABLE IF EXISTS Baskets;
CREATE TABLE Baskets
(OrderID Int(10) NOT NULL,
WineID Int(4) NOT NULL,
Quantity Int(3) NOT NULL,
PRIMARY KEY (OrderID, WineID))");
$stmt->execute();
$stmt->closeCursor();
?>
