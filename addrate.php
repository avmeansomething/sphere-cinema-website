<?php
require("include/db_connect.php");
require("include/db.php");
if (isset($_POST['rated'])) {
    if ($_POST['comment'] != "") {
        if (isset($_POST['rate']) && isset($_POST['film_id'])) {
            $film_id = $_POST['film_id'];
            $rate = $_POST['rate'];
            $comment_text = $_POST['comment'];
            $user_name = $_SESSION['logged_user']->first_name;

            $sql1 = "INSERT INTO `rating` (`rating_id`, `film_id`, `rating_assessment`) VALUES (NULL, '$film_id', '$rate')";
            $result1 = mysqli_query($link, $sql1) or die("Ошибка " . mysqli_error($link));
            
            $sql2 = "INSERT INTO `comments` (`comment_id`, `comment_text`, `film_id`, `user_name`, `user_assessment`) VALUES (NULL, '$comment_text', '$film_id', '$user_name', '$rate')";
            $result2 = mysqli_query($link, $sql2) or die("Ошибка " . mysqli_error($link));

            if ($result1 && $result2) {
                header("Location: projects.php?page=1");
            } else {
                echo '<script>alert("Давай по новой миша, всё херня")</script>';
            }
            
        }
    } 
    else {

        if (isset($_POST['rate']) && isset($_POST['film_id'])) {
            $film_id = $_POST['film_id'];
            $rate = $_POST['rate'];
            $sql = "INSERT INTO `rating` (`rating_id`, `film_id`, `rating_assessment`) VALUES (NULL, '$film_id', '$rate')";
            $result = mysqli_query($link, $sql) or die("Ошибка " . mysqli_error($link));
            if ($result) {
                header("Location: projects.php?page=1");
            } else {
                echo '<script>alert("Давай по новой миша, всё херня")</script>';
            }
        }
    }
}
?>
