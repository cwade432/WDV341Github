<?php
session_start();        //access the current session or start a new session

if( isset($_SESSION['validUser'])){
    //already signed on, go to admin panel
    session_unset();
    session_destroy();
    header("Location: adminLogin.php");              //PHP redirect back to another page
}
else{
    header("Location: adminLogin.php");              //PHP redirect back to another page
}
?>