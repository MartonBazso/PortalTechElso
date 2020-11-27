<?php
    ob_start();

    if(!isset($_SESSION)) session_start();

    if(!isset($_SESSION["loggedin"])){
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <style>
        .list {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 8px;
            border-collapse: collapse; 
            text-align: center;
            margin: 1% auto;
        }
        .list td { 
            padding: 0.5rem; 
            border: 1px solid black; 
        } 
        .box {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 10px;
            text-align: center;
            margin: 1% auto;   
        }
        
        body {
            text-align: center;
            margin: 1% auto;
        }
        .content {
            padding: 10px;
            text-align: center;
            margin: auto;   
        }
        a{ 
            background-color: white;
            padding: 4px;
            margin: 1.5em;
            cursor: pointer;
            border: 2px solid black; 
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }
        .errors{
            text-align: center;
            margin: 1% auto;  
        }

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználók</title>
</head>
<body>
<?php if($_SESSION["role"]=="admin"){ ?>
    
    <?php
        require_once("connect.php");
        if(isset($_POST["add"])){
            $username =mysqli_real_escape_string($kapcsolat, $_POST["username"]); 
            $password_hashed =sha1(mysqli_real_escape_string($kapcsolat, $_POST["password"]));
            $gender =mysqli_real_escape_string($kapcsolat, $_POST["gender"]); 
            $age =mysqli_real_escape_string($kapcsolat, $_POST["age"]); 
            $role ="member";
            
            $sql="INSERT INTO Users(username, password, role, gender, age) VALUES ('$username','$password_hashed', '$role', '$gender','$age')";
            
            $sql="INSERT INTO Users(username, password, role) VALUES ('$username','$password_hashed', '$role')";
            
            if(!mysqli_query($kapcsolat, $sql)){
                die('Hiba: '.mysqli_error($kapcsolat));
            }
        }
        if(isset($_POST["delete"])){

            $username =mysqli_real_escape_string($kapcsolat, $_POST["username"]); 
            
            $sql="DELETE FROM Users WHERE (username='$username')";
            
            if(!mysqli_query($kapcsolat, $sql)){
                die('Hiba: '.mysqli_error($kapcsolat));
            }
        }
        if(isset($_POST["update"])){

            $username =mysqli_real_escape_string($kapcsolat, $_POST["username"]);
            $role =mysqli_real_escape_string($kapcsolat, $_POST["role"]); 
            
            $sql="UPDATE Users SET role = '$role' WHERE username='$username'";
            
            if(!mysqli_query($kapcsolat, $sql)){
                die('Hiba: '.mysqli_error($kapcsolat));
            }
        }
    ?>

    <h2>Felhasználók </h2>
    <?php
        $sql="SELECT * FROM Users";
        $query=mysqli_query($kapcsolat,$sql);
    ?>
    <table class="list">
            <tr>
                <td>Azonosító</td>
                <td>Felhasználónév</td>
                <td>Jelszó (sha1)</td>
                <td>Szerepkör</td>
            </tr>
        <?php
            while($row = mysqli_fetch_assoc($query)){ ?>
            <tr>
                <td><?php echo $row["Id"];?></td>
                <td><?php echo $row["username"];?></td>
                <td><?php echo $row["password"];?></td>
                <td><?php echo $row["role"];?></td>
            </tr>

        <?php } ?>
    </table>
<div>
    <form action="admin.php" method="POST">        
        <table  class="content">
                <tr>
                    <td><input type="submit" name="1" value="Hozzáadás" class="button"></td>
                    <td><input type="submit" name="2" value="Törlés"></td>
                    <td><input type="submit" name="3" value="Módosítás"></td>
                </tr>
        </table>
    </form>
</div>
<?php  if(isset($_POST["1"])){ ?>
    <h2>Felhasználó hozzáadása</h2>
    <form action="admin.php" method="POST">
        <table class="box">
            <tr>
                <td>Felhasználónév:</td>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <td>Jelszó:</td>
                <td>
                <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td>Szerepkör:</td>
                <td>
                <select name="role">
                    <option>admin</option>
                    <option>member</option>
                    <option>moderator</option>
                </select>
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
                
                <td colspan="2">
                <input type="submit" name="add" value="Hozzáad">
                </td>
            </tr>
        </table>
    </form>

<?php } ?>

<?php  if(isset($_POST["2"])){ ?>

    <h2>Felhasználó törlése</h2>
    <form action="admin.php" method="POST">
        <table class="box">
            <tr>
                <td>Felhasználónév:</td>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" name="delete" value="Törlés">
                </td>
            </tr>
        </table>
    </form>
<?php } ?>

<?php  if(isset($_POST["3"])){ ?>

    <h2>Szerepkör frissítése</h2>
    <form action="admin.php" method="POST">
        <table class="box">
            <tr>
                <td>Felhasználónév:</td>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <td>Szerepkör:</td>
                <td>
                    <select name="role">
                        <option>admin</option>
                        <option>member</option>
                        <option>moderator</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" name="update" value="Frissítés">
                </td>
            </tr>
        </table>
    </form>

<?php } ?>

<?php } ?>
 <a href="main.php"  class="button"> Vissza a főoldalra</a>
 <a href="logout.php"  class="button"> Kijelentkezés</a>
</body>
</html>