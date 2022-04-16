<?php

    //1. connect to db
    //2. create sql command
    //3. prepare statement
    //4. bind any variables (dont have to have variables)
    //5. execute your statement
    // process results
    
    //include 'connectPDO.php'; // brings in external file (step 1) // need to change based off local host or hosting account
    include 'connectPDOIPATCHEZ.php'; // brings in external file (step 1) // need to change based off local host or hosting account

    $sql = "SELECT event_id, event_name, event_description, event_presenter FROM wdv341_events"; // (step 2)

    $stmt = $conn->prepare($sql); // (step 3)

    $stmt->execute(); // (step 5)

    $stmt->setFetchMode(PDO::FETCH_ASSOC); // turn from database fromat to readable associative array (name, value)

    // ************ This page shows what can be deleted *************************
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <h1>WDV 341 Intro to PHP</h1>
    <h2>Testing pulling information from a database</h2>
    <h3>Current Events!</h3>
    <?php

    echo "<table style='width:100%'>";
    echo "<tr>";
    echo"<th>Event</th>
         <th>Event Description</th>
         <th>Event Presenter</th>";
    echo "</tr>";

    while($row=$stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['event_id'] . "</td>";
        echo "<td>" . $row['event_name'] . "</td>";
        echo "<td>" . $row['event_description'] . "</td>";
        echo "<td>" . $row['event_presenter'] . "<a href='deleteEvent.php?eventId=" . $row['event_id'] . "'>" . "<button> Delete </button>" . "<a href='editEvent.php?eventId=" . $row['event_id'] . "'>" . "<button> Edit </button>". "</td>";
        echo "</tr>";
    }

    echo "<a href='login.php'>Admin Functions</a>"
    
    ?>
</body>
</html>