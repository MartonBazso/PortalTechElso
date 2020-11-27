<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .box {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
            margin: 1% auto;   
        }
        .box td {
            padding: 30px;
        }
        .errors{
            text-align: center;
            margin: 1% auto;  
        }
    </style>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>

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
            $gender =mysqli_real_escape_string($kapcsolat, $_POST["gender"]); 
            $age =mysqli_real_escape_string($kapcsolat, $_POST["age"]); 
            $topic =mysqli_real_escape_string($kapcsolat, $_POST["topic"]); 
            $role ="member";
            
            $sql="INSERT INTO Users(username, password, role, gender, age, topics) VALUES ('$username','$password_hashed', '$role', '$gender','$age','$topic')";
            
            if(!mysqli_query($kapcsolat, $sql)){
                die('Hiba: '.mysqli_error($kapcsolat));
            }

            $_SESSION["username"]=$username;
            $_SESSION["loggedin"]="loggedin";
            $_SESSION["role"]=$row["role"];
    
            header("Location:main.php");

        }
    ?>

    <form action="register.php" method="POST" onSubmit="return Check()">
    <table class="box">
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
            <td>Nem:</td>
            <td>
            <input type="radio" name="gender" value="ferfi" id="nem"> Férfi
            <input type="radio" name="gender" value="no" id="nem"> Nő
            </td>
        </tr>
        <tr>
            <td>Életkor:</td>
            <td>
                <input type="number" name="age" id="kor">
            </td>
        </tr>
        <tr>
            <td>Témakörök:</td>
            <td>
                <?php
                    $sql = "SELECT * FROM topics ORDER BY Name";
                    $result = mysqli_query($kapcsolat, $sql);
                    $rows = $result -> fetch_all(MYSQLI_ASSOC);
                    ?>
                
                    <select name="topic">
                    <?php
                    for($i = 0; $i < $result -> num_rows; $i++ ){            
                        
                        echo '<option>'. mysqli_real_escape_string($kapcsolat, $rows[$i]["Name"]) .'</option>'
                        ;}

                    ?>
                    </select>
        
        
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
        function Check(){
            if(document.getElementById("felhasznalo").value=="" || document.getElementById("jelszo").value=="" || document.getElementById("nem").value=="" || document.getElementById("kor").value==""){
                document.getElementById("errorcontainer").innerHTML ="Töltsd ki az űrlapelemeket!";
                    return false;
            }else if(document.getElementById("kor").value<10){
                document.getElementById("errorcontainer").innerHTML ="Kérjük valós kort adjon meg!";
                return false;
            }else{
                return true;
            }
        }
    </script>
</body>
</html>,