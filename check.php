<?php
ob_start();
if (isset($_POST["submit"])) {

    require_once("connect.php");

    $username = mysqli_real_escape_string($kapcsolat, $_POST["username"]);
    $password_hashed = sha1(mysqli_real_escape_string($kapcsolat, $_POST["password"]));
    $sql= "SELECT * FROM Users WHERE username='$username' AND password='$password_hashed' LIMIT 1";
    $query = mysqli_query($kapcsolat,$sql);

    if(mysqli_num_rows($query)==1){

        if(!isset($_SESSION))session_start();

        $row = $query -> fetch_array(MYSQLI_ASSOC);
        $_SESSION["username"]=$username;
        $_SESSION["loggedin"]="loggedin";
        $_SESSION["role"]=$row["role"];

        header("Location:main.php");

    }else{

        header("Location:login.php?errormsg=badcredentials");

    }

}else{

    header("Location:login.php");
    exit;

}

?>