<?php
// if you are a valid user then you can access this page else redirect to login
session_start();

if(isset($_SESSION['validUser']) && $_SESSION['validUser']  ){
    //allow access
}
else{
    //deny access, return to login page/home page
    //header("Location: login.php");
}

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
            //SELECT event_description from wdv341_events table where event_description = :eventDesc;
            //if you find one or more rows in the result you have a duplicate

            $today = date("Y-m-d"); //today's date as YYYY-MM-DD
            $time = date("h:i:s");

            //build the sql statement   use the INSERT statement

                // $sql = "INSERT INTO wdv341_events ";
                // $sql .= "(event_name, event_description, event_presenter, event_date_inserted) ";
                // $sql .= "VALUES (:name, :desc, :presenter, :date_insert);";
                
            $sql = "INSERT INTO wdv341_events (event_name, event_description, event_presenter, event_date, event_time, event_date_inserted, event_date_updated) VALUES (:name, :desc, :presenter, :date, :time, :date_insert, :date_update);";

            //prepare the statement
            $stmt = $conn->prepare($sql);

            //bind the parameters
            $stmt->bindParam(':name', $eventName);
            $stmt->bindParam(':desc', $eventDesc);
            $stmt->bindParam(':presenter', $eventPresenter);
            $stmt->bindParam(':date', $today);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':date_insert', $today);
            $stmt->bindParam(':date_update', $today);

            //execute the statement
            $stmt->execute();
            echo "Testing row count below:";
            echo $stmt->rowCount();
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
    <title>Events Input Form</title>

    <style>
        .errorMsg {
            color:red;
            font-style: italic;
        }

    </style>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>

    <h2>11-1 Input Event Form</h2>

    <?php
        if($validForm){
            echo "<h3>Thank you! Your event has been submitted.</h3>";
            echo "<p>" . $eventName . "</p>";
            echo "<p>" . $eventDesc . "</p>";
            echo "<p>" . $eventPresenter . "</p>";
            echo "<p><a href='login.php'>Admin Functions</a></p>";
        }
        else{
    ?>
    <form method="post" action="inputEvent.php">
        <p>
            <input type="hidden" name="honeypot">
            <label for="event_name">Event Name: </label>
            <input type="text" name="event_name" id="event_name" placeholder="Name" value="<?php echo $eventName; ?>">
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
        <p>
            <a href="login.php">Admin Functions</a>
        </p>
    </form>
    <?php
            }//end if statement to show form or not show form on confirmation
    ?>
    
</body>
</html>
