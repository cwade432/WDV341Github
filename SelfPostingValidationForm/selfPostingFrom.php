<?php
//create a default empty variable for the first time through
    $eventName = "";        
    $eventDesc = "";
    $eventPresenter = "";

    $eventNameErrorMsg = "";
    $eventDescErrorMsg = "";
    $eventPresenterErrorMsg = "";

    $validForm = "";


if( isset($_POST['submit'])){
    //form has been SUBMITTED by the user
    //echo "<h1>Form has been submitted</h1>";

    $eventName = $_POST['event_name'];
    $eventDesc = $_POST['event_description'];
    $eventPresenter = $_POST['event_presenter'];

    //echo "<p>$eventName, $eventDesc, $eventPresenter</p>";

    //Validate input values

    $validForm = true;      //always assume the form is Good at the beginning

    //VALIDATION 
    if($eventName == ""){
        //display error for event name
        $eventNameErrorMsg = "Event Name is required";
        $validForm = false;
    }

    if($eventDesc == ""){
        $eventDescErrorMsg = "Event Description is required";
        $validForm = false;
    }

    if($eventPresenter == ""){
        $eventPresenterErrorMsg = "Event Presenter is required";
        $validForm = false;
    }

    
}
else{
    echo "<h2>Display form for input</h2>"; // if form has not been submitted
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Input Form</title>

    <style>
        .errorMsg {
            color:red;
            font-style: italic;
        }

        #test_name {
            display: none;
        }

    </style>
</head>
<body>
    <header>
        <h1>WDV341 Intro PHP</h1>
        <h2>11-1 Input Event Form</h2>
    </header>
    <?php
        if($validForm){
            echo "<h3>Thank you! Your event has been submitted.</h3>";
            echo "<h4>Information submitted </h4>";
            echo "<p>Event name: " . $eventName . "</p>";
            echo "<p>Event description: " . $eventDesc . "</p>";
            echo "<p>Event presenter: " . $eventPresenter . "</p>";
        }
        else{
    ?>
    <form method="post" action="selfPostingFrom.php">
        <p>
            <label for="event_name">Event Name: </label>
            <input type="text" name="event_name" id="event_name" placeholder="Name" value="<?php echo $eventName; ?>">
            <input type="text" name="test_name" id="test_name">
            <span class="errorMsg"><?php echo $eventNameErrorMsg; ?></span>
        </p>
        <p>
            <label for="event_description">Event Description: </label>
            <input type="text" name="event_description" id="event_description" value="<?php echo $eventDesc; ?>">
            <span class="errorMsg"><?php echo $eventDescErrorMsg; ?></span>
        </p>
        <p>
            <label for="event_presenter">Event Presenter: </label>
            <input type="text" name="event_presenter" id="event_presenter" value="<?php echo $eventPresenter; ?>">
            <span class="errorMsg"><?php echo $eventPresenterErrorMsg; ?></span>
        </p>
        <p>
            <input type="submit" value="Submit" name="submit">
            <input type="reset" value="Try Again">
        </p>
    </form>
    <?php
            }//end if statement to show form or not show form on confirmation
    ?>
    
</body>
</html>
