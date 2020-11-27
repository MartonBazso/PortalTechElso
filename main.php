<?php if (!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 30%;
            text-align: center;
            margin: auto;
        }
        
        body {
            text-align: center;
            margin: auto;
        }
        
        a {
            text-decoration: none;
            color: black;
        }
        
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }
        
        .container {
            padding: 2px 16px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
</head>

<body>
    <h2>Üdvözlünk a Főoldalon!</h2>
    <p><i>Válassz egy témát és inspirálódj!</i></p>
    <?php 
        require_once("connect.php");   
        $sql = "SELECT * FROM topics ORDER BY Name";
        $result = mysqli_query($kapcsolat, $sql);
        $rows = $result -> fetch_all(MYSQLI_ASSOC);
        for($i = 0; $i < $result -> num_rows; $i++ ){            
            
            echo '
            <div class="card">
                <a target="_blank" href="details.php?topic='.$rows[$i]["Id"].'">
                    <div class="container">
                        <h4>'. mysqli_real_escape_string($kapcsolat, $rows[$i]["Name"]) .'</h4>
                    </div>
                </a>
            </div>
            ';
        }
        
    ?>
</body>

</html>