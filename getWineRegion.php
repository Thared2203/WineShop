<!-- This section displays wine results based on user selection. -->

<!-- Start of results container -->
<div id="results" class="container">
    <!-- Row for displaying wine cards, with 4 columns on medium-sized screens -->
    <div class="row row-cols-1 row-cols-md-4">
        <?php
        // Retrieve the value of 'q' parameter from the URL
        $q = $_GET['q'];

        // Include the database connection file
        include_once("connection.php");

        // If the selected value is "All"
        if ($q == "All") {
            // Prepare and execute SQL query to fetch all wines with stock greater than 0, ordered by price in descending order
            $stmt = $conn->prepare("SELECT * FROM wine WHERE WineStock > 0 ORDER BY WinePrice DESC");
            $stmt->execute();

            // Fetch and display wine information in cards
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <!-- Wine card -->
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
                            <!-- Wine image -->
                            <img src="/WineShop/images/<?= $row["piccy"] ?>" class="img-fluid WineImage" alt="Wine Image"><br>
                            <div class="form-group mt-auto">
                                <!-- Quantity input field -->
                                Quantity: <input type="number" class="form-control" name="qty" min="0" max="100" value="0"><br>
                                <!-- Add Wine button -->
                                <button type="submit" class="btn btn-primary">Add Wine</button>
                                <!-- Hidden input field for WineID -->
                                <input type="hidden" name="WineID" value="<?= $row['WineID'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            // If the selected value is not "All", filter wines by country

            // Prepare and execute SQL query to fetch wines from the selected country with stock greater than 0, ordered by price in descending order
            $stmt = $conn->prepare("SELECT * FROM wine WHERE country = :country AND WineStock > 0 ORDER BY WinePrice DESC");
            $stmt->bindParam(':country', $q);
            $stmt->execute();

            // Fetch and display wine information in cards
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <!-- Wine card -->
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
                            <!-- Wine image -->
                            <img src="/WineShop/images/<?= $row["piccy"] ?>" class="img-fluid WineImage" alt="Wine Image"><br>
                            <div class="form-group mt-auto">
                                <!-- Quantity input field -->
                                Quantity: <input type="number" class="form-control" name="qty" min="0" max="1000" value="0"><br>
                                <!-- Add Wine button -->
                                <button type="submit" class="btn btn-primary">Add Wine</button>
                                <!-- Hidden input field for WineID -->
                                <input type="hidden" name="WineID" value="<?= $row['WineID'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<!-- End of results container -->

<?php
// Including the database connection file
include_once('connection.php');

// Fetching and displaying data from the 'wine' table
$stmt = $conn->prepare("SELECT * FROM wine");
$stmt->execute();

// Checking if a 'wine' session variable exists
if (isset($_SESSION["wine"])) {
    // Displaying the number of items in the basket if it exists
    echo ("Basket contains ");
    echo count($_SESSION["WineStock"]) - 1;
    echo (" items<br>");
    // Link to view basket contents
    echo ("<a href=viewbasket.php>View basket contents</a>");
}
?>
</body>
</html>