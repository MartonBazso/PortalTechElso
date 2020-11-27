<?php
if(!isset($_SESSION)) session_start();
require_once("connect.php");
if (isset($_POST["comment"])) {
       if(!isset($_SESSION)) session_start();    
    
    $add_comment = "INSERT INTO `comments`(`UserId`, `TopicId`, `Text`) 
    VALUES (".$_SESSION["userId"].", ".$_SESSION["topicId"].", '".mysqli_escape_string($kapcsolat, $_POST["comment"])."')"; //SQL Injection veszély

        echo $add_comment;
        mysqli_query($kapcsolat, $add_comment);
        
    header("Location:details.php?topic=".$_SESSION["topicId"]);
}?>