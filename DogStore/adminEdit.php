<?php
//if you are a valid user then you can access this page else redirect to login
session_start();

if(isset($_SESSION['validUser']) && $_SESSION['validUser']  ){
    //allow access
}
else{
    //deny access, return to login page/home page
    //header("Location: login.php");
}

//create a default empty variable for the first time through
    $productName = "";        
    $productDesc = "";
    $productPrice = "";
    $productImage = ""; // Will work on adding after all other fields work
    $productInStock = "";
    $productStatus = "";
    $productDate = "";

    $productNameErrorMsg = "";
    $productDescErrorMsg = "";
    $productPriceErrorMsg = "";
//  $productImageErrorMsg = ""; // Will work on adding after all other fields work
    $productInStockErrorMsg = "";
    $productStatusErrorMsg = "";
    $productDateErrorMsg = "";

    $validForm = "";


if( isset($_POST['submit'])){
    //form has been SUBMITTED by the user
    //echo "<h1>Form has been submitted</h1>";

    $productId = $_GET['productId'];
    $productName = $_POST['product_name'];
    $productDesc = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $productImage = $_POST['product_image']; 
    $productInStock = $_POST['product_inStock'];
    $productStatus = $_POST['product_status'];


    //echo "<p>$productName, $productDesc, $productPrice</p>";

    //Validate input values

    $validForm = true;      //always assume the form is Good at the beginning

    //VALIDATION 
    if($productName == ""){
        //display error for product name
        $productNameErrorMsg = "Product Name is required";
        $validForm = false;
    }

    if($productDesc == ""){
        $productDescErrorMsg = "Product Description is required";
        $validForm = false;
    }

    if($productPrice == ""){
        $productPriceErrorMsg = "Product Price is required";
        $validForm = false;
    }

    if($productInStock == ""){
        $productInStockErrorMsg = "Product stock is required";
        $validForm = false;
    }

    if(!empty($_POST['honeypot'])) {
        echo "<h1>Bot Detected: NO NO NO";
    }

    //if the form is good then continue server side processing
    //else display form to the users with any error messages as needed
    if($validForm) {
        //echo "<p>Form is valid. So insert into the database</p>";

        //INSERT data into the database!
        //Working with a database main steps!
        //connect to the database
        try{
            //require 'connectPDO.php';
            require 'connectPDOIPATCHEZ.php';

            //How to check for duplicate entries
            //MUST KNOW THE RULES of the application/data
            //take the input value(s) to read the database looking for those values
            //SELECT product_description from wdv341_products table where product_description = :productDesc;
            //if you find one or more rows in the result you have a duplicate

            $today = date("Y-m-d"); //today's date as YYYY-MM-DD
            $time = date("h:i:s");

            $sql = "UPDATE petstore_products SET product_name = :name, product_description = :desc, product_price = :price, product_inStock = :stock, product_status = :status, product_image = :image WHERE product_id = :productId";

            //prepare the statement
            $stmt = $conn->prepare($sql);

            //bind the parameters
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':name', $productName);
            $stmt->bindParam(':desc', $productDesc);
            $stmt->bindParam(':price', $productPrice);
            $stmt->bindParam(':stock', $productInStock);
            $stmt->bindParam(':status', $productStatus);
            $stmt->bindParam(':image', $productImage);

            //execute the statement
            $stmt->execute();
            // echo "Testing row count below:";
            // echo $stmt->rowCount();
        }
        catch(PDOException $e)
        {
            $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
            error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
            error_log(var_dump(debug_backtrace()));
            //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
        }


    }
    else{
        //echo "<p>Please fix errors on the form</p>";
        //display the form
        //display any error messages
        //display the form with the values in the form fields
    }
}
    else {
    //For update form the user needs to see the event they selected to update
    // 0. get event id to update
    // 1. connect to db
    // 2. create sql command
    // 3. prepare statement
    // 4. bind any variables (dont have to have variables)
    // 5. execute your statement
    // process results
        $productId = $_GET['productId'];

        try {
            //require_once 'connectPDO.php';
            require_once 'connectPDOIPATCHEZ.php'; // brings in external file (step 1)
            $sql = "SELECT product_name, product_description, product_price, product_inStock, product_status, product_image FROM petstore_products WHERE product_id = :productId";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $row=$stmt->fetch();
            // **************************************** Get product status and add input to add pictures to products *********************************
            $productName = $row['product_name'];
            $productDesc = $row['product_description'];
            $productPrice = $row['product_price'];
            $productInStock = $row['product_inStock'];
            $productStatus = $row['product_status'];
            $productImage = $row['product_image'];
        }
        catch(PDOException $e) {
            $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
            error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
            error_log(var_dump(debug_backtrace()));
            //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
        }
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
<?php
    if($validForm){
    echo "<div class='container-fluid'>";
        echo "<h3>Thank you! Product has been edited</h3>";
        echo "<p>Product Id: " . $productId . "</p>";
        echo "<p><strong>Product Name: </strong>" . $productName . "</p>";
        echo "<p><strong>Product Description: </strong>" . $productDesc . "</p>";
        echo "<p><strong>Product Price: </strong>" . $productPrice . "</p>";
        echo "<p><strong>Product Stock: </strong>" . $productInStock . "</p>";
        echo "<p><strong>Product Status: </strong>" . $productStatus . "</p>";
        echo "<p><a href='selectProducts.php'>Product List</a></p>";
    echo "</div>";
    }
    else{
?>
<form method="post" action="adminEdit.php?productId=<?php echo $productId; ?>">
<div class="container-fluid">
    <h1>Admin Edit Page</h1>
    <p>
        <label for="product_name">Product Name: </label>
        <input type="text" name="product_name" id="product_name" value="<?php echo $productName; ?>">
        <span class="errorMsg"><?php echo $productNameErrorMsg; ?></span>
    </p>
    <p>
        <label for="product_description">Product Description: </label>
        <input type="text" name="product_description" id="product_description" value="<?php echo $productDesc; ?>">
        <span class="errorMsg"><?php echo $productDescErrorMsg; ?></span>
    </p>
    <p>
        <label for="product_price">Product Price: </label>
        <input type="text" name="product_price" id="product_price" value="<?php echo $productPrice; ?>">
        <span class="errorMsg"><?php echo $productPriceErrorMsg; ?></span>
    </p>
    <p>
        <label for="product_inStock">Product Stock: </label>
        <input type="text" name="product_inStock" id="product_inStock" value="<?php echo $productInStock; ?>">
        <span class="errorMsg"><?php echo $productPriceErrorMsg; ?></span>
    </p>
    <p>
        <label for="product_status">Product Status: </label>
        <input type="text" name="product_status" id="product_status" value="<?php echo $productStatus; ?>">
        <span class="errorMsg"><?php echo $productInStockErrorMsg; ?></span>
    </p>
    <p>
        <label for="product_image">Product Image: </label>
        <input type="text" name="product_image" id="product_image" value="<?php echo $productImage; ?>">
        <span class="errorMsg"><?php echo $productInStockErrorMsg; ?></span>
    </p>
    <p>
        <input type="submit" value="Submit" name="submit">
        <input type="reset" value="Reset">
    </p>
</div>
</form>
<?php
        }//end if statement to show form or not show form on confirmation
?>

</body>
</html>