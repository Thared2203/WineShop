<?php
include_once("connection.php");

//creates table called People

$stmt = $conn->prepare("DROP TABLE IF EXISTS People;
CREATE TABLE People 
(PeopleID Int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Email VARCHAR(50) NOT NULL,
Password VARCHAR(500) NOT NULL,
Forename VARCHAR(20) NOT NULL,
Surname VARCHAR(30) NOT NULL,
TelephoneNumber VARCHAR(11) NOT NULL,
Postcode VARCHAR(7) NOT NULL,
Address VARCHAR(50) NOT NULL,
CardNumber VARCHAR(500) NOT NULL,
ExpiryDate VARCHAR(20) NOT NULL,
Manager Int(1) Not Null)");
$stmt->execute();
$stmt->closeCursor();

//creates table called Wine

$stmt = $conn->prepare("DROP TABLE IF EXISTS Wine;
CREATE TABLE Wine 
(WineID Int(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
WineName VARCHAR(20) NOT NULL,
WineCategory VARCHAR(20) NOT NULL,
WineDescription VARCHAR(100) NOT NULL,
WineImage VARCHAR(100) NOT NULL,
WinePrice Decimal(4) NOT NULL,
WineStock Int(3) NOT NULL,
OfferID Int(3) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

//creates table called Review

$stmt = $conn->prepare("DROP TABLE IF EXISTS Review;
CREATE TABLE Review 
(ReviewID Int(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
WineID Int(4) NOT NULL,
PeopleID Int(8) NOT NULL,
Stars VARCHAR(20) NOT NULL,
ReviewText VARCHAR(30) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

//creates table called Offer

$stmt = $conn->prepare("DROP TABLE IF EXISTS Offer;
CREATE TABLE Offer 
(OfferID Int(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
OfferName Varchar(30) NOT NULL,
OfferType Varchar(10) NOT NULL,
percentoff Decimal(2) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

// creates table called Orders

$stmt = $conn->prepare("DROP TABLE IF EXISTS Orders;
CREATE TABLE Orders
(OrderID Int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
PeopleID Int(8) NOT NULL,
Date Varchar(5) NOT NULL,
Packed Int(1) NOT NULL,
Onroute Int(1) NOT NULL,
Delivered Int(1) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();

// creates table called Baskets

$stmt = $conn->prepare("DROP TABLE IF EXISTS Baskets;
CREATE TABLE Baskets
(OrderID Int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
WineID Int(4) NOT NULL,
Quantity Int(3) NOT NULL)");
$stmt->execute();
$stmt->closeCursor();