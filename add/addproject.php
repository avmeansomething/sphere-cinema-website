<?php
    include("../include/db_connect.php");

    if(isset($_POST['project_id']) && isset($_POST['project_name']) && isset($_POST['project_bossname']) && isset($_POST['project_cost']) && isset($_POST['project_duration']))
    {

        $project_id = $_POST['project_id'];
        $project_name = $_POST['project_name'];
        $project_bossname = $_POST['project_bossname'];
        $project_cost = $_POST['project_cost'];
        $project_duration = $_POST['project_duration'];
        $project_logo = $_POST['project_logo'];
        
        
        $query ="INSERT INTO `projects` (`project_id`, `project_name`, `project_bossname`, `project_cost`, `project_duration`, `project_photo`) 
    VALUES ('$project_id', '$project_name', '$project_bossname', '$project_cost', '$project_duration', '$project_logo')";
        
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        if ($result) {
            echo '
                Добавлено
        ';
        } else {
            echo '
                Не добавлено
        ';
        }
    }
?>
