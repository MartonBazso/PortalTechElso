<?php
    ob_start();

    if(!isset($_SESSION)) session_start();

    if(!isset($_SESSION["loggedin"])){
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználók</title>
</head>
<body>
<?php if($_SESSION["role"]=="admin"){ ?>
    
    <?php
        require_once("connect.php");
        if(isset($_POST["submit"])){

            $username =mysqli_real_escape_string($kapcsolat, $_POST["username"]); 
            $password_hashed =sha1(mysqli_real_escape_string($kapcsolat, $_POST["password"]));
            $role =mysqli_real_escape_string($kapcsolat, $_POST["role"]);
            
            $sql="INSERT INTO Users(username, password, role) VALUES ('$username','$password_hashed', '$role')";
            
            if(!mysqli_query($kapcsolat, $sql)){
                die('Hiba: '.mysqli_error($kapcsolat));
            }

        }
    ?>

    <h2>Felhasználók listája: </h2>
    <?php
        $sql="SELECT * FROM Users";
        $query=mysqli_query($kapcsolat,$sql);
    ?>
    <table>
            <tr>
                <td>Azonosító</td>
                <td>Felhazsnálónév</td>
                <td>Jelszó (sha1)</td>
                <td>Szerepkör</td>
            </tr>
        <?php
            while($row = mysqli_fetch_assoc($query)){ ?>
            <tr>
                <td><?php echo $row["userid"];?></td>
                <td><?php echo $row["username"];?></td>
                <td><?php echo $row["password"];?></td>
                <td><?php echo $row["role"];?></td>
            </tr>

        <?php } ?>
    </table>

    <hr>

    <h2>Felhasználó hozzáadása</h2>
    <form action="admin.php" method="POST">
        <table>
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
                    <input type="text" name="role">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                <input type="submit" name="submit">
                </td>
            </tr>
        </table>
    </form>


 <?php } ?>
 <a href="logout.php"> Kijelentkezés</a>
</body>
</html>