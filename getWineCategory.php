<!-- This section displays the results of wine selection based on user input -->

<div id="results" class="container">
  <!-- Container for displaying the wine selection results -->

  <div class="row row-cols-1 row-cols-md-4">
    <!-- Row layout with up to 4 columns for displaying wine cards -->

    <?php
    $q = $_GET['q']; // Retrieving the value of 'q' parameter from the URL query string
    //echo($q);
    include_once("connection.php"); // Including the database connection file

    if ($q == "All") {
      // If the user selects 'All' wines, retrieve all wines available in stock

      $stmt = $conn->prepare("SELECT * FROM wine WHERE WineStock > 0 ORDER BY WinePrice DESC");
      // Prepare SQL query to select all wines with stock available, ordered by price in descending order
      $stmt->execute(); // Execute the prepared statement

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Loop through the fetched rows to display wine information
        ?>

        <!-- Displaying each wine as a card -->
        <div class="col mb-4">
          <!-- Bootstrap column layout -->
          <div class="card h-100 d-flex flex-column">
            <!-- Wine card -->
            <div class="card-body">
              <!-- Card body -->
              <h5 class="card-title"><?= $row["WineName"] ?></h5>
              <!-- Wine name -->
              <p class="card-text">
                <!-- Wine details -->
                Colour: <?= $row["WineCategory"] ?><br>
                <!-- Wine category -->
                Description: <?= $row["WineDescription"] ?><br>
                <!-- Wine description -->
                Country: <?= $row["Country"] ?><br>
                <!-- Wine origin country -->
                Price: £<?= $row["WinePrice"] ?><br>
                <!-- Wine price -->
                Stock: <?= $row["WineStock"] ?> bottles available
                <!-- Wine stock available -->
              </p>
              <img src="/WineShop/images/<?= $row["piccy"] ?>" class="img-fluid WineImage" alt="Wine Image">
              <!-- Wine image -->
              <br>
              <div class="form-group mt-auto">
                <!-- Form group for quantity input -->
                Quantity: <input type="number" class="form-control" name="qty" min="0" max="1000" value="0"><br>
                <!-- Quantity input -->
                <button type="submit" class="btn btn-primary">Add Wine</button>
                <!-- Button to add wine to basket -->
                <input type="hidden" name="WineID" value="<?= $row['WineID'] ?>">
                <!-- Hidden input for wine ID -->
              </div>
            </div>
          </div>
        </div>
    <?php
      }
    } else {
      // If the user selects a specific wine category, retrieve wines from that category

      $stmt = $conn->prepare("SELECT * from wine WHERE WineCategory = :category and WineStock > 0 ORDER by WinePrice DESC");
      // Prepare SQL query to select wines from the specified category with stock available, ordered by price in descending order
      $stmt->bindParam(':category', $q); // Bind the parameter ':category' to the value of $q
      $stmt->execute(); // Execute the prepared statement

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Loop through the fetched rows to display wine information
    ?>
        <!-- Displaying each wine as a card -->
        <div class="col mb-4">
          <!-- Bootstrap column layout -->
          <div class="card h-100 d-flex flex-column">
            <!-- Wine card -->
            <div class="card-body">
              <!-- Card body -->
              <h5 class="card-title"><?= $row["WineName"] ?></h5>
              <!-- Wine name -->
              <p class="card-text">
                <!-- Wine details -->
                Colour: <?= $row["WineCategory"] ?><br>
                <!-- Wine category -->
                Description: <?= $row["WineDescription"] ?><br>
                <!-- Wine description -->
                Country: <?= $row["Country"] ?><br>
                <!-- Wine origin country -->
                Price: £<?= $row["WinePrice"] ?><br>
                <!-- Wine price -->
                Stock: <?= $row["WineStock"] ?> bottles available
                <!-- Wine stock available -->
              </p>
              <img src="/WineShop/images/<?= $row["piccy"] ?>" class="img-fluid WineImage" alt="Wine Image">
              <!-- Wine image -->
              <br>
              <div class="form-group mt-auto">
                <!-- Form group for quantity input -->
                Quantity: <input type="number" class="form-control" name="qty" min="0" max="100" value="0"><br>
                <!-- Quantity input -->
                <button type="submit" class="btn btn-primary">Add Wine</button>
                <!-- Button to add wine to basket -->
                <input type="hidden" name="WineID" value="<?= $row['WineID'] ?>">
                <!-- Hidden input for wine ID -->
              </div>
            </div>
          </div>
        </div>
    <?php
      }
    }
    ?>
  </div>

  <?php
  // Including the database connection file
  include_once('connection.php');

  // Fetching and displaying data from the 'wine' table
  $stmt = $conn->prepare("SELECT * FROM wine");
  $stmt->execute();

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

    if (isset($_SESSION["wine"])) {
      // If the 'wine' session variable is set, display the number of items in the basket
      echo ("Basket contains ");
      echo count($_SESSION["WineStock"]) - 1;
      echo (" items<br>");
      // Link to view basket contents
      echo ("<a href=viewbasket.php>View basket contents</a>");
    }
  ?>
</body>
</html>