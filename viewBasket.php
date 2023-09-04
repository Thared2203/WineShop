<!DOCTYPE html>
<html>
<title>Wine</title>
</head>
<body>
<div class="header">
    <h1>Basket contains</h1>
</div>
<div class="body">
    
    <?php
    include_once('connection.php');
    session_start();
    $total=0;
    echo("<tr>");
    //print_r($_SESSION["wine"]);
    foreach ($_SESSION["wine"] as $wine){

        echo("<br><table class='center'>");
        $stmt = $conn->prepare("SELECT * FROM Wine WHERE WineID=:WineID");
        $stmt->bindParam(':wineid', $wine["wineid"]);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo("<tr><td>".$row["Name"]."</td><td> ".$tuck["qty"]." </td><td>- £".number_format(($tuck["qty"]*$row["Cost"]),2)."</td></tr>");
                $total=$total+($tuck["qty"]*$row["Cost"]);
            }
    }
    //could do some colouring here to indicate if over balance...
    echo("<tr><td></td><td>Total cost </td><td>£".number_format($total,2)."</td></tr>");
    //stores the basket total to subract from Balance
    ?>
    <br>
    <?php
    echo("<br>");
    $_SESSION["totalcost"]=$total;
    ?>
    </table>
    <br>
    <a href="clearorder.php">Clear order</a>
    <br>
    <a href="processorder.php">Confirm and order</a>
</div>
</body>
</html>