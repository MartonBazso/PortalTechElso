<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <style>
    .errors{
        color:red;
    }
    </style>
</head>
<body>
    <h2>Regisztrálj!</h2>
    <div class="errors" id="errorcontainer">
    </div>
    <?php
        require_once("connect.php");
        if(isset($_POST["submit"])){

            $username =mysqli_real_escape_string($kapcsolat, $_POST["username"]); 
            $password_hashed =sha1(mysqli_real_escape_string($kapcsolat, $_POST["password"]));
            $role ="member";
            
            $sql="INSERT INTO Users(username, password, role) VALUES ('$username','$password_hashed', '$role')";
            
            if(!mysqli_query($kapcsolat, $sql)){
                die('Hiba: '.mysqli_error($kapcsolat));
            }

            $_SESSION["username"]=$username;
            $_SESSION["loggedin"]="loggedin";
            $_SESSION["role"]=$row["role"];
    
            header("Location:index.html");

        }
    ?>

    <form action="regist.php" method="POST" onSubmit="return blankCheck()">
    <table>
        <tr>
            <td>Felhasználónév:</td>
            <td>
                <input type="text" name="username" id="felhasznalo">
            </td>
        </tr>
        <tr>
            <td>Jelszó:</td>
            <td>
            <input type="password" name="password" id="jelszo">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
             <input type="submit" name="submit" value="Belépés">
            </td>
        </tr>
    </table>
    </form>
    <script>
        function blankCheck(){
            if(document.getElementById("felhasznalo").value=="" || document.getElementById("jelszo").value==""){
                document.getElementById("errorcontainer").innerHTML ="Töltsd ki az űrlapelemeket!";
                    return false;
            }else{
                return true;
            }
        }
    </script>
</body>
</html>