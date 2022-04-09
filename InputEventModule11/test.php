<?php
try{
            require 'connectPDO.php';

            //How to check for duplicate entries
            //MUST KNOW THE RULES of the application/data
            //take the input value(s) to read the database looking for those values
            //SELECT event_description from wdv341_events table where event_description = :eventDesc;
            //if you find one or more rows in the result you have a duplicate

            $today = date("Y-m-d"); //today's date as YYYY-MM-DD

            //build the sql statement   use the INSERT statement

                $sql = "INSERT INTO wdv341_events (event_name, event_description) VALUES ('wdv101', 'testing event description')";
                //$sql .= "(event_name, event_description, event_presenter, event_date_inserted) ";
                //$sql .= "VALUES (:name, :desc, :presenter, :date_insert);";

            //prepare the statement
            $stmt = $conn->prepare($sql);

            //bind the parameters
            // $stmt->bindParam(':name',$eventName);
            // $stmt->bindParam(':desc',$eventDesc);
            // $stmt->bindParam(':presenter',$eventPresenter);
            // $stmt->bindParam(':date_insert',$today);

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
?>