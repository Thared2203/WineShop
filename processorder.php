<?php
session_start();
include_once('connection.php');
print_r($_SESSION);
// Check if the user is logged in and the basket is not empty
if (isset($_SESSION['loggedinID']) && !empty($_SESSION['basket'])) {
    // Calculate the total cost of the items in the basket
    $totalCost = $_SESSION['totalcost'];

    // Check if the user has enough balance
    $stmt = $conn->prepare("SELECT Balance FROM people WHERE PeopleID = :peopleid");
    $stmt->bindParam(':peopleid', $_SESSION['loggedinID']);
    $stmt->execute();
    $userBalance = $stmt->fetchColumn();
    $stmt->closeCursor();
echo $userBalance;
echo $totalCost;
    if ($userBalance >= $totalCost) {
        // User has enough balance, proceed with the purchase
        echo("ok");
        foreach ($_SESSION['basket'] as $entry) {
            $stmt = $conn->prepare("UPDATE wine SET WineStock = WineStock - :bought WHERE WineID = :wineid");
            $stmt->bindParam(':wineid', $entry['WineID']);
            $stmt->bindParam(':bought', $entry['qty']);
            $stmt->execute();
            $stmt->closeCursor();
        }

        // Deduct the total cost from the user's balance
        $stmt = $conn->prepare("UPDATE people SET Balance = Balance - :newbalance WHERE PeopleID = :peopleid");
        $stmt->bindParam(':peopleid', $_SESSION['loggedinID']);
        $stmt->bindParam(':newbalance', $totalCost);
        $stmt->execute();
        $stmt->closeCursor();

        //Add to the basket tab when completed
        foreach ($_SESSION["basket"] as $wine){
            print_r($wine);
            echo("<br>");
        }
       # $stmt = $conn->prepare("INSERT INTO baskets SET Quanitity WHERE Quantity =:Quanitity");
        

        // Clear the basket and redirect
        unset($_SESSION['basket']);
        #header("Location: Menu.php");
        exit();
    } else {
        // User does not have enough balance, redirect with a message
        $_SESSION['error_message'] = "Insufficient balance to complete the purchase.";
        echo"no";
       # header("Location: Menu.php");
        exit();
    }
} else {
    // User is not logged in or the basket is empty, handle accordingly
    #header("Location: Menu.php");
    exit();
}

// Close the database connection
$conn = null;
?>