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

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .container {
            padding: 2px 16px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: auto;
        }

        th,
        td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        .comment {
            margin-top: 20px;
            width: 80%;
            height: 2em;
            font-size: 1.2em;
            border: 3px solid gray;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
</head>

<body>
    <?php
    require_once("connect.php");
    if (isset($_GET["topic"])) {

        $topic_id = $_GET["topic"];
        $title_query = "SELECT * FROM topics WHERE Id= $topic_id ";
        $result = mysqli_query($kapcsolat, $title_query);
        $title = $result->fetch_array(MYSQLI_ASSOC);
        echo "<h1>" . $title["Name"] . "</h1>";

        $_SESSION["topicId"] = $topic_id;

        $comment_query =
            "SELECT Username, Text, CommentedAt  FROM Comments 
             INNER JOIN Users ON comments.UserId = Users.Id
             WHERE TopicId = $topic_id ORDER BY CommentedAt DESC";

        $comment_result = mysqli_query($kapcsolat, $comment_query);
        if ($comment_result->num_rows != 0) {
            $comments = $comment_result->fetch_all(MYSQLI_ASSOC);
            echo '
            
            <div class="content">
                <table>
                    <tr class="header">
                        <th>Felhasználónév</th>
                        <th>Üzenet</th>
                        <th>Dátum</th>
                    </tr>';
            for ($i = 0; $i < $comment_result->num_rows; $i++) {
                echo '
                    <tr>
                        <td>' . $comments[$i]["Username"] . '</td>
                        <td>' . $comments[$i]["Text"] . '</td>
                        <td>' . $comments[$i]["CommentedAt"] . '</td>
                    </tr>';
            }
            echo '                   
                </table>
            </div>';
        } else {
            echo '<h4>Ehhez a témához nem található komment.</h4>';
        } ?>

        <form action="comment.php" method="POST">
            <input class="comment" type="text" name="comment">
            <button type="submit">Elküld</button>
        </form>
    <?php
    } else {
        echo "<h1>Nem megfelelő téma!</h1>";
    }
    ?>
</body>

</html>