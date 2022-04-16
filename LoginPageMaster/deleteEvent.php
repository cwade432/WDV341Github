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
    $eventId = "";
    $eventId = $_GET['eventId'];
    echo "The event id to delete is: " . $eventId . " ";

try {
    //require_once 'connectPDO.php';
    require_once 'connectPDOIPATCHEZ.php';

    $sql = "DELETE FROM wdv341_events WHERE event_id = :eventId;";

    $stmt = $conn->prepare($sql); // (step 3)

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':eventId', $eventId);

    $stmt->execute(); // (step 5)

    $count = $stmt->rowCount();
    echo "Deleted " . $count . " rows";
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
</head>
<body>
    <h1>WDV341 Delete Page</h1>

    <?php
        if($count > 0) {
            echo "<h3> Deleted " . $count . " rows for event id " . $eventId;
            echo "<p><a href='login.php'>Admin Functions</a></p>";
        }
        else {
            echo "<h3> ERROR: No rows deleted </h3>";
        }
    ?>
</body>
</html>