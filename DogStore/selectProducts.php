<?php

    //1. connect to db
    //2. create sql command
    //3. prepare statement
    //4. bind any variables (dont have to have variables)
    //5. execute your statement
    // process results
    
    //include 'connectPDO.php'; // brings in external file (step 1) // need to change based off local host or hosting account
    include 'connectPDOIPATCHEZ.php'; // brings in external file (step 1) // need to change based off local host or hosting account

    $sql = "SELECT * FROM petstore_products"; // (step 2)

    $stmt = $conn->prepare($sql); // (step 3)

    $stmt->execute(); // (step 5)

    $stmt->setFetchMode(PDO::FETCH_ASSOC); // turn from database fromat to readable associative array (name, value)

    // ************ This page shows what can be deleted *************************

    if(!empty($_POST['honeypot'])) {
        echo "<h1>Bot Detected: NO NO NO";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Document</title>

    <style>
        
        span{
            margin-right: 10px;
        }

        table, th, td {
            border:1px solid black;
        }

    </style>

</head>

<body>
    <nav class="navbar navbar-expand-bg bg-transparent navbar-light">
            <!--Put image for logo or name of website-->
            <a class="navbar-brand" href="index.html">Pet Store</a>
          
            <!--Collapsibe Button-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <!--Navbar Links-->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="petProducts.php">Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="petStoreContactPage.html">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="adminLogin.php">Admin Login</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="aboutUs.html">About us</a>
                </li> -->
              </ul>
            </div>
    </nav> <!--End of nav bar-->
    <div class="container-fluid">
      <h1>Petstore Products Admin Page</h1>
      <h2>Edit or Delete Products</h2>
    </div>
      <form>
      <p>
          <input type="hidden" name="honeypot" style="display:none">
      </p>
      </form>
      <?php // ** Look into bootstrap table for responsive
      echo "<div class='container-fluid'>";
      echo "<p><a href='adminInsert.php'>Add Products</a></p>";
      echo "<table class='table table-hover table-borderless'>";
      echo "<thead class='thead-light'>";
        echo "<tr>";
          echo "
              <th>Id</th>
              <th>Product Name</th>
              <th>Product Description</th>
              <th>Product Price</th>
              <th>Product Image</th>
              <th>Product Stock</th>
              <th>Product Status</th>
              <th>Product Date</th>";
        echo "</tr>";
      echo "</thead>";
      while($row=$stmt->fetch()) {
        echo "<tbody>";
          echo "<tr>";
            echo "<td>" . $row['product_id'] . "</td>";
            echo "<td>" . $row['product_name'] . "</td>";
            echo "<td>" . $row['product_description'] . "</td>";
            echo "<td>" . $row['product_price'] . "</td>";
            echo "<td>" . $row['product_image'] . "</td>";
            echo "<td>" . $row['product_inStock'] . "</td>";
            echo "<td>" . $row['product_status'] . "</td>";
            echo "<td>" . $row['product_update_date'] . "</br> <a href='adminDelete.php?productId=" . $row['product_id'] . "'>" . "<button> Delete </button> " . " <a href='adminEdit.php?productId=" . $row['product_id'] . "'>" . "<button> Edit </button>". "</td>";
          echo "</tr>";
        echo"</tbody>";
      }
      echo "</table>";
      echo "<p><a href='adminLogout.php'>Log out</a></p>";
      echo "</div>";
      ?>
    </div>
    </body>
</html>