<?php

    $firstName = "Caleb Wade";
    $number1 = 1;
    $number2 = 2;
    $number3 = 3;
    $total = $number1 + $number2 + $number3;
    $phpArray = array("PHP","HTML","Javascript");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>

        let javascriptArray = new Array();

    </script>
</head>
<body>
    <h1>WDV 341 Intro to php</h1>
    <?php echo "<h2>Hello my name is $firstName </h2>"; ?>
    <?php echo "<p>The values being added are $number1 + $number2 + $number3</p>"; ?>
    <?php echo "<p>The total of the values is: $total</p>"; ?>
    <?php 
        echo "Testing PHP array: ";
        $stringOut = "";
        foreach($phpArray as $test) {
            echo "'" . $test . "', ";
        }
    ?>

    <p> Testing javascript output:
        <a id="outputJavascriptArray"></a>
    </p>
    
    <?php
    foreach($phpArray as $test) {
    ?>
        <script> javascriptArray.push("<?php echo $test; ?>"); </script>    <!-- trying to push results of php array into javascript array -->  
    <?php
    } 
    ?>

    <script>
        let out = "";
        for(let i = 0; i < javascriptArray.length; i++) {
            out += javascriptArray[i] + " ";
        }
        document.getElementById("outputJavascriptArray").innerHTML = out;
    </script>

    <script>console.log(javascriptArray)</script> <!-- Expecting javascriptArray to have values in console -->
</body>
</html>

