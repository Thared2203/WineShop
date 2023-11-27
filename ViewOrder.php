<!DOCTYPE html>
<html>
<title>Order</title>
<link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <h1>Order history</h1>
    
       
    <?php
    include_once('connection.php');
    session_start();
    //select all orders made by logged un user and display in table
    //need some funky join stuff to get details needed
        $stmt = $conn->prepare("SELECT * FROM Orders WHERE PeopleID=:peopleid ORDER by OrderDate DESC");
        $stmt->bindParam(':peopleid', $_SESSION["loggedin"]);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {echo'<form action="examineorder.php" method="post">';
                
                $date = date("d/m/Y H:i:s", strtotime($row["OrderDate"]));
                $time = date("H:i:s", strtotime($row["OrderDate"]));
                echo("Order number ".$row["OrderID"].' on '.$date." at ".$time." ");
                echo("<input type='submit' value='View Order'><input type='hidden' name='OrderID' value=".$row['OrderID']."><br></form>");

                echo("<tr><td>".$row["OrderID"]."</td><td> ".$row["OrderDate"]." </td></tr>");
                
            }
        }else{
            echo("none<br>");
        }
    
    ?>
    </table>
    <a href="Menu.php">Back to menu</a>
</body>
</html>