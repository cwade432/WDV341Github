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
    include 'Event.php';

    $sql = "SELECT event_name,event_description, event_presenter, event_date FROM wdv341_events WHERE event_id=:eventId"; // (step 2)

    $stmt = $conn->prepare($sql); // (step 3)

    $stmt->bindParam(':eventId', $eventId); // binding variable (step $)

    $stmt->execute(); // (step 5)

    $stmt->setFetchMode(PDO::FETCH_ASSOC); // turn from database fromat to readable associative array (name, value)

    // while($row=$stmt->fetch()) {
    //     echo "<br> " . $row['event_name'];
    //     echo "<br>";
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>JSON Objects</title>

    <style>
        
        span{
            margin-right: 10px;
        }

    </style>

</head>

<body>
    <h1>WDV 341 Intro to PHP</h1>
    <h2>Select ONE event from table</h2>
    <h3>Current Events!</h3>
    <?php
        while($row=$stmt->fetch()) {
            echo $row['event_name'] . ": ";
            echo $row['event_description'] . ",\n";
            echo $row['event_presenter'] . ",\n";
            echo $row['event_date'];

            echo "<h1> Teting outputting from Event obejct below </h1>";

            $name = $row['event_name'];
            $description = $row['event_description'];
            $presenter = $row['event_presenter'];
            $date = $row['event_date'];
            $eventObj = new Event($name, $description, $presenter, $date);
            $jsonObj = json_encode($eventObj);

            echo "<p>Event name with getter: " . $eventObj->getEventName() . "</p>";
            echo "<p>Event description with getter: " . $eventObj->getEventDescription() . "</p>";
            echo "<p>Event presenter with getter: " . $eventObj->getEventPresenter() . "</p>";
            echo "<p>Event presenter with getter: " . $eventObj->getEventDate() . "</p>";
            echo "<p>Event object encoded:" . $jsonObj . "</p>";
        }
    ?>
</body>
</html>