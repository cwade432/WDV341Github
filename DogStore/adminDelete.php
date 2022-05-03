<?php

if( isset($_SESSION['validUser'])){
    //already signed on, go to admin panel
    $validUser = true;      //make you a validUser for THIS page

    //get username
    $userName = $_SESSION['userName'];
}
// else {
//     header("Location: deleteEvent.php");
// }

    // deleting record from event table using event_Id

    // DELETE FROM wdv341_event WHERE event_id = :eventId;
    $productId = "";
    $productId = $_GET['productId'];
    //echo "The product id to delete is: " . $productId . " ";

try {
    //require_once 'connectPDO.php';
    require_once 'connectPDOIPATCHEZ.php';

    $sql = "DELETE FROM petstore_products WHERE product_id = :productId;";

    $stmt = $conn->prepare($sql); // (step 3)

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':productId', $productId);

    $stmt->execute(); // (step 5)

    $count = $stmt->rowCount();
    //echo "Deleted " . $count . " rows";
}
catch(PDOException $e) {
    $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
    error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
    error_log(var_dump(debug_backtrace()));
    //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <h1>WDV341 Delete Page</h1>
</br>
    <?php
        if($count > 0) {
            echo "<h4>" . $count . " row deleted, product id " . $productId . "</h4>";
            echo "<p><a href='selectProducts.php'>Product List</a></p>";
            echo "<p><a href='adminLogin.php'>Admin Homepage</a></p>";
        }
        else {
            echo "<h4> ERROR: No rows deleted </h4>";
            echo "<p><a href='selectProducts.php'>Product List</a></p>";
        }
    ?>
  </div>
</body>
</html>