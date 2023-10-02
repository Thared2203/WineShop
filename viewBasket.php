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
    //print_r($_SESSION);
    $total=0;
    echo("<tr>");
    //echo("<br>");
    //print_r($_SESSION["basket"]);
    foreach ($_SESSION["basket"] as $wine){
        //print_r($wine);
        echo("<br><table class='center'>");
        $stmt = $conn->prepare("SELECT * FROM wine WHERE WineID=:wineid");
        $stmt->bindParam(':wineid', $wine["WineID"]);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo("<tr><td>".$row["WineName"]."</td><td> ".$wine["WineID"]." </td><td>- £".number_format(($wine["qty"]*$row["WinePrice"]),2)."</td></tr>");
                $total=$total+($wine["qty"]*$row["WinePrice"]);
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