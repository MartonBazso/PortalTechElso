<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bejelentkezés</title>
</head>

<body>
    <h2>Jelentkezz be!</h2>
    <div class="errors" id="errorcontainer">
        <?php
        if (isset($_GET["errormsg"])) {
            if ($_GET["errormsg"] == "badcredentials") {
                echo "Hibás felhasználónév/jelszó párost adtál meg";
            }
        }
        ?>
    </div>
    <form action="check.php" method="POST" onSubmit="return blankCheck()">
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
                    <button type="submit">Belépés</button>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="register.php">Nincs még felhaszálód? Regisztrálj itt!</a>
                </td>
            </tr>
        </table>
    </form>
    <script>
        function blankCheck() {
            if (document.getElementById("felhasznalo").value == "" || document.getElementById("jelszo").value == "") {
                document.getElementById("errorcontainer").innerHTML = "Töltsd ki az űrlapelemeket!";
                return false;
            } else {
                return true;
            }
        }
    </script>
</body>

</html>