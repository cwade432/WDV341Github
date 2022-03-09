<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        .jumbotron {
            background-color: aliceblue;
            padding: 10%;
            margin-right: 5%;
            box-shadow: 5px 10px 8px 10px gainsboro;
            font-family: 'Oswald', sans-serif;"
        }

        .flex-outer {
            padding: 5%;
        }

        body {
            background-color: aliceblue;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="flex-outer">
                <div class="jumbotron">
                    <?php                    
                        date_default_timezone_set('America/Los_Angeles');
                        echo "<h1>Thank you " . $_POST['contact_name'] . " \n for contacting us! </h1>";
                        echo "<h3>We have sent a confirmation email at: \n" . $_POST['contact_email'] . "</h3>";
                        echo "<h4>We will respond shortly!</p>";
                        echo "<p> <em> Date contacted: " . date('m/d/Y') . "</em> </p>";

                        // For checking on adding image data
                        // echo "<table border='1'>";
                        // echo "<tr><th>Field Name</th><th>Value of Field</th></tr>";
                        // foreach($_POST as $key => $value)
                        // {
                        //     echo '<tr>';
                        //     echo '<td>',$key,'</td>';
                        //     echo '<td>',$value,'</td>';
                        //     echo "</tr>";
                        // } 
                        // echo "</table>";
                        // echo "<p>&nbsp;</p>";
                    ?>
                </div> 
            </div>
        </div>
        <?php
            // Start of client message
            $clientTo = $_POST['contact_email'];
            $clientSubject = 'Contact Information';
            $clientMsg = '
            <html>
            <head>
            <title>Contact Confirmation</title>
            </head>
            <body> 
            <h1>Thank you!</h1>';
            $clientMsg .= '<h3>Hello ' . $_POST['contact_name'] . '</h3>';
            $clientMsg .= '<p>We have recieved your request for <strong>' . $_POST['contact_reason'] . '</strong> </p>';
            $clientMsg .= '<p>We have also read your comments: </p>';
            $clientMsg .= '<p> ' . $_POST['comments'] . ' </p>';
            // $clientMsg .= '<p> ' . $_POST['user_file'] . ' </p>';
            // need to add end php tag here
        ?>        
            <p><img src="<?php $_POST['user_file'] ?>"></p>
        <?php 
            // start new php tag here for rest of message
            $clientMsg .= '<p>We will respond to your request shortly ' . '</p>';  
            $clientMsg .= '<p> <em> Contact request recieved ' . date('m/d/Y') . '</em> </p>';
            $clientMsg .= '
            </body>
            </html>
            ';
            //$msg = wordwrap($msg, 70);
            $clientHeader = 'MIME-Version: 1.0' . "\r\n";
            $clientHeader .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
            $clientHeader .= 'From: caleb.wade@ipatchez.com' . "\r\n";
            $clientMailer = mail($clientTo, $clientSubject, $clientMsg, $clientHeader);

            // if($clientMailer == true) {
            //     echo "Client message sent successfully :) \n";
            // }
            // else {
            //     echo "Client message not sent successfully :( \n";
            // }
            //End of client message

            // Start of admin message
            $adminTo = 'caleb.wade432@gmail.com';
            $adminSubject = 'Customer Contact Information';
            $adminMsg = '
            <html>
            <head>
            <title>Contact Confirmation</title>
            </head>
            <body> 
            <h1>Client Contact Information</h1>';
            $adminMsg .= '<p>Name: ' . $_POST['contact_name'] . '</p>';
            $adminMsg .= '<p>Contact Reason: ' . $_POST['contact_reason'] . '</p>';
            $adminMsg .= '<p>Comments: ' . $_POST['comments'] . ' </p>';
            $adminMsg .= '<p> ' . $_POST['user_file'] . ' </p>';
            $adminMsg .= '<p> <em> Contact request recieved ' . date('m/d/Y') . '</em> </p>';
            $adminMsg .= '
            </body>
            </html>
            ';
            //$msg = wordwrap($msg, 70);
            $adminHeader = 'MIME-Version: 1.0' . "\r\n";
            $adminHeader .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
            $adminHeader .= 'From: caleb.wade@ipatchez.com' . "\r\n";
            $adminMailer = mail($adminTo, $adminSubject, $adminMsg, $adminHeader);

            // if($adminMailer == true) {
            //     echo "Admin message sent successfully :) \n";
            // }
            // else {
            //     echo "Admin message not sent successfully :( \n";
            // }
            // End of admin message
        ?>
    </div>
</body>
</html>