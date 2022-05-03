<?php
session_start();        //access the current session or start a new session
/*
    If you are already a validUser (signed in) then you should go directly to
    the admin panel
*/
if( isset($_SESSION['validUser'])){
    //already signed on, go to admin panel
    $validUser = true;      //make you a validUser for THIS page

    //get username
    $userName = $_SESSION['userName'];
}
else{
    //NOT a valid user display form or process submitted form

    $userName = "";
    $passWord = "";
    
    $validUser = true;
    $msg = "";

    if( isset($_POST['submit'])){

        //echo "<h1>Form has been submitted!</h1>";
    
        $userName = $_POST['username'];
        $passWord = $_POST['password'];
    
        //connect to the database
    
        //require 'connectPDO.php';
        require 'connectPDOIPATCHEZ.php'; // brings in external file (step 1)
    
        //$sql = "SELECT * FROM event_user WHERE event_user_name = :user AND event_user_name = :pass";
        $sql = "SELECT count(*) FROM admin_user WHERE admin_username = :user AND admin_password = :pass";
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(':user', $userName);
        $stmt->bindParam(':pass', $passWord);
    
        $stmt->execute(); 
        
        $rowCount = $stmt->fetchColumn();   //determine if you are in the table
    
        //echo "<h2>We found $rowCount rows for $userName and $passWord</h2>";
    
        //if $rowCount > 0 what do I know?  We found a valid username/password combination
    
        if($rowCount > 0){
            //valid user, display admin options
            $validUser = true;
            //set a validUser SESSION variable to true
            $_SESSION['validUser'] = true; 
            $_SESSION['userName'] = $userName;       //save for future pages/accesses 
        }
        else{
            $validUser = false;     //did not find login on table you are NOT a valid user
            $msg = "Invalid username or password, please try again!";
        }
    
    }
    else{
        //display the login form
        //echo "<h1>Please enter the form data</h1>";
        $validUser = false;     //did not submit the form, you cannot be a valid user
    }
}
//endif for validUser

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

    <style>
        .adminLoginFormat {
            padding: 2.5%;
        }
    </style>

</head>
<body>

<?php 
if(!$validUser){
    //NOT a valid user then display form
    ?>
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
              </ul>
            </div>
        </nav> <!--End of nav bar-->

    <div class="container-fluid">    
        <h3>Please Login to access your Admin Functions</h3>
        <p style="color:red"><?php echo $msg;?></p>
        <form method="post" action="#">
            <p>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" placeholder="Username">
            </p>
            <p>
                <label for="password">Password: </label>
                <input type="text" name="password" id="password">
            </p>
            <p>
                <input type="submit" value="Sign On" name="submit" id="submit">
                <input type="reset">
            </p>
        </form>
    </div>
    <?php
}
else{
        //VALID user display Admin
    ?>
        <!-- display this area for a valid user to show Admin options -->
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
              </ul>
            </div>
        </nav> <!--End of nav bar-->
    <div class="container-fluid">
        <h1>Admin Operation Page</h1>
        </br>
        <h3>Admin Operations</h3>
        <ul>
            <li><a href="selectProducts.php">View Products</li></a>
            <!-- <li><a href="adminInsert.php">Admin Insert</li></a> -->
        </ul>
            <p><a href="adminLogout.php">Logout of Admin Panel</a></p>
    </div>

    <?php   
}
    ?>
<div class="container-fluid">
    <p>Copyright &copy;	2022 Pet Store LLC</p>
</footer>
</div>
</body>

</html>