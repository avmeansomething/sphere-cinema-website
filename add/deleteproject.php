<?php
    include("../include/db_connect.php");

    if(isset($_POST['delete_project']))
    {

        $project_id = $_POST['delete_project'];
    

        $query ="DELETE FROM projects WHERE project_id = '$project_id'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        if ($result) {
            echo '
                Удалено
        ';
        } else {
            echo '
                Не удалено
        ';
        }
    }
?>
