<?php
    //1. connect to db
    //2. create sql command
    //3. prepare statement
    //4. bind any variables (dont have to have variables)
    //5. execute your statement
    // process results

    $eventId = 1;
    
    //include 'connectPDO.php'; // brings in external file (step 1)
    include 'connectPDOIPATCHEZ.php'; // brings in external file (step 1)

    $sql = "SELECT * FROM petstore_products ORDER BY product_name DESC"; // (step 2)

    $stmt = $conn->prepare($sql); // (step 3)

    //$stmt->bindParam(':eventId', $eventId); // binding variable (step $) // dont need to bind product_id

    $stmt->execute(); // (step 5)

    $stmt->setFetchMode(PDO::FETCH_ASSOC); // turn from database fromat to readable associative array (name, value)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- Normal bootstrap import -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Php bootstrap import -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

</head>

    <style>
        /* *,:after,:before{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}
        body{font:normal 15px/25px 'Open Sans',Arial,Helvetica,sans-serif;color:#444;text-align:left}
        h2,h3{font-weight:400}
        h2{font-size:25px;line-height:30px;color:#484c9b;margin:50px 0 10px}
        h3{font-size:18px;line-height:35px;margin:50px 0 0}
        a{color:#484c9b;text-decoration:none}
        a:focus,a:hover{text-decoration:underline}
        p{margin:0 0 2rem}
        p span{color:#aaa}
        header{width:98%;margin:40px auto 0;border-bottom:1px solid #ddd;padding-bottom:40px;text-align:center}
        header p{margin:0}section{width:95%;max-width:910px;margin:40px auto}
        pre{background:#f9f9f9;padding:10px;font-size:12px;border:1px solid #eee;white-space:pre-wrap;border-radius:10px}
        table{border:1px solid #eee;background:#f9f9f9;width:100%;border-collapse:collapse;border-spacing:0;margin-bottom:3rem}
        thead{background:#5965af;color:#fff}
        tbody tr td,thead td{padding:.5rem .75rem}
        tbody tr:nth-child(even){background:#efefef}
        tbody tr td:first-child{padding-left:1.25rem}
        tbody tr td:first-child,tbody tr td:nth-child(3),thead td:first-child,thead td:nth-child(3){width:15%}tbody tr td:nth-child(2),thead td:nth-child(2){width:20%}tbody tr td:last-child,thead td:last-child{width:50%}@media only screen and (min-width:768px){body{font-size:20px;line-height:30px}h2{font-size:30px;line-height:45px}h3{font-size:22px;line-height:45px;margin-top:50px}p{margin-bottom:2rem}h1{font-size:60px}pre{padding:20px;font-size:15px}}
        section {display: flex; justify-content: space-between; max-width: 1200px;}
        .productBlock{width:calc(100% / 6);display:inline-block;margin:0 .5rem;border:none;padding:1rem;background:#efefef;border-radius:10px;font-size:.875rem;line-height:1.5}
        .productImage img{display:block;margin-left:auto;margin-right:auto;width:100%;height:auto}
        .productName{font-size:large;margin:1rem 0 .5rem;text-align:left}
        .productDesc{margin-left:10px;margin-right:10px;margin:0}
        .productPrice{font-size:larger;color:#00f;margin:.5rem 0;text-align:left}
        .productStatus{font-weight:bolder;color:#2f4f4f;margin:.5rem 0;text-align:left}
        .productInventory{margin:.5rem 0;text-align:left}
        .productLowInventory{color:red} */

        .jumbotron {
            text-align: center;
            margin: 2.5%;
            background-color: aliceblue;
            box-shadow: 5px 10px 8px 10px gainsboro;
            font-family: 'Oswald', sans-serif;
        }

        body {
        /* background-color: aliceblue; */
        background-image: linear-gradient(lightskyblue,aliceblue, aliceblue, aliceblue);
        /* font-family: 'Oswald', sans-serif; */
      }

        img{
            width: 150px;
            height: 150px;
        }

        #outerBox {
            width: 300px;
            height: auto;
            margin: auto;
            box-shadow: 5px 5px 5px 5px gainsboro;
            padding: 5%;
            background-color: transparent; 
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
              </ul>
            </div>
    </nav> <!--End of nav bar-->
    <div class="jumbotron"> <!--Start of jumbo-->
        <h1 class="display-3">Pet Products</h1>
        <p class="lead">Find what you need at low prices!</p>
        <hr class="my-2">
    </div> <!--End of jumbo-->
    <div class="container-fluid">
    <div class="row">
        <?php
                while($row=$stmt->fetch()) {
                    $image = $row['product_image'];                    
                    if($row['product_inStock'] < 10) { 
                        $row['product_inStock'] = "Low inventory! Only " . $row['product_inStock'];  
                    }
        ?>  
                <div id="out" style = "padding: 3%; margin: auto;" class=" col-lg-4 col-md-6 col-sm-6 ">
                    <div id="outerBox">
                    <div class="productImage" style="text-align: center;">
                        <?php echo '<img src="productImages/'. $image .' " />'; ?>
                    </div>
                    <h3 style="text-align: center; padding: 10px;"><?php echo $row['product_name']?> </h3>
                    <p><?php echo $row['product_description'];?></p>
                    <p><?php echo $row['product_price'] ?></p>
                    <!-- The productStatus element should only be displayed if there is product_status data in the record -->
                    <p><?php echo $row['product_status'] ?> </p>            
                    <p><?php echo $row['product_inStock'] ?> in stock!</p>
                    <input type="submit" class="btn btn-primary" name="button" id="button" value="Buy" />
                    </div>
                </div>
        <?php
                }
        ?>
    </div>
    </div>
</body>
</html>

<!-- Page to display pet product store -->