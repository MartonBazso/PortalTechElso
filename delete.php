<?php
if(!isset($_SESSION)) session_start();
require_once("connect.php");
if (isset($_POST["commentToDelete"])) {
       if(!isset($_SESSION)) session_start();    
    if($_SESSION["role"] == "moderator"){
        $delete_comment = "DELETE FROM `comments` WHERE Id =" . $_POST["commentToDelete"];
        
        mysqli_query($kapcsolat, $delete_comment);
            
    }
    
    header("Location:details.php?topic=".$_SESSION["topicId"]);
}?>