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
    $adminUserName = "";        
    $adminPassword = "";
    
// Error Message initialize
    $adminUserNameErrorMsg = "";
    $adminPasswordErrorMsg = "";

    $validForm = "";

if( isset($_POST['submit'])){
    //form has been SUBMITTED by the user
    //echo "<h1>Form has been submitted</h1>";

    $adminUserName = $_POST['admin_username'];
    $adminPassword = $_POST['admin_password'];

    //echo "<p>$productName, $productDesc, $productPrice</p>";

    //Validate input values

    $validForm = true;      //always assume the form is Good at the beginning

    //VALIDATION 
    if($adminUserName == ""){
        //display error for product name
        $adminUserNameErrorMsg = "Username is required";
        $validForm = false;
    }

    if($adminPassword == ""){
        $adminPasswordErrorMsg = "Password is required";
        $validForm = false;
    }

    if(!empty($_POST['honeypot'])) {
        echo "<h1>Bot Detected: NO NO NO";
    }

    //if the form is good then continue server side processing
    //else display form to the users with any error messages as needed
    if( $validForm ){
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

            //build the sql statement   use the INSERT statement

                // $sql = "INSERT INTO wdv341_products ";
                // $sql .= "(product_name, product_description, product_price, product_date_inserted) ";
                // $sql .= "VALUES (:name, :desc, :price, :date_insert);";
                
            $sql = "INSERT INTO admin_user (admin_username, admin_password) VALUES (:username, :password);";

            //prepare the statement
            $stmt = $conn->prepare($sql);

            //bind the parameters
            $stmt->bindParam(':username', $adminUserName);
            $stmt->bindParam(':password', $adminPassword);

            //execute the statement
            $stmt->execute();
            //echo "Testing row count below:";
            //echo $stmt->rowCount();
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
else{
    //the user needs to see the empty form so they can enter data
    //echo "<h1>Form is new and needs to be input</h1>";
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
        <?php
            if($validForm){
                echo "<h3>Thank you! New admin user has been added!</h3>";
                echo "<p><strong>Product Name: </strong>" . $adminUserName . "</p>";
                echo "<p><strong>Product Description: </strong>" . $adminPassword . "</p>";
                echo "<p><a href='adminLogin.php'>Admin Home</a></p>";
                echo "<p><a href='selectProducts.php'>Product List</a></p>";
            }
            else{
        ?>
<form method="post" action="adminInsertUser.php">
    <h1>Admin Insert User</h1>
            </br>
    <div class="container-fluid">
        <p>
            <label for="product_name">Username: </label>
            <input type="text" name="admin_username" id="admin_username" value="<?php echo $adminUserName; ?>">
            <span class="errorMsg"><?php echo $adminUserNameErrorMsg; ?></span>
        </p>
        <p>
            <label for="product_description">Password: </label>
            <input type="text" name="admin_password" id="admin_password" value="<?php echo $adminPassword; ?>">
            <span class="errorMsg"><?php echo $adminPasswordErrorMsg; ?></span>
        </p>
        <p>
            <input type="submit" value="Add User" name="submit">
            <input type="reset" value="Reset">
        </p>
    </div>
</form>
<?php
        }//end if statement to show form or not show form on confirmation
?>

</body>
</html>