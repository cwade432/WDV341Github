<?php

function toNaDate($inDate) {
    $outDate = date("m/d/Y", $inDate);
    return $outDate;
}

function toEuDate($inDate) {
    $outDate = date("d/m/Y", $inDate);
    return $outDate;
}

function  printStringLength($inString) {
    return strlen($inString);
}

function trimString($inString) {
    $trimmedString = trim($inString, " \t\n\r");
    return $trimmedString;
}

function toLowerCase($inString) {
    $lowerCaseString = strtolower($inString);
    return $lowerCaseString;
}

function displayIf($inString) {
    if(str_contains($inString, 'DMACC') || str_contains($inString, 'dmacc')) {
        return $inString;
    }
    echo "you lose";
}

function formatPhoneNumber($inNumber) { // probably change this to substr
    $inNumber = preg_replace("/[^\d]/", "", $inNumber);
    $count = strlen($inNumber);

    if($count == 10) {
        $inNumber = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $inNumber);
    }
    return $inNumber;
}

function formatUsCurrency($inNumber) {
    $formattedCurrency = number_format($inNumber, 2, '.', '');
    return $formattedCurrency;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            /* text-align: center;
            padding: 50px; */
        }
    </style>
</head>
<body>
    <h1>WDV 341 Intro to PHP</h1>
    <h2>Module 4 PHP functions</h2>

    <h3>Todo list:</h3>
    <p>This is for timestamp to date mm/dd/yyyy</p>
    <p>This is for timestamp to date dd/mm/yyyy</p>
    <p>Function that accepts string input
        <li>number of characters DONE</li>
        <li>trim white space</li>
        <li>display all in lowercase</li>
        <li>display string if the string contains "DMACC" in lower or upper case</li>
    </p>
    <p>Function to accept number and display in phone number format, use for testing 1234567890</p>
    <p>Create function to accept number and display in us currency format, use for testing 123456</p>
    <hr/>
    <h3>Completed tasks</h3>
    <p>Date mm/dd/yyyy: <?php echo toNaDate(1093059009)?></p>
    <p>Date dd/mm/yyyy: <?php echo toEuDate(1093059009)?></p>
    <p>String length: <?php echo printStringLength("this is a test string")?></p>
    <p>String trim: <?php echo "                                 this is a test trim string                                    \n\r"?></p>
    <p>String trim: <?php echo trimString("                                 this is a trim test string                                    ")?></p>
    <p>Uppercase: <?php echo "THIS IS AN UPPER CASE SENTANCE"?></p>
    <p>Uppercase: <?php echo toLowerCase("THIS IS AN UPPER CASE SENTANCE INSIDE THE TOLOWERCASE FUNCTION")?></p>
    <p>Display if contains dmacc fail: <?php echo displayIf("this is a test sentance i should not see again")?></p>
    <p>Display if contains DMACC: <?php echo displayIf("this one DMACC should work")?></p>
    <p>Display unformatted phone number: <?php echo 1234567890?></p>
    <p>Display formatted phone number: <?php echo formatPhoneNumber(1234567890)?></p>
    <p>Display unformatted currency: <?php echo 1234.5678?></p>
    <p>Display formatted currency: <?php echo formatUsCurrency(1234.5678)?></p>
</body>
</html>