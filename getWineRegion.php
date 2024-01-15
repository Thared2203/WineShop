<div id="results" class="container">
  <div class="row row-cols-1 row-cols-md-4">
<?php
$q = $_GET['q'];
//echo($q);
include_once("connection.php");

if ($q == "All") {
    $stmt = $conn->prepare("SELECT * FROM wine WHERE WineStock > 0 ORDER BY WinePrice DESC");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="col mb-4">
            <div class="card h-100 d-flex flex-column">
                <div class="card-body">
                    <h5 class="card-title"><?= $row["WineName"] ?></h5>
                    <p class="card-text">
                        Colour: <?= $row["WineCategory"] ?><br>
                        Description: <?= $row["WineDescription"] ?><br>
                        Country: <?= $row["Country"] ?><br>
                        Price: £<?= $row["WinePrice"] ?><br>
                        Stock: <?= $row["WineStock"] ?> bottles available
                    </p>
                    <img src="/WineShop/images/<?= $row["piccy"] ?>" class="img-fluid WineImage" alt="Wine Image"><br>
                    <div class="form-group mt-auto">
                        Quantity: <input type="number" class="form-control" name="qty" min="0" max="100" value="0"><br>
                        <button type="submit" class="btn btn-primary">Add Wine</button>
                        <input type="hidden" name="WineID" value="<?= $row['WineID'] ?>">
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
else{
 
  $stmt = $conn->prepare("SELECT * from wine WHERE country =:country and WineStock>0 Order by WinePrice DESC" );
  $stmt->bindParam(':country', $q);
  $stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="col mb-4">
        <div class="card h-100 d-flex flex-column">
            <div class="card-body">
                <h5 class="card-title"><?= $row["WineName"] ?></h5>
                <p class="card-text">
                    Colour: <?= $row["WineCategory"] ?><br>
                    Description: <?= $row["WineDescription"] ?><br>
                    Country: <?= $row["Country"] ?><br>
                    Price: £<?= $row["WinePrice"] ?><br>
                    Stock: <?= $row["WineStock"] ?> bottles available
                </p>
                <img src="/WineShop/images/<?= $row["piccy"] ?>" class="img-fluid WineImage" alt="Wine Image"><br>
                <div class="form-group mt-auto">
                    Quantity: <input type="number" class="form-control" name="qty" min="0" max="1000" value="0"><br>
                    <button type="submit" class="btn btn-primary">Add Wine</button>
                    <input type="hidden" name="WineID" value="<?= $row['WineID'] ?>">
                </div>
            </div>
        </div>
    </div>
    <?php
}
}
?>
<?php
include_once('connection.php');

$stmt = $conn->prepare("SELECT * FROM wine");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

if (isset($_SESSION["wine"])){
	//shows number in basket if basket exists
	echo ("Basket contains ");
	echo count($_SESSION["WineStock"])-1;
	echo (" items<br>");
	echo ("<a href=viewbasket.php>View basket contents</a>");
}
?>
</body>
</html>